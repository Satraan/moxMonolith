<?php

namespace App\Services\Scrapers;

use App\Services\Contracts\ScraperContract;
use App\Card;
use App\Services\Scrapers\Objects\ScraperReturnObject;
use Goutte\Client;


/**
 * Class DracotiScraperService
 *
 * @package App\Services\Scrapers
 */
class DracotiScraperService implements ScraperContract
{


	/**
	 * @var string
	 */
	protected $url = "https://shop.dracoti.co.za/product/";

	protected $vendor = "Dracoti";
	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * DracotiScraperService constructor.
	 */
	public function __construct()
	{
		$this->client = new Client();
	}


	/**
	 * @param $name
	 * @param $scryfallId
	 * @return string
	 */
	public function findCard($name, $scryfallId = null){

		// ToDo - Check based on the scryfallID if we have data on this card cached.

		$returnObject = new ScraperReturnObject(
			[
				'vendor' => $this->vendor,
				'name' => $name,
				'scryfallId' => $scryfallId,
				'price' => 0,
				'stock' => 0
			]);

		//Clean up the card name query
        $name = (string)$name;
        $name = preg_replace('/\s+/', '-', $name);
        $name = preg_replace('/,/', '', $name);

		$url = $this->url . $name;

		$crawler = $this->client->request('GET', $url);
        $crawler->filter('div.instock.purchasable > .entry-summary')->each(function ($node) use (&$returnObject) {
            $node->filter("p.price > .amount")->each(function($node) use (&$returnObject){
                $returnObject->price = $node->text();
            });
            $node->filter("p.in-stock")->each(function($node) use (&$returnObject){
                $returnObject->stock = $node->text();
            });
        });

		return $returnObject;
	}

}
