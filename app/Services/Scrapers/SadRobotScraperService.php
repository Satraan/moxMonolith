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
class SadRobotScraperService implements ScraperContract
{


	/**
	 * @var string
	 */
	protected $url = "https://sadrobot.co.za/shop/";

	protected $vendor = "SadRobot";
	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * SadRobotScraperService constructor.
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
        $crawler->filter('p.price > .amount')->each(function ($node) use (&$price, &$stock){
            $price = $node->text() . " ";
            $stock++;
        });

        $returnObject->price = $price;
        $returnObject->stock = $stock;
		return $returnObject;
	}

}
