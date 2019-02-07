<?php

namespace App\Services\Scrapers\Objects;


class ScraperReturnObject
{
	public function __construct($data)
	{
		foreach ($data as $key=>$value){
			$this->$key = $value;
		}
	}
	
	public function getPriceRead(){
		if(isset($this->price))
			return "R " . $this->price;
		
		return false;
	}
}