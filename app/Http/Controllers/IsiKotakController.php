<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kotak;
use App\IsiKotak;
use App\Order;

class IsiKotakController extends Controller
{
    // Fungsi untuk menampilkan form edit isi kotak.
    // Edit isi kotak disini adalah untuk menandai obat pada suatu kotak
    // bahwa obat tersebut telah habis terpakai.
    public function form_edit_isi_kotak($id){
        // Pengambilan data-data isi kotak dari object kotak berdasarkan $id kotak.
        $isi_kotaks = Kotak::find($id)->isiKotaks;

        $data = [
            'kotak_id' => $id,
            'isi_kotaks' => $isi_kotaks
        ];

        return view('isi_kotak.form_edit_isi_kotak', $data);
    }

    /**
     * Catatan 7 - Relationship
     * Pada fungsi di atas, isiKotaks merupakan data-data isi kotak yang berrelasi dengan
     * kotak bernilai ID tertentu.
     * Dalam kata lain, misalnya suatu kotak memiliki ID dengan nilai 4. Maka isiKotaks merupakan
     * data-data isi kotak yang memiliki kotak_id dengan nilai 4.
     * Dengan fitur ini, kita dapat dengan mudah mencari informasi sebanyak-banyaknya dari suatu
     * data menggunakan relasi-relasinya.
     * 
     * Misalnya kita diminta untuk mencari tahu nama department yang memiliki obat pada kotak tertentu
     * berdasarkan ID isi kotak (obat pada suatu kotak).
     * Solusinya adalah cukup dengan mengambil data isi kotak: 
     * IsiKotak::find($id)->kotak->user->department->nama
     */

    // Fungsi untuk melakukan proses edit/update isi kotak.
    // Fungsi ini menerima parameter $id dan isi_kotak_id pada variabel $request
    // yang didapat dari form pada view.
    public function proses_edit_isi_kotak($id, Request $request){
        // Lakukan looping untuk setiap isi_kotak_id yang masuk.
        foreach($request->isi_kotak_id as $isi_kotak_id){
            // Pada setiap iterasi dilakukan update isi kotak berdasarkan
            // ID isi kotak yang masuk.
            $isi_kotak = IsiKotak::find($isi_kotak_id);
            // Atribut yang diupdate diantaranya adalah ketersediaan obat dan status expired nya
            // yang dibuat dengan nama atribut ada dan expired yang keduanya merupakan tipe data boolean.
            $isi_kotak->ada = false;
            $isi_kotak->expired = false;
            $isi_kotak->save();
        }

        return redirect('/kotak/'.$id);
    }

    /**
     * Catatan 8 - Foreach loop
     * Looping pada PHP ada beberapa macam, diantaranya while loop, for loop, dan foreach loop.
     * Foreach biasa digunakan untuk melakukan iterasi looping 
     * sebanyak jumlah elemen dalam array atau collection.
     * 
     * Jika pada penggunaan for loop:
     * for($i=0; $i<count($array); $i++), dapat disederhanakan dengan foreach loop menjadi:
     * foreach($array as $a)
     * 
     * Pada contoh di atas, $array merupakan variabel array yang menyimpan beberapa elemen array.
     * Sedangkan $a merupakan representasi atau variabel yang mewakili setiap elemen array $array.
     * Variabel $a bukanlah ketetapan, jadi dapat diganti dengan variabel lain.
     * 
     * Contoh:
     * $array = ['apple', 'orange', 'grape', 'banana'];
     * Jika kita ingin menampilkan setiap elemen array pada variabel $array diatas cukup dengan:
     * foreach($array as $a){
     *      echo $a;
     * }
     * 
     * Penggunaan foreach loop diatas dapat digunakan jika kita tidak membutuhkan index dari
     * masing-masing elemen array. Kita juga dapat mengetahui index setiap elemen array dengan
     * foreach loop dengan menggunakan bentuk foreach loop seperti ini:
     * foreach($array as $i => $a)
     * 
     * Dengan bentuk foreach loop seperti diatas, selain mendapatkan nilai setiap array, kita juga
     * mengetahui index setiap elemen pada suatu array.
     * Penggunaan bentuk foreach loop tersebut seperti ini:
     * foreach($array as $i => $a){
     *      echo "Nilai elemen $a terdapat pada index ke-$i";
     * }
     */

    // Fungsi untuk melakukan update status expired setiap obat pada setiap kotak yang
    // terdaftar pada database.
    public function proses_update_expired_isi_kotak(){
        // Mengambil semua data isi kotak pada database yang dimana obat tersebut dapat expired,
        // ketersediaannya ada, dan tanggal expired sudah melewati tanggal sekarang.
        $expired_isi_kotaks = IsiKotak::whereHas('obat', function($query){
            $query->where('expirable', '=', true);
        })->where('ada', '=', true)->where('tgl_expired', '<=', date('Y-m-d'))->get();


        foreach($expired_isi_kotaks as $isi_kotak){
            // Untuk setiap isi kotak update data-data tersebut dimana ketersediaan menjadi kosong
            // dan expired menjadi true.
            $isi_kotak->ada = false;
            $isi_kotak->expired = true;
            $isi_kotak->save();
        }

        // Hapus juga pesanan pending yang tidak memiliki item
        foreach(Order::where('status', 0)->whereDoesntHave('orderItems')->get() as $order){
            $order->delete();
        }

        // Mengalihkan pengguna kembali ke halaman sebelumnya.
        return redirect()->back();
    }

    /**
     * Catatan 9 - date()
     * Fungsi ini digunakan untuk membuat suatu string berdasarkan 
     * suatu waktu (tahun, bulan, hari, jam, menit, detik, milidetik, dst.).
     * 
     * - Jika dipanggil dalam keadaan kosong, maka akan membuat string waktu saat ini 
     * dengan format string default.
     * - Jika dipanggil dengan parameter pertama, yaitu format string, maka akan membuat
     * string waktu saat ini dengan format yang diberikan.
     *      > Y: tahun penuh 4 digit
     *      > m: bulan dalam bentuk angka 1-12
     *      > d: tanggal
     *      > F: bulan dalam bentuk huruf (January, February, March, dll.)
     *      > H: jam dalam format 24 jam
     *      > i: menit
     *      > s: detik
     * - Parameter ke-dua bersifat opsional, yaitu waktu. Pastikan parameter ke-dua adalah
     * tipe data waktu. Jika yang kita punya hanyalah string, maka lakukan konversi string tersebut
     * menjadi format waktu dengan fungsi strtotime().
     */

    /**
     * Catatan 10 - And Where
     * Pada pencarian data kita tidak selalu hanya terpaku pada 1 kondisi saja. Terkadang
     * ada saat dimana kita menuliskan query sebagai berikut:
     * SELECT * FROM users WHERE name = "Budi" AND role = "admin" OR age = 22
     * 
     * Dalam eloquent, penambahan kondisi dilakukan dengan menyambungkan fungsi where satu sama lain.
     * Untuk AND dapat dilakukan sebagai berikut:
     * User::where('name', 'like', 'Budi%')->where('role', '=', 'admin')
     * 
     * Untuk OR dapat dilakukan sebagai berikut:
     * User::where('name', 'like', 'Budi%')->where('role', '=', 'admin')->orWhere('age', '=', 22)
     * 
     * Jadi menyambungkan fungsi where() dengan fungsi where() atau fungsi where() lain akan 
     * menciptakan notasi AND.
     * Sedangkan menyambungkan orWhere() akan menciptakan notasi OR.
     */

    /**
     * Catatan 11 - whereHas()
     * Fungsi whereHas() digunakan untuk mengambil data yang 
     * memiliki relationship pada model tertentu.
     * Pada umumnya fungsi ini hanya memiliki satu parameter, yaitu nama relationship
     * pada model lain. Parameter ke-dua merupakan parameter opsional, yang artinya dapat diabaikan
     * atau tidak diisi. Parameter ke-dua ini merupakan fungsi closure (fungsi anonymous atau 
     * tanpa nama) dengan parameter variabel $query. Parameter ini digunakan untuk menyeleksi lagi
     * data dari relationship tersebut.
     * 
     * Contohnya, jika dalam suatu controller hanya tertulis: 
     * Article::whereHas('comments') saja, 
     * maka dia akan mencari semua data artikel yang memiliki komentar.
     * 
     * Beda dengan jika tertulis: 
     * Article::whereHas('comments', function($query){
     *      $query->where('name', '=', 'Steven');
     * })
     * Yang artinya cari artikel dengan komentar yang bernama Steven.
     * 
     * Sama halnya dengan relationship, fungsi ini juga dapat mencari banyak informasi
     * melalui relasi-relasi dari setiap tabel yang terhubung satu sama lain dengan cara
     * membuat whereHas() yang berlapis-lapis.
     * 
     * Contoh, kita diminta untuk mencari penulis artikel yang memiliki komentar dengan upvote 
     * lebih dari 10 pada beberapa artikelnya. Diketahui juga bahwa terdapat tabel authors, articles, 
     * dan comments yang berhubungan secara linier (authors ---> articles ---> comments).
     * Dari keterangan di atas diketahui bahwa tabel authors tidak berhubungan langsung dengan tabel
     * comments, melainkan terhubung melalui tabel articles.
     * 
     * Solusinya kita dapat menggunakan sourcecode berikut:
     * Author::whereHas('articles', function($query){
     *      $query->whereHas('comments', function($query){
     *          $query->where('upvote', '>', 10);
     *      });
     * })
     * 
     * Potongan sourcecode di atas dapat dibaca sebagai berikut:
     * Data author yang memiliki article yang memiliki comment yang memiliki upvote lebih dari 10.
     * 
     * Jika kita ingin memberi variabel untuk fungsi closure pada whereHas, kita tidak dapat
     * langsung meletakkannya setelah $query. Melainkan dengan menggunakan use() setelah parameter.
     * Hal ini juga berlaku untuk fungsi closure di dalamnya.
     * 
     * Contoh:
     * Author::whereHas('articles', function($query) use($number){
     *      $query->whereHas('comments', function($query) use($number){
     *          $query->where('upvote', '>', $number);
     *      });
     * })
     */
}
