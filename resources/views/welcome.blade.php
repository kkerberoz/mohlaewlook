<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/main.css">

        <!-- Styles -->

    </head>
    <body>
     <div id="app">
         <navbar></navbar>
         <div class="container">
             <div class="row">
                <example-component></example-component>
             </div>
         </div>
     </div>


    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
