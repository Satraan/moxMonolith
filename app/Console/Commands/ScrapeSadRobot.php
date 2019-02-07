<?php

namespace App\Console\Commands;

use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeSadRobot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:sadrobot';

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
        $q = "cast down";
        $q=preg_replace('/\s+/', '-', (string)$q);

        $price = "No price found";
        $stock = "None";

        $url = "https://sadrobot.co.za/shop/" . $q;
//        echo $url;
        $crawler = $this->client->request('GET', $url);

//        $crawler->filter('p.price > .amount')->each(function ($node) use (&$price){
//            $price = $node->html();
//            echo $node->html();
//        });

        $crawler->filter('p.price > .amount')->each(function ($node) use (&$price, &$stock){
            echo $node->html();
            $price = $node->text();
            $stock++;
        });

        return 1;

    }
}
