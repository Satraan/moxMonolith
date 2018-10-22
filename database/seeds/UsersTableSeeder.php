<?php

use App\Role;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_admin = Role::where('name', 'admin')->first();
        $role_user  = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Mandia';
        $admin->email = 'mandiasamuels@gmail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'John';
        $user->email = 'john.roux1@gmail.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);

    }
}
