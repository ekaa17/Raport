<?php

namespace App\Models;

use App\Models\Jurusan;
use App\Models\DetailMapelKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class data_kelas extends Model
{
    use HasFactory;

    protected $table = 'data_kelas';
    protected $guarded = ['id'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function detail_mapel_kelas()
    {
        return $this->hasMany(DetailMapelKelas::class, 'kelas_id');
    }
}
