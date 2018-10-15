<?php

use Illuminate\Database\Seeder;
use App\Retailer;
use Illuminate\Support\Facades\Hash;

class RetailersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Retailer::create([
            'id' => 1,
            'name' => 'Geekhome',
            'website' => 'www.geekhome.com',
            'query_key' => '+'
        ]);
        Retailer::create([
            'id' => 2,
            'name' => 'SadRobot',
            'website' => 'www.sadrobot.com',
            'query_key' => '-'
        ]);
    }
}
