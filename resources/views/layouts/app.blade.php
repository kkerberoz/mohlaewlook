<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('APP_NAME','Mohlaewlook') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">

    </head>
    <body>
        <div id="app">
            <navbar :links="navbarlinks" is-logged-in="true"></navbar>
                    @yield('content')
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
