@extends('layouts.userLayout')

@section('content')
<div class="twelve wide column">
    <div class="ui segment segment--wishlist">
        <div class="segment-header">
            <h3 class="ui left floated header">
                {{$wishlist -> title}}
            </h3>
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
                    <th>Id</th>
                    <th>Name</th>
                    <th>TCG Price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cards as $card)
                <tr>
                    <td>{{$card -> id}}</td>
                    <td class="center aligned">{{$card -> name}}</td>
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
