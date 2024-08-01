<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_nilai_mapel extends Model
{
    use HasFactory;

    protected $table = 'data_nilai_mapel';

    // Menentukan kolom mana saja yang dapat diisi
    protected $fillable = [
        'nomor_induk',
        'id_mapel',
        'id_pengajar',
        'tahun_pelajaran_id',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_absensi',
        'nilai_kepribadian',
    ];

    // Mendefinisikan hubungan dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'nomor_induk');
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
