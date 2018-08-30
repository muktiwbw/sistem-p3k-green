<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Kotak;
use App\IsiKotak;
use Auth;

class ObatController extends Controller
{
    public function form_create_obat(){
        return view('obat.form_create_obat');
    }

    public function proses_create_obat(Request $request){
        $obat = new Obat;
        $obat->nama = $request->nama;
        $obat->stok = $request->stok;
        if($request->expirable != null){
            $obat->expirable = true;
        }
        $obat->tgl_restok = date('Y-m-d');
        $obat->save();

        $kotaks = Kotak::all();

        foreach($kotaks as $kotak){
            $isi_kotak = new IsiKotak;
            $isi_kotak->kotak_id = $kotak->id;
            $isi_kotak->obat_id = $obat->id;
            $isi_kotak->save();
        }

        return redirect('/obat');
    }

    public function show_all_obat(){
        $obats = Obat::all();

        $data = [
            'obats' => $obats
        ];

        return view('obat.list_all_obat', $data);
    }

    public function show_obat($id){
        $obat = Obat::find($id);

        $data = [
            'obat' => $obat
        ];

        return view('obat.detail_obat', $data);
    }

    public function form_edit_obat($id){
        $obat = Obat::find($id);

        $data = [
            'obat' => $obat
        ];

        return view('obat.form_edit_obat', $data);
    }

    public function proses_edit_obat($id, Request $request){
        $obat = Obat::find($id);

        $obat->nama = $request->nama;
        // Jika jumlah yang diinput lebih besar dari di database (yang berarti restok)
        if($obat->stok < $request->stok){
            // Update tanggal restok
            $obat->tgl_restok = date('Y-m-d');
        }
        $obat->stok = $request->stok;
        $obat->save();

        return redirect('/obat/'.$id);
    }

    public function proses_delete_obat($id){
        $obat = Obat::find($id);
        $obat->delete();

        return redirect('/obat');
    }

}
