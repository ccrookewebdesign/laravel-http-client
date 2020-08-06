<div class="relative">
    <input wire:model.debounce.500ms="search"
           type="text"
           class="bg-gray-800 text-small rounded-full focus:outline-none focus:shadow-outline w-64 px-3 pl-8 py-1"
           placeholder="Search ..."/>
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                  d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4" style="position: absolute"></div>

    @if(strlen(trim($search)))
        <div class="absolute bg-gray-800 rounded w-64 mt-4 text-sm z-50">
            <ul>
                @forelse($searchResults as $game)
                    <li class="border-b border-gray-700">
                        <a href="{{ route('games.show', $game['slug']) }}"
                           class="block hover:bg-gray-700 p-3 flex items-center">
                            <img src="{{ $game['thumbImageUrl'] }}" class="w-10 h-12">
                            <span class="ml-4">{{ $game['name'] }}</span>
                        </a>
                    </li>
                @empty
                    <li class="border-b border-gray-700 p-3">
                        No results for "{{ trim($search) }}"
                    </li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
