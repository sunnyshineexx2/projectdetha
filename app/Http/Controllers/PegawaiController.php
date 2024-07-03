<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        // Mengambil data dari table pegawai
        $pegawai = Pegawai::simplepaginate(10);

        // Mengirim data pegawai ke view index
        return view('index', ['pegawai' => $pegawai]);
    }

    // Method untuk menampilkan view form tambah pegawai
    public function tambah()
    {
        // Memanggil view tambah
        return view('tambah');
    }

    // Method untuk insert data ke table pegawai
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'umur' => 'required|numeric',
            'alamat' => 'required'
        ]);

        // Insert data ke table pegawai
        Pegawai::create([
            'pegawai_nama' => $request->nama,
            'pegawai_jabatan' => $request->jabatan,
            'pegawai_umur' => $request->umur,
            'pegawai_alamat' => $request->alamat
        ]);

        // Alihkan halaman ke halaman pegawai
        return redirect('/pegawai')->with('status', 'Data pegawai berhasil ditambahkan!');
    }

    // Method untuk edit data pegawai
    public function edit($id)
    {
        // Mengambil data pegawai berdasarkan id yang dipilih
        $pegawai = Pegawai::findOrFail($id);

        // Passing data pegawai yang didapat ke view edit.blade.php
        return view('edit', ['pegawai' => $pegawai]);
    }

    // Update data pegawai
    public function update(Request $request, $id)
    {
        // Validasi data input dari form
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'umur' => 'required|numeric',
            'alamat' => 'required'
        ]);

        // Update data pegawai
        Pegawai::where('pegawai_id', $id)->update([
            'pegawai_nama' => $request->nama,
            'pegawai_jabatan' => $request->jabatan,
            'pegawai_umur' => $request->umur,
            'pegawai_alamat' => $request->alamat
        ]);

        // Alihkan halaman ke halaman pegawai
        return redirect('/pegawai')->with('status', 'Data pegawai berhasil diperbarui!');
    }

    // Method untuk hapus data pegawai
    public function hapus($id)
    {
        // Hapus data pegawai berdasarkan id yang dipilih
        Pegawai::where('pegawai_id', $id)->delete();

        // Alihkan halaman ke halaman pegawai
        return redirect('/pegawai')->with('status', 'Data pegawai berhasil dihapus!');
    }

    // Method untuk mencari data pegawai
    public function cari(Request $request)
    {
        // Menangkap data pencarian
        $cari = $request->cari;

        // Mengambil data dari table pegawai sesuai pencarian data
        $pegawai = Pegawai::where('pegawai_nama', 'like', "%" . $cari . "%")->paginate();

        // Mengirim data pegawai ke view index
        return view('index', ['pegawai' => $pegawai]);
    }

    public function enkripsi(){
		$encrypted = Crypt::encryptString('Belajar Laravel Di malasngoding.com');
		$decrypted = Crypt::decryptString($encrypted);
 
		echo "Hasil Enkripsi : " . $encrypted;
		echo "<br/>";
		echo "<br/>";
		echo "Hasil Dekripsi : " . $decrypted;
	}

    public function hash(){
		$hash_password_saya = Hash::make('halo123');
		echo $hash_password_saya;
	}
}
