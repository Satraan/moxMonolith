@extends('layouts.userLayout')

@section('content')
<div class="twelve wide column">
    <div class="ui segment segment--wishlist">
        <div class="segment-header">
            <h3 class="ui left floated header">
                My Wishlists
            </h3>
            <h3 class="ui right floated header">

            </h3>

        </div>
        <div class="ui clearing divider"></div>
        <div class="segment-content">
            @if(count($cards) > 0)
            <table class="ui celled table">
                <thead>
                <tr class="center aligned">
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cards as $card)
                <tr>
                    <td class="eleven wide">{{$card -> id}}</td>
                    <td class="center aligned">{{$card -> name}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            You have not created any wishlists.
            @endif




        </div>

    </div>
</div>

@endsection
