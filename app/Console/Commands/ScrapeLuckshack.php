<?php

namespace App\Console\Commands;

use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeLuckshack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:luckshack';

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
        $q = "opt";
        $price = "No price found";
        $stock = "None";

        $url = "https://luckshack.co.za/index.php?main_page=advanced_search_result&search_in_description=1&zenid=f6aa7db99b99f1416d42074f57e575c5&keyword=" . $q ;
//        echo $url;
        $crawler = $this->client->request('GET', $url);

        $crawler->filter('h3.itemTitle')->each(function ($node) use (&$price){
            $price = $node->html();
            echo $node->text();
        });

        return 1;

    }
}
