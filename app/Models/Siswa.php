<?php

namespace App\Models;

use App\Models\data_kelas;
use App\Models\data_nilai_mapel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function kelas()
    {
        return $this->belongsTo(data_kelas::class);
    }

    public function nilai()
    {
        return $this->hasMany(data_nilai_mapel::class, 'nomor_induk');
    }
}
