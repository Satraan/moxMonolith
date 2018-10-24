@extends('layouts.userLayout')

@section('content')
    <div class="twelve wide column">
        <div class="ui segment segment--wishlist">
            <div class="segment-header">
                <h3 class="ui left floated header">
                    My Wishlists
                </h3>
                <h3 class="ui right floated header">
                    <a href="" class="add-wishlist">
                        <i data-feather="plus-circle"></i>
                    </a>
                </h3>

            </div>
            <div class="ui clearing divider"></div>
            <div class="segment-content">
                You have not created any wishlists.
            </div>

        </div>
    </div>

@endsection
