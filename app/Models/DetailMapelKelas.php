<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\data_mapel;
use App\Models\data_nilai_mapel;
use App\Models\data_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailMapelKelas extends Model
{
    use HasFactory;

    protected $table = 'detail_mapel_kelas';
    protected $guarded = ['id'];

    public function mapel()
    {
        return $this->belongsTo(data_mapel::class, 'mapel_id');
    }

    public function kelas()
    {
        return $this->belongsTo(data_kelas::class, 'kelas_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'pengajar_id');
    }

    public function nilai()
    {
        return $this->hasMany(data_nilai_mapel::class, 'detail_mapel_id');
    }
}
