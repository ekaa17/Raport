<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\DetailMapelKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class data_nilai_mapel extends Model
{
    use HasFactory;

    protected $table = 'data_nilai_mapels';
    protected $guarded = ['id'];

    // Mendefinisikan hubungan dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'nomor_induk');
    }

    public function detail_mapel_kelas()
    {
        return $this->belongsTo(DetailMapelKelas::class, 'detail_mapel_id');
    }
    
    // Mendefinisikan hubungan dengan model Mapel
    public function mapel()
    {
        return $this->belongsTo(data_mapel::class, 'id_mapel');
    }

    // Mendefinisikan hubungan dengan model Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_pengajar');
    }

    // Mendefinisikan hubungan dengan model TahunPelajaran
    public function tahunPelajaran()
    {
        return $this->belongsTo(data_tahun_ajaran::class, 'tahun_pelajaran_id');
    }
}
