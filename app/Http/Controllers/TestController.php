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

class TestController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function add(Request $request)
    {
        $q = $request->get('query');
        $card = Card::where('scryfall_id', '=', $q)->first();


        $wishlistId = 1;




        $wishlist = Wishlist::findOrFail($wishlistId);

        //Adds the card to the wishlist
        $wishlist->cards()->attach([$card->id]);


    }

    public function scrapeTopDeck(Request $request)
    {
        $stock = 0;
        $price= "";
        $q = $request->get('query');

//        $q=preg_replace('/\s+/', '+', (string)$q);


        $client = new Client();
        $url = "https://store.topdecksa.co.za/search?q=" . $q;
        $crawler = $client->request('GET', $url);

        $crawler->filter('div.grid-item.small--one-whole.text-center > div')->
        each(function ($node) use (&$price, &$stock) {
            $node->filter("span.product-item__price")->
            each(function($node) use (&$price, &$stock){
                $price = $price . "||" . $node->html();
                $stock++;
            });
        });

        $price=preg_replace('/\s+/', '', $price);

        return "Query: " . $q . ", Stock: " . $stock . ", Price: " . $price;
    }
    public function scrapeDracoti(Request $request)
    {
        $stock = 0;
        $price= "";
        $q = $request->get('query');

        $q = (string)$q;
        $q=preg_replace('/\s+/', '+', $q);

        $client = new Client();https://dracoti.co.za/wc-api/wc_ps_legacy_api/?action=get_results&q=island&cat_in=all&search_in=product&ps_lang=&psp=1
        $url = "https://store.topdecksa.co.za/search?q=" . $q;
        $crawler = $client->request('GET', $url);

        $crawler->filter('div.grid-item.small--one-whole.text-center > div')->
        each(function ($node) use (&$price, &$stock) {
            $node->filter("span.product-item__price")->
            each(function($node) use (&$price, &$stock){
                $price = $price . "||" . $node->html();
                $stock++;
            });
        });

        $price=preg_replace('/\s+/', '', $price);

        return "Query: " . $q . ", Stock: " . $stock . ", Price: " . $price;
    }
    public function scrapeSadRobot(Request $request)
    {
        $stock = 0;
        $price= "";
        $q = $request->get('query');

        $q = (string)$q;
        $q=preg_replace('/\s+/', '-', $q);

        $client = new Client();
        $url = "https://sadrobot.co.za/shop/" . $q;
        $crawler = $client->request('GET', $url);

        $crawler->filter('p.price > .amount')->each(function ($node) use (&$price, &$stock){
            $price = $node->text();
            $stock++;
        });


        return "Query: " . $q . ", Stock: " . $stock . ", Price: " . $price;
    }
    public function scrapeGeekhome(Request $request)
    {
        $stock = 0;
        $price= "";
        $client = new Client();

        $q = $request->get('query');
        $q = (string)$q;
        $q = preg_replace('/\s+/', '-', $q);

        $url = "https://www.geekhome.co.za/product/" . $q;

        $crawler = $client->request('GET', $url);

        $crawler->filter('div.product_cat-mtg-singles > div.entry-summary > p.price > span.woocommerce-Price-amount')->each(function ($node) use (&$price, &$stock){
            $price = $node->text();
            $stock++;
        });

        $price=preg_replace('/R/', '', $price);
        $price = (float)$price;

        $value = $request->get('value');

        if ($price == 0) {
            return "Query: " . $q . "No stock found.";
        }
        else {
            $card = DB::table('cards')->where('scryfall_id' , '=', $value)->first();
            DB::table('products')->insert(
                ['card_id' => $card->id, 'retailer_id' => 1, 'price' => $price]
            );

            return "Query: " . $q . ", Stock: " . $stock . ", Price: " . $price;
        }



    }

    public function stock(){
        //Select all Cards that have wishlist
        $cards = Card::whereHas('wishlists')->get();
        return view("stock",compact('cards'));
    }
}
