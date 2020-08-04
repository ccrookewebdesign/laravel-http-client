<?php

// Globally accessible functions
use Carbon\Carbon;
use Illuminate\Support\Str;

/*function formatForView($games){
    return collect($games)->map(function($game){
        return collect($game)->merge([
            'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
            'rating'        => isset($game['rating']) ? round($game['rating']) . '%' : 'NR',
            'platforms' => implode(array_filter(collect($game['platforms'])->pluck('abbreviation')->toArray(),'strlen'), ', '),
            'releaseDate'     => Carbon::parse($game['first_release_date'])->format('M d, Y'),
        ]);
    })->toArray();
}*/

