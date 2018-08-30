<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Obat;
use App\User;
use App\Kotak;
use Auth;
use DB;

class OrderController extends Controller
{
    public function form_create_order_obat(){
        $user = Auth::user();

        $data = [
            'user' => $user
        ];

        return view('order.form_create_order_obat', $data);
    }

    public function proses_create_order_obat(Request $request){
        // Insert data order
        $order = new Order;
        $order->kotak_id = Auth::user()->kotak->id;
        $order->tgl_status = date('Y-m-d');
        $order->save();

        // Insert data order item sesuai dengan checkbox pada form
        foreach($request->isi_kotak_id as $i => $isi_kotak_id){
            $orderItem = new OrderItem;
            $orderItem->isi_kotak_id = $isi_kotak_id;
            $orderItem->jumlah = $request->number[$i];
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        return redirect('/kotak/'.$order->kotak_id);
    }

    public function show_all_order_obat(){
        $orders = Order::all();

        $data = [
            'orders' => $orders
        ];

        return view('order.list_all_order_obat', $data);
    }

    public function show_all_track_order($id){
        $kotak = Kotak::find($id);

        $data = [
            'kotak' => $kotak
        ];

        return view('order.list_all_track_order', $data);
    }

    public function form_approve_order_obat($id){
        $order = Order::find($id);

        $data = [
            'order' => $order
        ];

        return view('order.form_approve_order_obat', $data);
    }

    public function proses_approve_order_obat($id, Request $request){
        foreach ($request->order_item_id as $i => $order_item_id) {
            $isi_kotak = OrderItem::find($order_item_id)->isiKotak;

            // if(time() >= strtotime($request->tgl_expired[$i])){
            //     $isi_kotak->ada = false;
            // }else{
            //     $isi_kotak->ada = true;
            // }
            if($request->tgl_expired[$i] != 0){
                $isi_kotak->expired = (time() >= strtotime($request->tgl_expired[$i])) ? true : false;
                $isi_kotak->tgl_expired = $request->tgl_expired[$i];
            }
            $isi_kotak->ada = ($request->tgl_expired[$i] != 0 && time() >= strtotime($request->tgl_expired[$i])) ? false : true;
            $isi_kotak->save();

            $obat = Obat::find($isi_kotak->obat->id);
            $obat->stok = $obat->stok - 1;
            $obat->save();
        }

        $order = Order::find($id);
        // 0 = pending
        // 1 = approved
        // 2 = rejected
        $order->status = 1;
        $order->tgl_status = date('Y-m-d');
        $order->save();

        return redirect('/order');
    }

    public function proses_reject_order_obat($id){
        $order = Order::find($id);
        $order->status = 2;
        $order->tgl_status = date('Y-m-d');
        $order->save();

        return redirect('/order');
    }

    public function show_rekap_order(){
        $obats = DB::table('order_items')
                            ->join('isi_kotaks', 'order_items.isi_kotak_id', '=', 'isi_kotaks.id')
                            ->join('obats', 'isi_kotaks.obat_id', '=', 'obats.id')
                            ->select('obats.nama', DB::raw('count(order_items.id) as total'))
                            ->groupBy('obats.nama')
                            ->orderBy('total', 'desc')
                            ->limit(Obat::count())
                            ->get();
        
        $departments = DB::table('order_items')
                            ->join('isi_kotaks', 'order_items.isi_kotak_id', '=', 'isi_kotaks.id')
                            ->join('kotaks', 'isi_kotaks.kotak_id', '=', 'kotaks.id')
                            ->join('users', 'kotaks.user_id', '=', 'users.id')
                            ->join('departments', 'users.department_id', '=', 'departments.id')
                            ->select('departments.nama', DB::raw('count(order_items.id) as total'))
                            ->groupBy('departments.nama')
                            ->orderBy('total', 'desc')
                            ->limit(10)
                            ->get();

        $data = [
            'obats' => $obats,
            'departments' => $departments
        ];

        return view('order.show_rekap_order', $data);
    }
}
