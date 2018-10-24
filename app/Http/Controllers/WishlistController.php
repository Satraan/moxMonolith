<?php

namespace App\Http\Controllers;

use App\User;
use App\Wishlist;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Goutte\Client;
use Illuminate\Support\Facades\Log;

class WishlistController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Create a new wishlist
    public function createWishlist(){
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $wishlist = new Wishlist();
        $wishlist->user_name = "Test";
        $wishlist->save();


        $user->wishlists()->attach($wishlist);

        //Redirects to list view
        return redirect()->action('WishlistController@list');
    }
    //Deletes a wishlist
    public function deleteWishlist($wishlistId){
        DB::table('user_wishlist')->where('wishlist_id', $wishlistId)->delete();
        //Redirects to list view
        return redirect()->action('WishlistController@list');
    }



    //Adds a card to a wishlist
    public function addToWishlist(Request $request)
    {
        $q = $request->get('query');
        $card = Card::where('scryfall_id', '=', $q)->first();

        $wishlistId = 1;

        $wishlist = Wishlist::findOrFail($wishlistId);

        //Adds the card to the wishlist
        $wishlist->cards()->attach([$card->id]);


    }
    //Removes a card from a wishlist
    public function removeFromWishlist($cardId){
        $card = DB::table('card_wishlist')->where('card_id', $cardId)->delete();

        $cards = Card::whereHas('wishlists')->get();
        return view("list",compact('cards'));
    }


    //Renders the wishlist page
//    public function list(){
//        //Select all Wishlists for this user
//        $wishlists = Wishlist::whereHas('wishlists')->get();
//        return view("user.wishlist.list",compact('wishlists'));
//    }
    public function list(){
        $wishlists = Wishlist::whereHas('users')->get();
        return view("user.wishlist.list",compact('wishlists'));
    }
}
