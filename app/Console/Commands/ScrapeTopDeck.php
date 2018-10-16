<?php

namespace App\Console\Commands;

use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeTopDeck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:topdeck';

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

        $url = "https://store.topdecksa.co.za/search?q=kor+haven";
        $crawler = $this->client->request('GET', $url);
        $counter = 0;
        $crawler->filter('div.grid-item.small--one-whole.text-center > div')->each(function ($node) use (&$counter){
            echo $node->html();
//            $node->filter("span.product-item__price")->each(function($node){
//                $price = $node->html();
////                echo $price;
//            });
            $node->filter("span.product-item__name")->each(function($node){
                $print = $node->html();
//                echo $price;
            });

        });

        echo $counter;
        return 1;

    }
}
