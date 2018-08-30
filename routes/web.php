<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Middleware yang digunakan:
 * 1. guest - Diambil dari file pada app/Http/Middleware/RedirectIfAuthenticated.php
 *            Hanya dapat diakses oleh pengguna yang tidak sedang login. Digunakan untuk mengalihkan pengguna yang sedang login supaya tidak dapat mengakses URL pada group tersebut.
 * 
 * 2. login - Diambil dari file pada app/Http/Middleware/AuthMiddleware.php
 *            Hanya dapat diakses oleh pengguna yang sedang login. Digunakan untuk mengalihkan pengguna yang tidak sedang login supaya tidak dapat mengakses URL pada group tersebut.
 *            Memiliki parameter tambahan, yaitu:
 *            0, yaitu dapat diakses oleh USER biasa
 *            1, yaitu dapat diakses oleh ADMIN
 *            Jika tidak memiliki parameter maka group tersebut dapat diakses oleh USER dan ADMIN.
 */

// Group URL yang dapat diakses oleh pengunjung (pengguna yang tidak sedang login)
Route::group([
    'middleware' => 'guest'
], function(){
    // Menampilkan form login user dan admin
    Route::get('/', 'UserController@form_login');
    // Melakukan proses login
    Route::post('/', 'UserController@proses_login');

    // Menampilkan form registrasi user
    Route::get('/register', 'UserController@form_register');
    // Melakukan proses registrasi
    Route::post('/register', 'UserController@proses_register');
});

// Group URL yang dapat diakses oleh USER
Route::group([
    'middleware' => 'login:0'
], function(){
    // Menampilkan form pengajuan order obat
    Route::get('/order/create', 'OrderController@form_create_order_obat');
    // Melakukan proses pembuatan order obat ke ADMIN
    Route::post('/order/create', 'OrderController@proses_create_order_obat');

    // Menampilkan form untuk update status obat pada kotak dengan menandai obat tersebut habis
    Route::get('/isi_kotak/{id_kotak}/edit', 'IsiKotakController@form_edit_isi_kotak');
    // Melakukan proses update status obat
    Route::post('/isi_kotak/{id_kotak}/edit', 'IsiKotakController@proses_edit_isi_kotak');
});

// Group URL yang dapat diakses oleh ADMIN
Route::group([
    'middleware' => 'login:1'
], function(){
    // Menampilkan form registrasi kotak
    Route::get('/kotak/create', 'KotakController@form_create_kotak');
    // Melakukan proses registrasi kotak ke database
    Route::post('/kotak/create', 'KotakController@proses_create_kotak');

    // Menampilkan form edit kotak
    Route::get('/kotak/{id}/edit', 'KotakController@form_edit_kotak');
    // Melakukan proses edit kotak
    Route::post('/kotak/{id}/edit', 'KotakController@proses_edit_kotak');
    
    // Melakukan proses penghapusan kotak pada database
    Route::get('/kotak/{id}/delete', 'KotakController@proses_delete_kotak');
    
    // Menampilkan form registrasi department
    Route::get('/department/create', 'DepartmentController@form_create_department');
    // Melakukan proses registrasi department ke database
    Route::post('/department/create', 'DepartmentController@proses_create_department');

    // Menampilkan form edit department
    Route::get('/department/{id}/edit', 'DepartmentController@form_edit_department');
    // Melakukan proses edit department
    Route::post('/department/{id}/edit', 'DepartmentController@proses_edit_department');
    
    // Melakukan proses penghapusan department pada database
    Route::get('/department/{id}/delete', 'DepartmentController@proses_delete_department');
    
    // Menampilkan form registrasi obat
    Route::get('/obat/create', 'ObatController@form_create_obat');
    // Melakukan proses registrasi obat ke database
    Route::post('/obat/create', 'ObatController@proses_create_obat');    

    // Menampilkan form edit obat
    Route::get('/obat/{id}/edit', 'ObatController@form_edit_obat');
    // Melakukan proses edit obat
    Route::post('/obat/{id}/edit', 'ObatController@proses_edit_obat');
    
    // Melakukan proses pengahapusan obat pada database
    Route::get('/obat/{id}/delete', 'ObatController@proses_delete_obat');

    // Menampilkan semua data USER pada database
    Route::get('/user', 'UserController@show_all_user');
    // Menampilkan data USER tertentu pada database
    Route::get('/user/{id}', 'UserController@show_user');

    // Melakukan proses penghapusan USER pada database
    Route::get('/user/{id}/delete', 'UserController@proses_delete');

    // Menampilkan semua data order obat pada database
    Route::get('/order', 'OrderController@show_all_order_obat');

    // Menampilkan form persetujuan order obat dari USER
    Route::get('/order/{id_order}/approve', 'OrderController@form_approve_order_obat');
    // Menyetujui order obat dari USER
    Route::post('/order/{id_order}/approve', 'OrderController@proses_approve_order_obat');

    // Menolak order obat dari USER
    Route::get('/order/{id_order}/reject', 'OrderController@proses_reject_order_obat');

    // Menampilkan rekap order obat dari USER
    Route::get('/order/rekap', 'OrderController@show_rekap_order');
});

// Group URL yang dapat diakses oleh USER dan ADMIN
Route::group([
    'middleware' => 'login'
], function(){
    // Menampilkan halaman utama untuk pengguna yang login
    Route::get('/dashboard', 'UserController@dashboard');
    
    // Melakukan proses logout atau keluar
    Route::get('/logout', 'UserController@logout');
    
    // Menampilkan form edit user. USER hanya dapat mengedit datanya sendiri, sedangkan ADMIN dapat mengubah semua data USER.
    Route::get('/user/{id}/edit', 'UserController@form_edit');
    // Melakukan proses edit user
    Route::post('/user/{id}/edit', 'UserController@proses_edit');
    
    // Menampilkan semua data department yang terdaftar pada database
    Route::get('/department', 'DepartmentController@show_all_department');
    // Menampilkan detail department tertentu
    Route::get('/department/{id}', 'DepartmentController@show_department');
    
    // Menampilkan semua data kotak yang terdaftar pada database
    Route::get('/kotak', 'KotakController@show_all_kotak');
    // Menampilkan detail kotak tertentu
    Route::get('/kotak/{id}', 'KotakController@show_kotak');

    // Menampilkan semua data obat yang terdaftar pada database
    Route::get('/obat', 'ObatController@show_all_obat');
    // Menampilkan detail obat tertentu
    Route::get('/obat/{id}', 'ObatController@show_obat');

    // Menampilkan semua data riwayat order obat pada kotak tertentu
    Route::get('/order/{id_kotak}/track', 'OrderController@show_all_track_order');

    // Melakukan proses update status expired pada semua obat pada semua kotak yang terdaftar di database
    Route::get('/isi_kotak/update_expired', 'IsiKotakController@proses_update_expired_isi_kotak');
    
});