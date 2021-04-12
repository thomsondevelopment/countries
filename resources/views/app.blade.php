<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'Laravel')}}</title>
        <script src="{{asset('js/index.js')}}" defer></script>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body class="antialiased bg-gray-100">
        <div id="app"></div>           
    </body>
</html>
