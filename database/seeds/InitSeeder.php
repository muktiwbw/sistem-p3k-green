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
        $user->password = bcrypt('anbuleader');
        $user->department_id = 1;
        $user->save();
        $user = new User;
        $user->nama = 'Mukti WWW';
        $user->username = 'muktiwww';
        $user->password = bcrypt('anbuleader');
        $user->department_id = 2;
        $user->save();
        $user = new User;
        $user->nama = 'AAAZZZ';
        $user->username = 'aaazzz';
        $user->password = bcrypt('anbuleader');
        $user->department_id = 3;
        $user->save();

        $obat = new Obat;
        $obat->nama = 'Obat A';
        $obat->stok = 11;
        $obat->expirable = true;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat B';
        $obat->stok = 13;
        $obat->expirable = true;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Gunting';
        $obat->stok = 20;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat C';
        $obat->stok = 21;
        $obat->expirable = true;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Kasa';
        $obat->stok = 10;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat D';
        $obat->stok = 33;
        $obat->expirable = true;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Obat E';
        $obat->stok = 10;
        $obat->expirable = true;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $obat = new Obat;
        $obat->nama = 'Perban';
        $obat->stok = 22;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();
        
        $obat = new Obat;
        $obat->nama = 'Kapas';
        $obat->stok = 19;
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

    }
}
