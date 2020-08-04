<?php

namespace App\Http\Controllers;

use App\Services\GameFormatter;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller {

    public function index(){
        /*$client = new \GuzzleHttp\Client(['base_uri' => 'https://api-v3.igdb.com/']);

        $response = $client->request('POST', 'multiquery', [
            'headers' => [
                'user-key' => env('IGDB_KEY'),
            ],
            'body' => '
                query games "Playstation" {
                    fields name, popularity, platforms.name, first_release_date;
                    where platforms = {6,48,130,49};
                    sort popularity desc;
                    limit 2;
                };

                query games "Switch" {
                    fields name, popularity, platforms.name, first_release_date;
                    where platforms = {6,48,130,49};
                    sort popularity desc;
                    limit 6;
                };
                '
        ]);

        $body = $response->getBody();
        dd(json_decode($body));*/

        return view('index');
    }

    public function show($slug){
        $gameUnformatted = Http::withHeaders(config('services.igdb'))
            ->withOptions([
                'body' => "
                    fields name, cover.url, first_release_date, popularity, platforms.abbreviation, rating,
                    slug, involved_companies.company.name, genres.name, aggregated_rating, summary, websites.*, videos.*, screenshots.*, similar_games.cover.url, similar_games.name, similar_games.rating,
                    similar_games.platforms.abbreviation, similar_games.slug;
                    where slug=\"{$slug}\";
                "
            ])
            ->get('https://api-v3.igdb.com/games/')
            ->json();

        abort_if(!$gameUnformatted, 404);

        $gameFormatter = new GameFormatter();
        //$game = $gameFormatter->formatForView($gameUnformatted)[0];

        //dd($game);

        return view('show', [
            'game' => $gameFormatter->formatForView($gameUnformatted)[0],
        ]);
    }


}


