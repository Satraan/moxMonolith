<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Home</title>

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
                <div class="ui two column grid">
                    <div class="ui two wide column">
                        <div class="ui vertical buttons">
                            <button id="scrapeTopDeck" type="submit" class="ui teal button">Search TopDeck</button>
                            <button id="scrapeGeekhome" type="submit" class="ui teal button">Search Geekhome</button>
                            <button id="scrapeSadRobot" type="submit" class="ui teal button">Search SadRobot</button>
                            <button id="scrapeAll" type="submit" class="ui primary button">Search All</button>
                        </div>
                        <button id="addToWishlist" type="submit" class="ui primary button">Add to Wishlist</button>
                    </div>
                    <div class="ui twelve wide column">
                        <form id="searchCards" class="ui form">
                            <div class="field">
                                <label for="search">Search for a card</label>
                                <select id="select-card" name="cards" placeholder="Search for a card"></select>
                            </div>
                        </form>



                        <table id="results" class="ui single line table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                        </table>

                        <div id="ajaxResult" class="ui segment"></div>

                    </div>
                </div>



            </div>

        </div>
    </body>
</html>
