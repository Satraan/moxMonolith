@extends('layouts.userLayout')

@section('content')
<div class="twelve wide column">
    <div class="ui segment segment--wishlist">
        <div class="segment-header">
            <div id="updateForm">
                <form name="updateTitle" action="">
                    <input type="hidden" name="wishlistId" id="wishlistId" value="{{ $wishlist -> id }}">
                    <div class="ui transparent input">
                        <input id="wishlistTitle" type="text" id="title" value="{{$wishlist -> title}}" onkeydown="if (event.keyCode == 13) return false">
                        <button type="submit" class="ui basic primary icon button js-update-wishlist">
                            <i data-feather="save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="ui clearing divider"></div>
        <div class="segment-content">
            <a href="/api/getPrices" target="_blank" class="ui button">Get Prices</a>
            <form action="/addToWishlist" method="post" class="ui form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="wishlist" value="{{$wishlist -> id}}">
                <div class="field">
                    <label for="search">Select a card</label>
                    <select id="select-card" name="card" placeholder="Search for a card"></select>
                    <button type="submit" class="ui button">
                        <i data-feather="plus-circle"></i>
                    </button>
                </div>
            </form>

            @if(count($cards) > 0)
            <table class="ui celled table">
                <thead>
                <tr class="center aligned">
                    <th>Name</th>
                    <th>TCG Price</th>
                    <th>In stock?</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cards as $card)
                <tr>
                    <td class="center aligned">
                        <a href="{{$card -> scryfall_uri}}">
                            {{$card -> name}}
                        </a>
                    </td>
                    <td class="center aligned">$ {{$card -> tcg_price}}</td>
                    <td class="center aligned">$ {{$card -> tcg_price}}</td>
                    <td class="center aligned">
                        <a href="/deleteCard/{{$wishlist -> id}}/{{$card->id}}">
                            <i data-feather="trash-2"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            This wishlist is empty.
            @endif




        </div>

    </div>
</div>

@endsection
