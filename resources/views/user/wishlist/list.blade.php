@extends('layouts.userLayout')

@section('content')
    <div class="twelve wide column">
        <div class="ui segment segment--wishlist">
            <div class="segment-header">
                <h3 class="ui left floated header">
                    My Wishlists
                </h3>
                <h3 class="ui right floated header">
                    <a href="/createWishlist" class="add-wishlist">
                        <i data-feather="plus-circle"></i>
                    </a>
                </h3>

            </div>
            <div class="ui clearing divider"></div>
            <div class="segment-content">
                @if(count($wishlists) > 0)
                    <table class="ui celled table">
                        <thead>
                        <tr class="center aligned">
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($wishlists as $wishlist)
                        <tr>
                            <td class="center aligned">
                                <a href="{{ URL('/deleteWishlist/'.$wishlist->id )}}">
                                    <i data-feather="trash-2"></i>
                                </a>
                            </td>
                            <td class="eleven wide">{{$wishlist -> id}}</td>
                            <td class="center aligned">{{$wishlist -> user_name}}</td>
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
