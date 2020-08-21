<?php

namespace App\Http\Livewire;

use App\Services\GameFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component {

    public $recentlyReviewed = [];

    public function load(){
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $recentlyReviewedUnformatted = Cache::remember('recently-reviewed', env('CACHE_TIME'), function() use ($before, $current){
            return Http::withHeaders(config('services.igdb'))
                ->withOptions([
                    'body' => "
                    fields name, cover.url, first_release_date, popularity, summary, platforms.abbreviation, rating,
                    rating_count, slug;
                    where platforms = (48,49,130,6)
                    & (first_release_date > {$before}
                    & first_release_date < {$current}
                    & rating_count > 5);
                    sort popularity desc;
                    limit 3;
                "
                ])
                ->get('https://api-v3.igdb.com/games/')
                ->json();
        });

        $gameFormatter = new GameFormatter();

        $this->recentlyReviewed = $gameFormatter->formatForView($recentlyReviewedUnformatted);

        collect($this->recentlyReviewed)->filter(function ($game) {
            return $game['rating'];
        })->each(function ($game) {
            $this->emit('reviewGameWithRatingAdded' . $game['slug'], [
                'slug' => 'review_' . $game['slug'],
                'rating' => $game['rating'] / 100
            ]);
        });
    }

    public function render(){
        return view('livewire.recently-reviewed');
    }
}
