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
        'kelas',
        'id_jurusan',
    ];

    // Mendefinisikan hubungan dengan model Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
