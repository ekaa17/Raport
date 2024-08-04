<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Staff;
use App\Models\data_kelas;
use App\Models\data_wali_kelas;
use App\Models\data_nilai_mapel;
use App\Models\data_tahun_ajaran;
use App\Models\DetailMapelKelas;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RaportController extends Controller
{
    public function index($id)
    {
        $no = 1;
        $title = 'Input Nilai Siswa';
        $data_nilai = DetailMapelKelas::with(['kelas.detail_mapel_kelas.mapel', 'kelas.siswas.nilai'])->findOrFail($id);
        return view('pages.raport.index', compact('no', 'title', 'data_nilai'));
    }   
    
    public function show($id)
    {
        $siswa = Siswa::with(['kelas', 'nilai.detail_mapel_kelas.mapel'])->findOrFail($id);
        $tahun_ajaran = data_tahun_ajaran::where('status', 'aktif')->first();

        // Grouping mapel by 'kelompok'
        $kelompokA = [];
        $kelompokB = [];
        $kelompokC = [];
    
        foreach ($siswa->nilai as $nilai) {
            switch ($nilai->detail_mapel_kelas->mapel->kelompok) {
                case 'Kelompok A':
                    $kelompokA[] = $nilai;
                    break;
                case 'Kelompok B':
                    $kelompokB[] = $nilai;
                    break;
                case 'Kelompok C':
                    $kelompokC[] = $nilai;
                    break;
            }
        }

        $wali_kelas = data_wali_kelas::where('id_kelas', $siswa->kelas->id)->first();
        $kepala_sekolah = Staff::where('role', 'kepala sekolah')->first();
        return view('pages.raport.show', compact('siswa', 'kelompokA', 'kelompokB', 'kelompokC', 'wali_kelas', 'kepala_sekolah', 'tahun_ajaran'));
    }
    
    public function update_ttd_wali($id) {
        $update_status = data_nilai_mapel::where('nomor_induk', $id)->get();
        $siswa = Siswa::where('id', $id)->first();
        foreach ($update_status as $nilai) {
            $nilai->status = 'ditandatangani walikelas';
            $nilai->save();
        }

        return redirect()->back()->with('success', 'Anda telah menandatangani raport milik ' . $siswa->nama);
    }


    // menampilkan data
    public function view() {
        $no = 1;
        $title = 'Siswa Sekolah';
        $data_kelas = data_kelas::orderby('kelas')->get();
        $siswa_ditandatangani = DB::table('data_nilai_mapels')
        ->join('siswas', 'data_nilai_mapels.nomor_induk', '=', 'siswas.id')
        ->select('siswas.kelas_id', DB::raw('COUNT(DISTINCT siswas.id) as jumlah'))
        ->where('data_nilai_mapels.status', 'ditandatangani walikelas')
        ->groupBy('siswas.kelas_id')
        ->get()
        ->keyBy('kelas_id');

        $raport_selesai = DB::table('data_nilai_mapels')
        ->join('siswas', 'data_nilai_mapels.nomor_induk', '=', 'siswas.id')
        ->select('siswas.kelas_id', DB::raw('COUNT(DISTINCT siswas.id) as jumlah'))
        ->where('data_nilai_mapels.status', 'selesai')
        ->groupBy('siswas.kelas_id')
        ->get()
        ->keyBy('kelas_id');

        return view('pages.raport.view-kelas', compact('no', 'title', 'data_kelas', 'siswa_ditandatangani', 'raport_selesai'));
    }

    public function view_nilai($id)
    {
        $no = 1;
        $title = 'Nilai Siswa';
        $data_nilai = DetailMapelKelas::with(['kelas.detail_mapel_kelas.mapel', 'kelas.siswas.nilai'])->where('kelas_id',$id)->first();

        if($data_nilai) {
            return view('pages.raport.index', compact('no', 'title', 'data_nilai'));
        }
        else {
            return 'data belum tersedia';
        }
    }  

    public function update_ttd_kepsek($id) {
        $kelas = data_kelas::where('id', $id)->first();
        // Ambil kelas_id dari tabel detail_mapel_kelas berdasarkan detail_mapel_id
        $kelas_id = DetailMapelKelas::where('id', $id)->value('kelas_id');

        // Ambil data nilai berdasarkan kelas_id dari tabel data_nilai_mapels
        $update_status = data_nilai_mapel::whereHas('detail_mapel_kelas', function ($query) use ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        })->get();

        foreach ($update_status as $nilai) {
            $nilai->status = 'selesai';
            $nilai->save(); // Menyimpan perubahan ke database
        }


        return redirect()->back()->with('success', 'Anda telah menandatangani raport milik kelas ' . $kelas->kelas . $kelas->nama_kelas);
    }
}
