<?php

namespace App\Services\Scrapers;

use App\Services\Contracts\ScraperContract;
use App\Card;
use App\Services\Scrapers\Objects\ScraperReturnObject;
use Goutte\Client;


/**
 * Class LuckshackScraperService
 *
 * @package App\Services\Scrapers
 */
class GeekhomeScraperService implements ScraperContract
{


	/**
	 * @var string
	 */
	protected  $url = "https://www.geekhome.co.za/product/";

	protected $vendor = "Geekhome";
	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * GeekhomeScraperService constructor.
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

        $name = (string)$name;
        $name = preg_replace('/\s+/', '-', $name);

		$url = $this->url . $name;
		$crawler = $this->client->request('GET', $url);

        $crawler->filter('div.product_cat-mtg-singles > div.entry-summary > p.price > span.woocommerce-Price-amount')->each(function ($node) use (&$price, &$stock){
            $price = $node->text();
            $stock++;
        });

        $returnObject->price = $price;
        $returnObject->stock = $stock;
		return $returnObject;
	}

}
