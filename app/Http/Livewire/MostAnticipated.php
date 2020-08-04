<?php

namespace App\Http\Livewire;

use App\Services\GameFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class MostAnticipated extends Component {

    public $mostAnticipated = [];

    public function load(){
        $current = Carbon::now()->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;

        $mostAnticipatedUnformatted = Cache::remember('most-anticipated', env('CACHE_TIME'), function() use ($afterFourMonths, $current){
            return Http::withHeaders(config('services.igdb'))
                ->withOptions([
                    'body' => "
                    fields name, cover.url, first_release_date, popularity, platforms.abbreviation, rating, rating_count, slug, summary;
                    where platforms = (48,49,130,6)
                    & (first_release_date >= {$current}
                    & first_release_date < {$afterFourMonths});
                    sort popularity desc;
                    limit 4;
                "
                ])->get('https://api-v3.igdb.com/games')
                ->json();
        });

        $gameFormatter = new GameFormatter();

        $this->mostAnticipated = $gameFormatter->formatForView($mostAnticipatedUnformatted);
    }

    public function render(){
        return view('livewire.most-anticipated');
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
