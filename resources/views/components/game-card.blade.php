<div class="game mt-8">
    <div class="relative inline-block">
        <a href="{{ route('games.show', $game['slug']) }}">
            <img src="{{ $game['coverImageUrl'] }}" alt="game image" class="hover:opacity-75 transition ease-in-out duration-150">
        </a>
        <div id="{{ $game['slug'] }}" class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full font-semibold text-xs" style="right: -20px; bottom: -20px;">
        </div>

        @push('scripts')
            @include('partials._rating', [
              'slug' => $game['slug'],
              'rating' => $game['rating'],
              'event' => null,
            ])
        @endpush

    </div>

    <a href="{{ route('games.show', $game['slug']) }}"
       class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">{{ $game['name'] }}</a>
    <p class="text-gray-400 mt-1">
        {{ $game['platforms'] }}
    </p>
    <div>{{ $game['slug'] }} -- -- {{ $game['rating'] }}</div>
</div>
