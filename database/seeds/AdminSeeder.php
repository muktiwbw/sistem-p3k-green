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
        $user->no_ext = "089738471623";
        $user->email_bagian = "admin@gmail.com";
        $user->save();
    }
}
