<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\Scrapers\DracotiScraperService;
use App\Services\Scrapers\GeekhomeScraperService;
use App\Services\Scrapers\LuckshackScraperService;
use App\Services\Scrapers\SadRobotScraperService;
use App\Services\Scrapers\TopDeckScraperService;
use App\Services\Scrapers\UnderworldConnectionsScraperService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;


class ScrapingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $vendor;

    public function __construct()
    {
        $this->vendor =
            [
                'luckshack' => LuckshackScraperService::class,
                'dracoti' => DracotiScraperService::class,
                'topdeck' => TopDeckScraperService::class,
            ];
    }


    public function scrapeVendor(Request $request, $vendor)
    {
        if(!isset($this->vendor[$vendor])){
            abort(404);
        }
		$service = resolve($this->vendor[$vendor]);
		$result = $service->findCard($request->query('query'), $request->query('value'));

	    //ToDo - Move this text response to the FE, and return the whole object here
	    //return json_encode($result);
	    if(!$result->stock)
		    return "$result->vendor doesn't have any stock";

	    if(!$result->price)
	    	return "$result->vendor doesn't have a price listed";

        $this->addProduct($result->scryfallId, $result->vendor, $result->price);

        $endString = isset($result->setName) ? " from set $result->setName." : ".";
	    return "$result->vendor has $result->stock $result->name in stock for {$result->getPriceRead()} " . $endString;
    }
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

        $this->addProduct($result->scryfallId, $result->vendor, $result->price);

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

        $this->addProduct($result->scryfallId, $result->vendor, $result->price);

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

        $this->addProduct($result->scryfallId, $result->vendor, $result->price);

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

        $this->addProduct($result->scryfallId, $result->vendor, $result->price);

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

        $this->addProduct($result->scryfallId, $result->vendor, $result->price);

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
        $price = preg_replace('/R/', '', $price);
        $price = (float)$price;

        $product->card_id = $card;
        $product->retailer_id = $retailer;
        $product->price = $price;


        $product->save();

        //Redirects to list view
        return redirect()->action('WishlistController@list');
    }
}
