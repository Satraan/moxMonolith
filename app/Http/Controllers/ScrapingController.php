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

class ScrapingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function scrapeTopDeck(Request $request)
    {
        $result = "";
        $stock = 0;
        $price= "";
        $q = $request->get('query');

        $client = new Client();
        $url = "https://store.topdecksa.co.za/search?q=" . $q;
        $crawler = $client->request('GET', $url);

        $crawler->filter('div.grid-item.small--one-whole.text-center > div')->
        each(function ($node) use (&$price, &$stock) {
            $node->filter("span.product-item__price")->
            each(function($node) use (&$price, &$stock){
                $price=preg_replace('/\s+/', '', $price);

                $price = $price . $node->html() . ", ";
                $stock++;
            });
        });



        if ($stock == 0) {
            $result = "TopDeck does not have stock.";
            return $result;
        }

        $result = "TopDeck has " . $stock . " " . $q . " in stock for " . $price;
        return $result;
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
        $result = "";
        $stock = 0;
        $price= "";
        $q = $request->get('query');

        $q = (string)$q;
        $q=preg_replace('/\s+/', '-', $q);

        $client = new Client();
        $url = "https://sadrobot.co.za/shop/" . $q;
        $crawler = $client->request('GET', $url);

        $crawler->filter('p.price > .amount')->each(function ($node) use (&$price, &$stock){
            $price = $node->text() . " ";
            $stock++;
        });

        if ($stock == 0) {
            $result = "SadRobot does not have stock.";
            return $result;
        }

        $result = "SadRobot has " . $stock . " " . $q . " in stock for " . $price;
        return $result;
    }
    public function scrapeGeekhome(Request $request)
    {
        $result = "";
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
            $result = "Geekhome does not have stock.";
            return $result;
        }
        else {
            $card = DB::table('cards')->where('scryfall_id' , '=', $value)->first();
            DB::table('products')->insert(
                ['card_id' => $card->id, 'retailer_id' => 1, 'price' => $price]
            );
            $result = "Geekhome has " . $stock . " " . $q . " in stock for " . $price;
            return $result;
        }



    }
}
