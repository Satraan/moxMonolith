<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\Services\Scrapers\LuckshackScraperService;
use App\Wishlist;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Card;
use Illuminate\Support\Facades\DB;
use Goutte\Client;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/admin/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return Redirect::route('home');
    }

    public function importTopdeck (){

        $cards = DB::table('cards')->where('set', 'dom')->get();
        $result = "";

        foreach ($cards as $card){
            $query = $card->name;
            $value = $card->scryfall_id;
            $result = $result . $this->scrapeTopDeck($query, $value);
        }


        return $result;
    }

    public function scrapeTopDeck($query, $value)
    {
        $result = "";
        $stock = 0;
        $price= "";
        $q = $query;
        $retailer = 3;

        $client = new Client();
        $url = "https://store.topdecksa.co.za/search?q=" . $q;
        $crawler = $client->request('GET', $url);

        $crawler->filter('div.grid-item.small--one-whole.text-center > div')->
        each(function ($mainNode) use (&$price, &$stock) {
            $mainNode->filter("span.product-item__price")->
            each(function($node) use (&$price, &$stock){
                $price = $node->html();

                $price=preg_replace('/\s+/', '', $price);
                $price=preg_replace('/R/', '', $price);
                $price = (float)$price;


                $stock++;
            });
        });

        if ($stock != 0) {
            $card = Card::where('scryfall_id', $value)->first();
            $cardId = $card->id;

            Log::info("Adding or Updating Product", ['scryfall_id'=> $value, 'card_id' => $cardId, 'retailer' => $retailer, ]);
            $this->addProduct($cardId,$retailer,$price, $stock);

            return $result;
        }
        return $result;

    }

    public function addProduct($card, $retailer, $price, $stock){
        Product::updateOrCreate(['card_id' => $card, 'retailer_id' => $retailer], [
            'card_id' => $card,
            'retailer_id' => $retailer,
            'price' => $price,
            'stock' => $stock,
        ]);

       /* $product = Product::firstOrNew(['card_id' => $card, 'retailer_id' => $retailer]);

        $product->card_id = $card;
        $product->retailer_id = $retailer;
        $product->price = $price;
        $product->stock = $stock;
        $product->save();*/

    }

    public function getProduct(Request $request){
        $result = [];
        $query = $request->get('query');

        $card = DB::table('cards')->where('name', $query)->first();

        $result = ['name'=>$card->name];

        return $result;
    }
}
