@extends('layouts.userLayout')

@section('content')
    <div class="twelve wide column">
        <div class="ui segment segment--wishlist">
            <div class="segment-header">
                <h3 class="ui left floated header">
                    My Wishlists
                </h3>
                <form action="/createWishlist" method="post" class="ui  form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="ui right floated action input">
                        <input type="text" name="title" placeholder="Add wishlist">
                        <button type="submit" class="ui button">
                            <i data-feather="plus-circle"></i>
                        </button>
                    </div>
                </form>

            </div>
            <div class="ui clearing divider"></div>
            <div class="segment-content">
                @if(count($wishlists) > 0)
                    <table class="ui celled table">
                        <thead>
                        <tr class="center aligned">
                            <th></th>
                            <th>Title</th>
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
                            <td class="center aligned">
                                <a href="{{ URL('/user/wishlist/view/'.$wishlist->id )}}">
                                    {{$wishlist -> title}}
                                </a>
                            </td>
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
    <script>
        feather.replace();
    </script>
@endsection
