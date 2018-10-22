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

        $stock = "";
        $price= "";
        $q = $request->get('query');

        $q = (string)$q;
        $q=preg_replace('/\s+/', '-', $q);

        $client = new Client();https:
        $url = "https://shop.dracoti.co.za/product/" . $q;
        $crawler = $client->request('GET', $url);

        $crawler->filter('div.instock.purchasable > .entry-summary')->
        each(function ($node) use (&$price, &$stock) {
            $node->filter("p.price > .amount")->
            each(function($node) use (&$price, &$stock){
                $price = $price . $node->text();
            });
            $node->filter("p.in-stock")->
            each(function($node) use (&$stock){
                $stock = $node->text();
            });
        });

        $price=preg_replace('/\s+/', '', $price);

        $result = "Dracoti has " . $stock . " for " . $price;
        return $result;
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

        if($client->getResponse()->getStatus()){
            return "Sad Robot does not have stock.";
        }

        $crawler->filter('p.out-of-stock')->each(function ($node) use (&$result){
            $result = $node->text();
        });

        if (!empty($result)){
            return "SadRobot does not have stock.";
        }

        $crawler->filter('p.price > .amount')->each(function ($node) use (&$price, &$stock){
            $price = $node->text() . " ";
            $stock++;
        });

        $result = "SadRobot has " . $stock . " " . $q . " in stock for " . $price;
        return $result;
    }
    public function scrapeUnderworldConnections(Request $request)
    {
        $result = "";
        $isFoil= "";
        $stock = 0;
        $price= "";
        $q = $request->get('query');

        $q = (string)$q;
        $q=preg_replace('/\s+/', '-', $q);

        $client = new Client();

        $url = "https://underworldconnections.com/product/" . $q;
        $crawler = $client->request('GET', $url);

        if($client->getResponse()->getStatus()){
            return "Underworld Connections does not have stock.";
        }

        $finalUrl = $crawler->getUri();
        if (strpos($finalUrl, '-foil') !== false) {
            $isFoil = " and it is foil.";
        }

        $crawler->filter('p.out-of-stock')->each(function ($node) use (&$result){
            $result = $node->text();
        });

        if (!empty($result)){
            return "Underworld Connections does not have stock.";
        }

        if (!$result){
            $crawler->filter('p.price > .amount')->each(function ($node) use (&$price, &$stock){
                $price = $node->text() . " ";
                $stock++;
            });

            $result = "Underworld Connections has " . $stock . " " . $q . " in stock for " . $price . $isFoil;
        }

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
