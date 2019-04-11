<?php

use Illuminate\Database\Seeder;
use App\Product;
use Illuminate\Support\Facades\Hash;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "card_id" => 1,
            "retailer_id" => 1,
            "price" => 330,
            "stock" => 1
        ]);

    }
}
