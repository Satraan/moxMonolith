<?php

namespace App\Services\Scrapers;

use App\Services\Contracts\ScraperContract;
use App\Card;
use App\Services\Scrapers\Objects\ScraperReturnObject;
use Goutte\Client;
use Illuminate\Support\Facades\Log;


/**
 * Class LuckshackScraperService
 *
 * @package App\Services\Scrapers
 */
class LuckshackScraperService implements ScraperContract
{


	/**
	 * @var string
	 */
	protected $url = "https://luckshack.co.za/index.php?main_page=advanced_search_result&keyword=";

	protected $vendor = "Luckshack";
	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * LuckshackScraperService constructor.
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

		//$q = preg_replace('/\s+/', '+', (string)$name);
        if(strpos($name, " ") !== false){
            $name = "\"" . $name . "\"";
        }
		$url = $this->url . $name;
		$crawler = $this->client->request('GET', $url);
		$crawler->filter('#catTable tr')->each(function ($node) use (&$returnObject){
			if (strpos($node->html(), 'productListing-heading') === false) {
				// We are not in the heading div

					if(strpos($node->getNode(0)->nodeValue, '... more info') === false){
						// There is stock for the card
                        $data = explode("\n", $node->getNode(0)->nodeValue);
                        $returnObject->setName = trim($data[2]);
                        $returnObject->name = trim($data[3]);
                        $returnObject->stock = (int) trim($data[4]);
                        $returnObject->price = preg_replace( '/Add:/', '', preg_replace('/R/', '', trim($data[5])));
					}
			}
		});

		return $returnObject;
	}

}
