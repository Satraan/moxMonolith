<?php

namespace App\Http\Controllers;

use App\Product;
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
//use Goutte\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class WishlistController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Create a new wishlist
    public function createWishlist(Request $request){

        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        $wishlist = new Wishlist();
        $wishlist->title = $request->title;
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
    //Update the wishlist title
    public function updateWishlist(Request $request){

        $wishlist = Wishlist::findOrFail($request->wishlistId);
        $wishlist->title = $request->title;
        $wishlist->save();

    }


    //Adds a card to a wishlist
    public function addToWishlist(Request $request)
    {
        $cardId = $request->card;
        $wishlistId = $request->wishlist;

        $card = Card::where('scryfall_id', '=', $cardId)->first();
        $wishlist = Wishlist::findOrFail($wishlistId);

        //Adds the card to the wishlist
        $wishlist->cards()->attach([$card->id]);

        //Redirects to updated wishlist view
        return redirect()->action(
            'WishlistController@view',
            ['wishlist' => $wishlistId]
        );
    }
    //Removes a card from a wishlist
    public function removeFromWishlist($wishlistId, $cardId){

        DB::table('card_wishlist')->where(
            ['wishlist_id' => $wishlistId, 'card_id'=> $cardId]
        )->delete();

        return redirect()->action(
            'WishlistController@view',
            ['wishlist' => $wishlistId]
        );
    }

    public function list(){
        $wishlists = Wishlist::whereHas('users')->get();
        return view("user.wishlist.list",compact('wishlists'));
    }

    //View an individual wishlist
    public function view($wishlistId){
        $wishlist = Wishlist::findOrFail($wishlistId);

        //Find all the cards in this wishlist
        $cards = Card::whereHas('wishlists', function ($query) use($wishlistId){
            $query->where('id', $wishlistId);
        })->orderBy('tcg_price', 'desc')->get();

        return view("user.wishlist.view",compact('cards', 'wishlist'));
    }

    public function addProduct($card, $retailer, $price){

        $product = Product::firstOrNew(array('card_id' => $card, 'retailer_id' => $retailer));

        $product->card_id = $card;
        $product->retailer_id = $retailer;
        $product->price = $price;
        $product->save();

        //Redirects to list view
        return redirect()->action('WishlistController@list');
    }


//    public function checkAllStock(){
//        $cards = Card::whereHas('wishlists')->get();
//
//        foreach ($cards as $card){
//            echo "Checking stock";
//            $q = $card->name;
//            $value = $card->scryfall_id;
//
//            $this->scrapeGeekhome($q, $value);
//            $this->scrapeDracoti($q, $value);
//            $this->scrapeSadRobot($q, $value);
//            $this->scrapeTopDeck($q, $value);
//            $this->scrapeUnderworldConnections($q, $value);
//        }
//
//
//    }
    public function getPrices(){
        $cards = Card::whereHas('wishlists')->where('tcg_price' , null)->get();

        foreach ($cards as $card){
            $client = new \GuzzleHttp\Client();
            $request = new \GuzzleHttp\Psr7\Request('GET', "https://api.scryfall.com/cards/" . $card -> scryfall_id);

            $promise = $client->sendAsync($request)->then(function ($response) use($card){
                $result = $response->getBody();
                $result = json_decode($result);

                $price = isset($result->usd) ? $result->usd : 0;

                if ($price != null){
                    $card->tcg_price = $price;
                    $card->save();
                }
            });
            $promise->wait();
        }


    }



}
