<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(){
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        $wishlist = new Wishlist();
        $wishlist->title = $request->title;
        $wishlist->save();

        $user->wishlists()->attach($wishlist);

        return view("user.dashboard",compact('wishlists'));
    }
}
