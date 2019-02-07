<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/js/app.js" rel="script"></script>
    <script src="/js/scripts.js" rel="script"></script>
    <script src="/js/user.js" rel="script"></script>
    <script src="/js/semantic.min.js" rel="script"></script>
    <script type="text/javascript" src="/js/selectize.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet" type="text/css">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href="/css/mobile.css" rel="stylesheet" type="text/css">
    <link href="/css/selectize.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="app">
    <div class="ui five item menu">
        <a href="/"class="active item">Search for cards</a>
        <a href="/stock" class="item">View Stock</a>
        @if (Route::has('login'))
        @auth
        <a href="/dashboard" class="item">Dashboard</a>
        <a href="/logout" class="item">Log Out</a>
        @else
        <a href="{{ route('login') }}" class="item">Login</a>
        @endauth
        @endif
    </div>

    <div class="ui container">
        <div class="ui grid">
            @include('user.templates.menu')

            @yield('content')
        </div>
    </div>


</div>
</body>
<script>
    feather.replace();
</script>
</html>
