<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use Auth;

class UserController extends Controller
{
    public function form_login(){
        return view('user.login');
    }

    public function proses_login(Request $request){
        // Ambil username dan password dari request
        // $username = $request->username;
        // $password = $request->password;

        // only() untuk mengambil input form dan dijadikan bentuk array
        $login = $request->only('username', 'password');
        // [
        //     'username' => $username,
        //     'password' => $password,
        // ]

        // Autentikasi user
        // attempt() butuh parameter berupa array dari atribut tabel user
        if(Auth::attempt($login)){
            return redirect('/isi_kotak/update_expired');
        }else{
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function dashboard(){
        return view('user.dashboard');
    }

    public function form_register(){
        // Ngambil semua data di tabel department
        // all() untuk mengambil semua data pada tabel
        $d = Department::all();

        // Dijadikan array untuk ditampilkan di view
        // $data adalah nama array
        // $a = [1,2,3,4]
        // $a[0]
        // $a[2]
        // $b = [
        //     'satu' => 1,
        //     'dua' => 2,
        // ]
        // $b['satu']
        // Yang digunakan di view adalah key dari association array, yaitu departments.
        $data = [
            'departments' => $d
        ];
        // pada view, $data['departments'] diubah menjadi variabel $departments
            
        return view('user.form_create_user', $data);
    }

    public function proses_register(Request $request){
        // Insert
        $user = new User;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->department_id = $request->department_id;
        $user->save();

        return redirect('/');
    }

    public function show_all_user(){
        $users = User::where('admin', false)->get();
        
        $data = [
            'users' => $users
        ];

        return view('user.list_all_user', $data);
    }

    public function show_user($id){
        // find() mencari data berdasarkan ID / primary key
        $user = User::find($id);
        
        $data = [
            'user' => $user
        ];

        return view('user.detail_user', $data);
    }

    public function form_edit($id){
        if(!Auth::user()->admin && Auth::user()->id != $id) return redirect('/dashboard');
        
        // Select
        $user = User::find($id);

        // Data yang mau ditampilkan di view
        $data = [
            'user' => $user
        ];

        return view('user.form_edit_user', $data);
    }

    public function proses_edit($id, Request $request){
        // Select
        $user = User::find($id);

        // Update
        $user->nama = $request->nama;
        $user->username = $request->username;
        if($request->password != ""){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect('/dashboard');
    }

    public function proses_delete($id){
        // Select user
        $user = User::find($id);

        // Delete user
        $user->delete();

        return redirect('/user');
    }
}
