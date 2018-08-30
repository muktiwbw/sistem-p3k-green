<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import model Department agar dapat digunakan dengan eloquent.
use App\Department;

class DepartmentController extends Controller
{
    // Fungsi untuk menampilkan form registrasi department.
    public function form_create_department(){
        // Menampilkan view dari file views/department/form_create_department.blade.php.
        return view('department.form_create_department');
    }

    // Fungsi untuk melakukan proses registrasi department.
    // Fungsi ini menampung parameter $request yang didapat dari form pada 
    // view form_create_department.blade.php.
    public function proses_create_department(Request $request){
        // Membuat object class model Department dengan nama variabel $department.
        $department = new Department;
        // Mengisi atribut nama pada tabel departments yang direpresentasikan oleh property nama 
        // pada object $department dengan nilai nama pada form yang ditangkap oleh variabel $request.
        $department->nama = $request->nama;
        // Menyimpan data department ke database.
        $department->save();

        // Mengalihkan pengguna ke URL /department.
        return redirect('/department');
    }

    /**
     * Catatan 1 - Model
     * Model dapat dianalogikan sebagai class yang menjembatani sistem dengan database.
     * Class model memiliki property-property dengan nama yang sama dengan nama atribut-atribut
     * pada tabel database. Hal ini memungkinkan kita untuk dapat langsung mengakses nilai mereka
     * atau untuk memberikan nilai baru.
     */

    // Fungsi untuk menampilkan semua data department pada database.
    public function show_all_department(){
        // Mengakses fungsi eloquent all() pada class model untuk mendapatkan semua data pada database.
        $departments = Department::all();

        // Membuat array asosiasi (association array) bernama $data yang digunakan untuk 
        // menampung data $departments yang nantinya akan ditampilkan pada view.
        $data = [
            'departments' => $departments
        ];

        // Menampilkan view dari file views/department/list_all_department.blade.php
        // dengan mengirimkan variabel $data yang akan ditampilkan di view tersebut.
        return view('department.list_all_department', $data);
    }

    /**
     * Catatan 2 - Fungsi eloquent
     * Fungsi-fungsi eloquent pada Laravel dapat langsung diakses dari class model tanpa harus
     * membuat object dari class model tersebut terlebih dahulu.
     * Hal ini karena mereka menggunakan Scope Resolution Operator atau Double Colon (::)
     * yang memungkinkan kita untuk mengakses method/fungsi pada suatu class tanpa harus
     * membuat object class tersebut terlebih dahulu.
     */

    /**
     * Catatan 3 - Variabel views
     * Variabel-variabel yang ditampilkan di view diakses dengan menggunakan variabel nama key
     * pada array asosiasi yang ditempatkan pada parameter ke-dua pada return fungsi view().
     * 
     * Contoh:
     * $data = [
     *   'department' => 'AAAA',
     *   'bagian' => 'BBBB',
     *   'lokasi' => 'CCCC'
     * ];
     *
     * Maka penggunaan ketiga variabel tersebut adalah 
     * menggunakan variabel $department, $bagian, dan $lokasi.
     */

    // Fungsi untuk menampilkan departement yang memiliki id dengan nilai tertentu.
    // Pencarian data dilakukan berdasarkan id yang diberikan oleh pengguna melalui link pada view.
    public function show_department($id){
        // Menggunakan fungsi find() untuk mencari satu data dari database yang memiliki
        // ID/primary key tertentu. 
        // Fungsi find() ini hanya menerima parameter primary key saja.
        $department = Department::find($id);

        $data = [
            'department' => $department
        ];

        return view('department.detail_department', $data);
    }

    /**
     * Catatan 4 - Fungsi find()
     * Fungsi ini digunakan untuk mencari SATU data dengan parameter PRIMARY KEY.
     * Oleh karenanya fungsi ini hanya akan mengembalika SATU data saja.
     * 
     * Fungsi ini berbeda dengan where() dimana fungsi where() menerima parameter atribut apa saja,
     * sehingga akan ada kemungkinan data yang ditemukan lebih dari satu. Oleh karena itu
     * fungsi where() akan mengembalikan array yang berisi kumpulan data. Penggunaan fungsi
     * where() diikuti dengan fungsi get() untuk mengambil data tersebut.
     * 
     * Jika yakin bahwa data yang diharapkan hanya ada satu, maka bukan get() yang digunakan,
     * melainkan first(). Ini akan mengambil satu data pertama pada array tersebut.
     * 
     * Contoh penggunaan:
     * $department = Department::find($id);
     * $departments = Department::where('nama', 'like', 'M%')->get();
     * $departments = Department::where('nama', 'like', 'M%')->first();
     */

    // Fungsi untuk menampilkan form edit department.
    // Fungsi ini menerima id department mana yang ingin diedit.
    public function form_edit_department($id){
        $department = Department::find($id);

        $data = [
            'department' => $department
        ];

        return view('department.form_edit_department', $data);
    }

    // Fungsi untuk melakukan proses edit data department.
    // Fungsi ini menerima $id department mana yang ingin diedit dan $request
    // yang berisi data dari form pada view.
    public function proses_edit_department($id, Request $request){
        // Mencari data department yang ingin diedit berdasarkan id department tersebut.
        $department = Department::find($id);

        // Mengisi property nama pada object $department dengan nama baru yang didapat
        // dari form view yang ditampung oleh variabel $request.
        $department->nama = $request->nama;
        // Menyimpan perubahan ke dalam database.
        $department->save();

        return redirect('/department/'.$id);
    }

    /**
     * Catatan 5 - Update data
     * Jika untuk membuat data baru (insert) diharuskan untuk membuat object dari class model,
     * lain halnya untuk update. Untuk melakukan update yang pertama dilakukan adalah
     * dengan mencari data yang diinginkan pada database (hal ini dapat dilakukan dengan
     * find(), where(), atau fungsi lain yang mengembalikan object data dari database), lalu 
     * memberikan nilai baru pada atribut-atribut yang ingin diupdate lewat property
     * dari object tersebut.
     * Setelah pembaruan nilai selesai, maka dilakukan tahap terakhir yaitu melakukan pemanggilan
     * fungsi save() pada object tersebut. Ini dilakukan untuk menyimpan data tersebut ke database.
     */

    // Fungsi untuk melakukan penghapusan data department.
    // Fungsi ini menerima parameter $id department yang ingin dihapus.
    public function proses_delete_department($id){
        // Mencari data department yang ingin dihapus pada database berdasarkan $id department.
        $department = Department::find($id);
        // Melakukan pemanggilan fungsi delete() pada object department.
        $department->delete();

        return redirect('/department');
    }

    /**
     * Catatan 6 - Delete data
     * Untuk melakukan penghapusan data cukup dengan mengambil data yang ingin dihapus pada database
     * lalu melakukan pemanggilan fungsi delete().
     */
}