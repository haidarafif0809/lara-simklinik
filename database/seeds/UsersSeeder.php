<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

       $admin =  User::create(['name' => 'admin' ,'email' => 'admin@gmail.com','password' => 'rahasia']);
       $member = User::create(['name' => 'member' ,'email' => 'member@gmail.com','password' => 'rahasia']);

         // Membuat role admin
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        $admin->attachRole($adminRole);

        // Membuat role member
        $memberRole = new Role();
        $memberRole->name = "member";
        $memberRole->display_name = "Member";
        $memberRole->save();

            $member->attachRole($memberRole);

    }
}
