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
        <script src="/js/app.js" rel="script"></script>
        <script src="/js/scripts.js" rel="script"></script>



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
            <div class="ui cards">
                <div class="card">
                    <div class="content">
                        <div class="header">
                            Random Oracle Text
                        </div>
                        <div class="description" id="oracle-text">
                            ...
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="ui two buttons">
                            <div class="ui basic green button">Go!</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="content">
                        <div class="header">
                            Random Image
                        </div>
                        <div class="description">
                            <img src="https://via.placeholder.com/250x300"/>
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="ui two buttons">
                            <div class="ui basic green button">Go!</div>
                        </div>
                    </div>
                </div>
            </div>
</div>

        </div>
    </body>
</html>
