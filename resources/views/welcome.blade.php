<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('APP_NAME','Mohlaewlook') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,600" >
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    </head>
    <body>
        <div id="app">
            <header  v-show="$route.path==='/admin' || $route.path==='/admin/newEmployee' ||$route.path==='/admin/addFlight'||$route.path==='/admin/addAircraft'||$route.path==='/adminLogin' ? false : true">
                <navbar :links="navbarlinks" ></navbar>
            </header>


            <router-view csrf="{{csrf_token()}}" ></router-view>
            <footer v-show="$route.path==='/admin' || $route.path==='/admin/newEmployee' ||$route.path==='/admin/addFlight'||$route.path==='/admin/addAircraft'||$route.path==='/adminLogin' ? false : true">
                <app-footer :links ="footerlinks"></app-footer>
            </footer>

        </div>
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
</html>
