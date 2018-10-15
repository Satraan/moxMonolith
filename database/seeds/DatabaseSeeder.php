<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


         $this->call(CardTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(RetailersTableSeeder::class);
    }
}
