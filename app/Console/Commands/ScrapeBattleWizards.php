<?php

namespace App\Console\Commands;

use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeBattleWizards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:battlewizards';

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
        $q = "island";
        $price = "No price found";
        $stock = "None";

        $url = "https://dracoti.co.za/card-search/keyword/" . $q . "/search-in/product/cat-in/all/search-other/product";
//        echo $url;
        $crawler = $this->client->request('GET', $url);

        $crawler->filter('.rs_result_row')->each(function ($node) use (&$price){
            $price = $node->html();
            echo $node->html();
        });

        return 1;

    }
}
