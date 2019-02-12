<?php

namespace App\Services\Scrapers;

use App\Services\Contracts\ScraperContract;
use App\Card;
use App\Services\Scrapers\Objects\ScraperReturnObject;
use Goutte\Client;


/**
 * Class TopDeckScraperService
 *
 * @package App\Services\Scrapers
 */
class TopDeckScraperService implements ScraperContract
{


	/**
	 * @var string
	 */
	protected $url = "https://store.topdecksa.co.za/search?q=";

	protected $vendor = "TopDeck";
	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * TopDeckScraperService constructor.
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

		$url = $this->url . $name;

		$crawler = $this->client->request('GET', $url);
        $crawler->filter('div.grid-item.small--one-whole.text-center > div')->each(function ($node) use (&$price, &$stock) {
            $node->filter("span.product-item__price")->each(function($node) use (&$price, &$stock){
                $price=preg_replace('/\s+/', '', $price);
                $price = $price . $node->html() . ", ";
                $stock++;
            });
        });

        $returnObject->price = $price;
        $returnObject->stock = $stock;
		return $returnObject;
	}

}
