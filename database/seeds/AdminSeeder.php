<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->nama = "Admin";
        $user->username = "admin";
        $user->password = bcrypt("1234");
        $user->admin = true;
        $user->save();
    }
}
