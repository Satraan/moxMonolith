<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

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
        <div class="flex-center position-ref full-height">
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

            <div class="ui container">
                <table class="ui compact table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Desc</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cards as $card)
                    <tr>
                        <td>{{$card -> name}}</td>
                        <td>{{$card -> oracle_text}}</td>
                        <td><a href="{{$card -> scryfall_uri}}">Scryfall Link</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </body>
</html>
