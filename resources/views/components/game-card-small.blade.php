<div class="game flex">
    <a href="{{ route('games.show', $game['slug']) }}"><img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="w-16 hover:opacity-75 transition ease-in-out duration-150"></a>
    <div class="ml-4">
        <a href="{{ route('games.show', $game['slug']) }}" class="hover:text-gray-300">{{ $game['name'] }}</a>
        <div class="text-gray-400 text-sm mt-1">{{ $game['releaseDate'] }}</div>
    </div>
</div>
{{--
<div class="game flex">
    <div class="bg-gray-800 w-16 h-20 flex-none"></div>
    <div class="ml-4">
        <div class="block leading-tight text-transparent bg-gray-700 rounded">title</div>
        <div class="inline-block text-transparent text-sm bg-gray-700 rounded mt-2">Date goes here</div>
    </div>
</div>
--}}
