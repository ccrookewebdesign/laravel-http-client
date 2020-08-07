<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

class GameFormatter {

    /*public function formatForView($games): array{
        return collect($games)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'rating'        => (isset($game['rating']) ? round($game['rating']) . '%' : 'NR'),
                'platforms'     => implode(array_filter(collect($game['platforms'])->pluck('abbreviation')->toArray(), 'strlen'), ', '),
                'releaseDate'   => Carbon::parse($game['first_release_date'])->format('M d, Y'),
                'genres' => (isset($game['genres']) ? $this->formatGenres($game['genres']) : ''),
                //'companies' => (isset($game['involved_companies']) ? $this->formatGenres($game['involved_companies']) : ''),
            ]);
        })->toArray();
    }

    private function formatGenres($genres): string{
        return implode(array_filter(collect($genres)->pluck('name')->toArray(), 'strlen'), ', ');
    }*/

    public function formatForView($games): array{
        return collect($games)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => (isset($game['cover']['url']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : ''),
                'thumbImageUrl' => (isset($game['cover']['url']) ? $game['cover']['url'] : 'https://via.placeholder.com/50x60'),
                'rating'        => (isset($game['rating']) ? round($game['rating']) . '%' : 'NR'),
                'criticRating'  => (isset($game['aggregated_rating']) ? round($game['aggregated_rating']) . '%' : 'NR'),
                'platforms'     => implode(array_filter(collect($game['platforms'])->pluck('abbreviation')->toArray(), 'strlen'), ', '),
                'releaseDate'   => (isset($game['first_release_date']) ? Carbon::parse($game['first_release_date'])->format('M d, Y') : null),
                'genres'        => (isset($game['genres']) ? implode(array_filter(collect($game['genres'])->pluck('name')->toArray(), 'strlen'), ', ') : ''),
                'companies'     => (isset($game['involved_companies']) ? implode(array_filter(collect($game['involved_companies'])->pluck('company.name')->toArray(), 'strlen'), ', ') : ''),
                'gameTrailer'   => (isset($game['videos']) ? 'https://youtube.com/embed/' . $game['videos'][0]['video_id'] : null),
                'screenshots'   => isset($game['screenshots']) ?
                    collect($game['screenshots'])->map(function($screenshot){
                        return [
                            'big'  => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']),
                            'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                        ];
                    })->take(9) : null,
                'similarGames'  => isset($game['similar_games']) ?
                    collect($game['similar_games'])->map(function($game){
                    return collect($game)->merge([
                        'coverImageUrl' => array_key_exists('cover', $game) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : 'https://via.placeholder.com/264x352',
                        'rating'        => (isset($game['rating']) ? round($game['rating']) . '%' : 'NR'),
                        'platforms'     => isset($game['platforms']) ? implode(array_filter(collect($game['platforms'])->pluck('abbreviation')->toArray(), 'strlen'), ', ') : null,
                    ]);
                })->take(6) : null,
                'social'        => isset($game['websites']) ? [
                    'website'   => collect($game['websites'])->first(),
                    'facebook'  => collect($game['websites'])->filter(function($website){
                        return Str::contains($website['url'], 'facebook');
                    })->first(),
                    'twitter'   => collect($game['websites'])->filter(function($website){
                        return Str::contains($website['url'], 'twitter');
                    })->first(),
                    'instagram' => collect($game['websites'])->filter(function($website){
                        return Str::contains($website['url'], 'instagram');
                    })->first(),
                ] : null,
            ]);
        })->toArray();
    }
}
