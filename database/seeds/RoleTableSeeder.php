<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            "name" => "Admin",
            "description" => "The super ultra user",
        ]);
        Role::create([
            "name" => "User",
            "description" => "The normal user",
        ]);
  }
}
