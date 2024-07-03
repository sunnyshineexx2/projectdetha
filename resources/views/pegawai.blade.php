<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'pegawai_id';
    protected $fillable = ['pegawai_nama', 'pegawai_jabatan', 'pegawai_umur', 'pegawai_alamat'];

    // Jika Anda ingin menggunakan timestamps yang otomatis diisi oleh Laravel, pastikan ini disetel ke true
    public $timestamps = true;
}
