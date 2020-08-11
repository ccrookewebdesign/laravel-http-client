<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href={{ asset('css/app.css') }} rel="stylesheet"/>
    <livewire:styles />
    <title>Video Games</title>
</head>
<body class="bg-gray-900 text-white">
<div id="app">
    <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
            <div class="flex flex-col lg:flex-row items-center">
                <a href="/">
                    <img src="/laracasts-logo.svg" alt="Video Games" class="w-32 flex-none">
                </a>
                <ul class="flex ml-0 lg:ml-16 space-x-8 mt-6 lg:mt-0">
                    <li><a href="/" class="hover:text-gray-400">Games</a></li>
                    <li><a href="/#recently-reviewed" class="hover:text-gray-400">Reviews</a></li>
                    <li><a href="/#coming-soon" class="hover:text-gray-400">Coming Soon</a></li>
                </ul>
            </div>

            <div class="flex items-center mt-6 lg:mt-0">
                <livewire:search-dropdown />
                <div class="ml-6">
                    <a href="#"><img src="/avatar.jpg" alt="avatar" class="rounded-full w-8"></a>
                </div>
            </div>

        </nav>
    </header>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            Powered By <a href="#" class="underline hover:text-gray-400">IGDB API</a>
        </div>
    </footer>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
<livewire:scripts />
</body>
</html>
