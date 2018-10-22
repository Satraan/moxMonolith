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


        <div class="page page--search">


            <div class="ui five item menu">
                <a href="/"class="active item">Search for cards</a>
                <a href="/list" class="item">View Wishlist</a>
                <a href="/stock" class="item">View Stock</a>
                @if (Route::has('login'))
                    @auth
                    <a href="/logout" class="item">Log Out</a>
                    @else
                    <a href="{{ route('login') }}" class="item">Login</a>
                    <a href="{{ route('register') }}" class="item">Register</a>
                    @endauth
                @endif
            </div>

            <div class="ui container">
                <div class="ui two column grid">
                    <div class="ui two wide column">
                        <div class="ui vertical buttons">
                            <button id="scrapeTopDeck" type="submit" class="ui grey button">Search TopDeck</button>
                            <button id="scrapeGeekhome" type="submit" class="ui grey button">Search Geekhome</button>
                            <button id="scrapeSadRobot" type="submit" class="ui grey button">Search SadRobot</button>
                            <button id="scrapeDracoti" type="submit" class="ui grey button">Search Dracoti</button>
                            <button id="scrapeUnderworldConnections" type="submit" class="ui grey button">Search Underworld Connections</button>
                            <button id="scrapeAll" type="submit" class="ui teal button">Search All</button>
                            <button id="addToWishlist" type="submit" class="ui teal button">Add to Wishlist</button>
                            <a href="/list" class="ui teal button">View Wishlist</a>
                        </div>

                    </div>
                    <div class="ui twelve wide column search-cards">
                        <form id="searchCards" class="ui form">
                            <div class="field">
                                <label for="search">Search for a card</label>
                                <select id="select-card" name="cards" placeholder="Search for a card"></select>
                            </div>
                        </form>


                        <table id="results" class="ui single line table hidden">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>TCG Value</th>
                                <th>Rand Value</th>
                            </tr>
                            </thead>
                        </table>

                        <div id="spinner" class="loader hidden">
<!--                            <img src="/svg/spinner.gif"/>-->
                        </div>

                        <div id="ajaxResult" class="ui segment hidden">
                        </div>

                    </div>
                </div>



            </div>

        </div>
    </body>
</html>
