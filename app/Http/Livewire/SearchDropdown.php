<?php

namespace App\Http\Livewire;

use App\Services\GameFormatter;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component {

    public $search = '';
    public $searchResults = [];

    public function render(){
        if(strlen($this->search) > 2){
            $searchResultsUnformatted = Http::withHeaders(config('services.igdb'))
                ->withOptions([
                    'body' => "
                    search \"{$this->search}\";
                    fields name, cover.url, first_release_date, popularity, platforms.abbreviation, rating, slug;
                    where platforms = (48,49,130,6);
                    limit 8;
                "
                ])
                ->get('https://api-v3.igdb.com/games/')
                ->json();

            $gameFormatter = new GameFormatter();

            $this->searchResults = $gameFormatter->formatForView($searchResultsUnformatted);

        }

        return view('livewire.search-dropdown');
    }
}
