<?php

namespace App\Services\Contracts;

use App\Card;

/**
 * Interface ScraperContract
 *
 * @package App\Services\Contracts
 */
interface ScraperContract
{
	
	/**
	 * @param $card
	 * @param $scryfallId
	 * @return mixed
	 */
	public function findCard($card, $scryfallId = null);
	
}