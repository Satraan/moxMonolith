<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\Scrapers\DracotiScraperService;
use App\Services\Scrapers\GeekhomeScraperService;
use App\Services\Scrapers\LuckshackScraperService;
use App\Services\Scrapers\SadRobotScraperService;
use App\Services\Scrapers\TopDeckScraperService;
use App\Services\Scrapers\UnderworldConnectionsScraperService;
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

    public function scrapeLuckshack(Request $request)
    {
		$service = resolve(LuckshackScraperService::class);
		$result = $service->findCard($request->query('query'), $request->query('value'));

	    //ToDo - Move this text response to the FE, and return the whole object here
	    //return json_encode($result);
	    if(!$result->stock)
		    return "$result->vendor doesn't have any stock";

	    if(!$result->price)
	    	return "$result->vendor doesn't have a price listed";

	    return "$result->vendor has $result->stock $result->name in stock for {$result->getPriceRead()} from the $result->setName Set";
    }
    public function scrapeDracoti(Request $request)
    {
        $service = resolve(DracotiScraperService::class);
        $result = $service->findCard($request->query('query'), $request->query('value'));

        if(!$result->stock)
            return "$result->vendor doesn't have any stock";
        if(!$result->price)
            return "$result->vendor doesn't have a price listed";

        return "$result->vendor has $result->stock $result->name in stock for {$result->getPriceRead()}";
    }
    public function scrapeTopDeck(Request $request)
    {
        $service = resolve(TopDeckScraperService::class);
        $result = $service->findCard($request->query('query'), $request->query('value'));

        if(!$result->stock)
            return "$result->vendor doesn't have any stock";
        if(!$result->price)
            return "$result->vendor doesn't have a price listed";

        return "$result->vendor has $result->stock $result->name in stock for {$result->getPriceRead()}";
    }
    public function scrapeGeekhome(Request $request)
    {
        $service = resolve(GeekhomeScraperService::class);
        $result = $service->findCard($request->query('query'), $request->query('value'));

        if(!$result->stock)
            return "$result->vendor doesn't have any stock";
        if(!$result->price)
            return "$result->vendor doesn't have a price listed";

        return "$result->vendor has $result->stock $result->name in stock for {$result->getPriceRead()}";
    }
    public function scrapeUnderworldConnections(Request $request)
    {
        $service = resolve(UnderworldConnectionsScraperService::class);
        $result = $service->findCard($request->query('query'), $request->query('value'));

        if(!$result->stock)
            return "$result->vendor doesn't have any stock";
        if(!$result->price)
            return "$result->vendor doesn't have a price listed";

        return "$result->vendor has $result->stock $result->name in stock for {$result->getPriceRead()}";
    }
    public function scrapeSadRobot(Request $request)
    {
        $service = resolve(SadRobotScraperService::class);
        $result = $service->findCard($request->query('query'), $request->query('value'));

        if(!$result->stock)
            return "$result->vendor doesn't have any stock";
        if(!$result->price)
            return "$result->vendor doesn't have a price listed";

        $this->addProduct($result->scryfallId, $result->vendor, $result->price);

        return "$result->vendor has $result->stock $result->name in stock for {$result->getPriceRead()}";
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
}
