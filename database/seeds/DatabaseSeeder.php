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

//Warning: this is about 42000 rows big
         $this->call(CardTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(RetailersTableSeeder::class);
//
//        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
//        // User seeder will use the roles above created.
        $this->call(UsersTableSeeder::class);
    }
}
