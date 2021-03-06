<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = {{ asset('css/app.css') }} rel="stylesheet" />
    <title>Laravel</title>
</head>
<body>
<div id="app" class="p-3 border border-red-400">
    <api-example></api-example>
    {{--@json($games)--}}
    <div class="border border-red-300">test</div>
    @foreach($games as $game)
        <div class="py-2 pl-4">
            <a href="{{route('game', $game['id'])}}">{{ $game['name'] }}</a>
        </div>
    @endforeach
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
