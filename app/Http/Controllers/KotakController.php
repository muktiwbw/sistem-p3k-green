<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kotak;
use App\IsiKotak;
use App\Obat;
use App\User;
use App\Department;

class KotakController extends Controller
{
    public function form_create_kotak(){
        // Untuk mencari user yang tidak sedang memegang tanggung jawab kotak
        $users = User::where('admin', false)->whereDoesntHave('kotak')->orderBy('department_id')->get();

        $data = [
            'users' => $users,
        ];

        return view('kotak.form_create_kotak', $data);
    }

    public function proses_create_kotak(Request $request){
        // Hitung jumlah row dalam tabel kotak
        $count = Kotak::count();

        // if($count == 0){
        //     $max_id = 1;
        // }else{
        //     $max_id = Kotak::max('id') + 1;
        // }
        // Jika tabel kosong, maka beri nilai 1. Jika tidak kosong, beri nilai id tertinggi ditambah 1.
        $next_id = ($count == 0) ? 1 : Kotak::max('id') + 1;

        // Misal
        // $next_id = 2;
        // echo "$next_id" // 2
        // echo '$next_id' // $next_id

        $kotak = new Kotak;
        $kotak->id = $next_id;
        $kotak->bagian = $request->bagian;
        $kotak->lokasi = $request->lokasi;
        $kotak->user_id = $request->user_id;
        $kotak->save();

        foreach(Obat::all() as $obat){
            $isiKotak = new IsiKotak;
            $isiKotak->kotak_id = $next_id;
            $isiKotak->obat_id = $obat->id;
            $isiKotak->save();
        }

        return redirect('/kotak');
    }

    public function show_all_kotak(){
        $kotaks = Kotak::all();

        $data = [
            'kotaks' => $kotaks
        ];

        return view('kotak.list_all_kotak', $data);
    }

    public function show_kotak($id){
        $kotak = Kotak::find($id);

        $data = [
            'kotak' => $kotak
        ];

        return view('kotak.detail_kotak', $data);
    }

    public function form_edit_kotak($id){
        $kotak = Kotak::find($id);
        
        $users;
        // Mencari user yang tidak memiliki kotak dan yang memegang kotak tersebut
        if($kotak->user_id != null){
            $users = User::where('admin', false)->whereDoesntHave('kotak')->orWhere('id', $kotak->user->id)->orderBy('department_id')->get();
        }else{
            $users = User::where('admin', false)->whereDoesntHave('kotak')->orderBy('department_id')->get();
        }
        $departments = Department::all();

        $data = [
            'kotak' => $kotak,
            'users' => $users,
            'departments' => $departments
        ];

        return view('kotak.form_edit_kotak', $data);
    }

    public function proses_edit_kotak($id, Request $request){
        $kotak = Kotak::find($id);

        $kotak->bagian = $request->bagian;
        $kotak->lokasi = $request->lokasi;
        $kotak->user_id = $request->user_id;
        $kotak->save();

        return redirect('/kotak/'.$id);
    }

    public function proses_delete_kotak($id){
        $kotak = Kotak::find($id);
        $kotak->delete();

        return redirect('/kotak');
    }
}
