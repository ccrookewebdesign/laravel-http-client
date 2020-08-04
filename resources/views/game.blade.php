<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = {{ asset('css/app.css') }} rel="stylesheet" />
    <title>Laravel</title>
</head>
<body>
<div id="app" class="p-8">
    <div>
        <img src="{{ Str::replaceFirst('thumb', 'cover_big', $game[0]['cover']['url']) }}">
    </div>
    <div class="font-weight-bold">{{ $game[0]['name'] }}</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
