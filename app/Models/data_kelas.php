<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan_id',
        'mapel_id',
        'nama_kelas',
        'kelas',
        'tahun_lajaran_id',
    ];

    public function jurusans()
    {
        return $this->belongsTo(jurusan::class);
    }

    public function mapels()
    {
        return $this->belongsTo(data_mapel::class);
    }

    public function data_tahun_ajarans()
    {
        return $this->belongsTo(data_tahun_ajaran::class);
    }
}
