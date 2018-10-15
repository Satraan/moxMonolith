<?php

namespace App\Console\Commands;

use GuzzleHttp\Psr7\Request;
use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeDracoti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:dracoti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //whats gonna happen
        $q = "cast down";
        $price = "No price found";
        $stock = "None";
        $q = urlencode($q);

        $url = "https://dracoti.co.za/wc-api/wc_ps_legacy_api/?action=get_results&q=" . $q . "&cat_in=all&search_in=product";
//        echo $url;

        $crawler = $this->client->request('GET', $url);

        var_dump($crawler);

        echo $crawler->html();

        $crawler->filter('.woocommerce-Price-amount')->each(function ($node) use (&$price){
            $price = $node->html();
            echo $node->html();
        });



//        $request = new Request(
//            "GET",
//                    $url
//        );
//
//        $guzzle = new \GuzzleHttp\Client();
//        $result = $guzzle->send($request);
//        $result = \GuzzleHttp\json_decode($result->getBody()->getContents());
//
//        $result = $result->items[0]->title;
//
//        var_dump($result);



//        echo $result;


    }
}
