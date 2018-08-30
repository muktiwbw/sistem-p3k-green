<?php

use Illuminate\Database\Seeder;
use App\Department;
use App\User;
use App\Obat;
// use App\Kotak;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = new Department;
        $department->nama = 'Human Resources';
        $department->save();
        $department = new Department;
        $department->nama = 'Information Technology';
        $department->save();
        $department = new Department;
        $department->nama = 'ICU';
        $department->save();

        $user = new User;
        $user->nama = 'Mukti Wibowo';
        $user->username = 'muktiwbw';
        $user->password = bcrypt('1234');
        $user->department_id = 1;        
        $user->no_ext = "089876546723";
        $user->email_bagian = "bag1@gmail.com";
        $user->save();

        $user = new User;
        $user->nama = 'Mukti WWW';
        $user->username = 'muktiwww';
        $user->password = bcrypt('1234');
        $user->department_id = 2;
        $user->no_ext = "089789039482";
        $user->email_bagian = "bag2@gmail.com";
        $user->save();
        
        $user = new User;
        $user->nama = 'AAAZZZ';
        $user->username = 'aaazzz';
        $user->password = bcrypt('1234');
        $user->department_id = 3;
        $user->no_ext = "098787848321";
        $user->email_bagian = "bag3@gmail.com";
        $user->save();

        $obat = new Obat;
        $obat->nama = 'Obat A';
        $obat->expirable = true;
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat B';
        $obat->expirable = true;
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Gunting';
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat C';
        $obat->expirable = true;
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Kasa';
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat D';
        $obat->expirable = true;
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat E';
        $obat->expirable = true;
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Perban';
        $obat->save();
        
        $obat = new Obat;
        $obat->nama = 'Kapas';
        $obat->save();

    }
}
