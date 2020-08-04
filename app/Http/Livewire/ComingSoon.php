<?php

namespace App\Http\Livewire;

use App\Services\GameFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComingSoon extends Component {

    public $comingSoon = [];

    public function load(){
        $current = Carbon::now()->timestamp;

        $comingSoonUnformatted = Cache::remember('coming-soon', env('CACHE_TIME'), function() use ($current){
            return Http::withHeaders(config('services.igdb'))
                ->withOptions([
                    'body' => "
                    fields name, cover.url, first_release_date, popularity, platforms.abbreviation, rating, rating_count, slug, summary;
                    where platforms = (48,49,130,6)
                    & (first_release_date >= {$current}
                    & popularity > 5);
                    sort first_release_date asc;
                    limit 4;
                "
                ])->get('https://api-v3.igdb.com/games')
                ->json();
        });

        $gameFormatter = new GameFormatter();

        $this->comingSoon = $gameFormatter->formatForView($comingSoonUnformatted);
    }

    public function render(){
        return view('livewire.coming-soon');
    }

    /*private function formatForView($games){
        return collect($games)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'releaseDate'     => Carbon::parse($game['first_release_date'])->format('M d, Y'),
            ]);
        })->toArray();
    }*/
}
