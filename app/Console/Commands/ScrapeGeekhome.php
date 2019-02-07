<?php

namespace App\Console\Commands;

use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeGeekhome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:geekhome';

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

        //One print
        $q = "aegis of the heavens";
        $q=preg_replace('/\s+/', '-', (string)$q);

        $price = "No price found";
        $stock = "None";

        $url = "https://www.geekhome.co.za/product/" . $q;
//        echo $url;
        $crawler = $this->client->request('GET', $url);

        $crawler->filter('div.product_cat-mtg-singles > div.entry-summary > p.price > span.woocommerce-Price-amount')->each(function ($node) use (&$price){
            $price = $node->html();
            echo $node->text();
        });



        //Multiple prints
//        //whats gonna happen
//        $q = "aegis of the heavens";
//        $q=preg_replace('/\s+/', '+', (string)$q);
//
//        $price = "No price found";
//        $stock = "None";
//
//        $url = "https://www.geekhome.co.za/?s=" . $q . "&post_type=product";
////        echo $url;
//        $crawler = $this->client->request('GET', $url);
//
//        $crawler->filter('.product_cat-mtg-singles.instock > a > span.price > span.amount')->each(function ($node) use (&$price){
//            $price = $node->html();
//            echo $node->text();
//        });
//
//        return 1;

    }
}
