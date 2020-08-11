<div wire:init="load" class="recently-reviewed space-y-12 mt-8 text-left">
    @forelse($recentlyReviewed as $game)
        <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
            <div class="relative flex-none">
                <a href="{{ route('games.show', $game['slug']) }}">
                    <img src="{{ $game['coverImageUrl'] }}" alt="game image"
                         class="w-48 hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div id="{{ $game['slug'] }}" class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full -right-20 -bottom-20"
                     style="right: -20px; bottom: -20px;">
                    {{--<div class="font-semibold text-xs flex justify-center items-center h-full">
                        {{ $game['rating'] }}
                    </div>--}}
                    @push('scripts')
                        @include('partials._rating', [
                          'slug' => $game['slug'],
                          'rating' => $game['rating'],
                          'event' => null,
                        ])
                    @endpush
                </div>
            </div>
            <div class="ml-12">
                <a href="{{ route('games.show', $game['slug']) }}"
                   class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-4">{{ $game['name'] }}</a>
                <div class="text-gray-400 mt-1">
                    {{ $game['platforms'] }}
                </div>
                <p class="mt-6 text-gray-400 hidden lg:block">
                    {{ $game['summary'] }}
                </p>
            </div>
        </div>
    @empty
        @foreach(range(1, 3) as $game)
            <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                <div class="relative flex-none">
                    <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-56"></div>
                </div>
                <div class="ml-6 lg:ml-12">
                    <div class="inline-block text-lg font-semibold leading-tight text-transparent bg-gray-700 rounded mt-4">title</div>
                    <div class="mt-8 space-y-4 block text-sm lg:text-base">
                        <span
                            class="text-transparent bg-gray-700 rounded inline-block">acfedgtbik nji bnj ijn ijn  asdf fdsaafgre cfedgtbik nji bnj ijn ijn </span>
                        <span
                            class="text-transparent bg-gray-700 rounded inline-block">acfedgtbik nji bnj ijn ijn asdf fdsaafgre cfedgtbik nji bnj ijn ijn </span>
                        <span
                            class="text-transparent bg-gray-700 rounded inline-block">acfedgtbik nji bnj ijn ijn asdf fdsaafgre cfedgtbik nji bnj ijn ijn </span>
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
