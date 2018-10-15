<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Mox Monolith</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <link href="/css/style.css" rel="stylesheet" type="text/css">
        <script src="/js/app.js" rel="script"></script>
        <script src="/js/scripts.js" rel="script"></script>
        <script type="text/javascript" src="/js/selectize.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/selectize.css" />


    </head>
    <body>
            <div class="page page--wishlist">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="ui three item menu">
                <a href="/"class="item">Search for cards</a>
                <a href="/list" class="active item">View Wishlist</a>
                <a href="/stock" class="item">View Stock</a>
            </div>

            <div class="ui container">
                <table class="ui celled table">
                    <thead>
                    <tr class="center aligned">
                        <th>Name</th>
                        <th class="eleven wide">Oracle Text</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cards as $card)
                    <tr>
                        <td class="center aligned">{{$card -> name}}</td>
                        <td class="eleven wide">{{$card -> oracle_text}}</td>
                        <td class="center aligned"><a href="{{$card -> scryfall_uri}}">Scryfall Link</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
    </body>
</html>
