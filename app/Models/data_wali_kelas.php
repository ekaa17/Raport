<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\data_kelas;
use App\Models\data_tahun_ajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class data_wali_kelas extends Model
{
    use HasFactory;

    protected $table = 'data_wali_kelas';

    protected $fillable = [
        'id_kelas',
        'id_staff',
        'tahun_ajarans_id',
    ];

    /**
     * Relasi dengan model Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(data_kelas::class, 'id_kelas');
    }

    /**
     * Relasi dengan model DataStaff
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff');
    }

    /**
     * Relasi dengan model data_tahun_ajarans
     */
    public function tahunPelajaran()
    {
        return $this->belongsTo(data_tahun_ajaran::class, 'tahun_pelajaran');
    }
}
