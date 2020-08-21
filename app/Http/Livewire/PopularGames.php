<?php

namespace App\Http\Livewire;

use App\Services\GameFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class PopularGames extends Component {

    public $popularGames = [];

    public function load(){
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $popularGamesUnformatted = Cache::remember('popular-games', env('CACHE_TIME'), function() use ($before, $after){
            return Http::withHeaders(config('services.igdb'))
                ->withOptions([
                    'body' => "
                    fields name, cover.url, first_release_date, popularity, platforms.abbreviation, rating, slug;
                    where platforms = (48,49,130,6)
                    & (first_release_date > {$before}
                    & first_release_date < {$after});
                    sort popularity desc;
                    limit 12;
                "
                ])
                ->get('https://api-v3.igdb.com/games/')
                ->json();
        });

        $gameFormatter = new GameFormatter();

        $this->popularGames = $gameFormatter->formatForView($popularGamesUnformatted);

        collect($this->popularGames)->filter(function ($game) {
            return $game['rating'];
        })->each(function ($game) {
            $this->emit('gameWithRatingAdded', [
                'slug' => $game['slug'],
                'rating' => $game['rating'] / 100
            ]);
        });
    }

    public function render(){
        return view('livewire.popular-games');
    }
}
