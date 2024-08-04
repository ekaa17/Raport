<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas'; // Nama tabel di database

    protected $fillable = [
        'nomor_induk',
        'nama',
        'jenis_kelamin',
        'alamat',
        'kelas_id',
    ];

    // Mendefinisikan hubungan dengan model Jurusan
    public function jurusans()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function data_kelas()
    {
        return $this->belongsTo(data_kelas::class);
    }
}
