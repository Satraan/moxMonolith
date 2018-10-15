<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Goutte\Client;
use Illuminate\Support\Facades\Log;

class WishlistController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Create a new wishlist
    public function createWishlist(){}
    //Deletes a wishlist
    public function deleteWishlist(){}



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
    public function removeFromWishlist(){}


    //Renders the wishlist page
    public function list(){
        //Select all Cards that have wishlist
        $cards = Card::whereHas('wishlists')->get();
        return view("list",compact('cards'));
    }
}
