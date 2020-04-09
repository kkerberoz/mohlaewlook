<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Boss</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/main.css">

        <!-- Styles -->

    </head>
    <body>
     <div id="app">
         <navbar></navbar>
         <div class="container">
             <div class="row">
                <boss></boss>
             </div>
         </div>
     </div>


    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
