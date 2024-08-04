<?php

namespace App\Http\Controllers;

use App\Models\data_nilai_mapel;
use App\Models\DetailMapelKelas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // menampilkan data
    public function show($id)
    {
        $no = 1;
        $title = 'Input Nilai Siswa';
        $data_nilai = DetailMapelKelas::with(['kelas.siswas', 'kelas.siswas.nilai' => function ($query) use ($id) {
            $query->where('detail_mapel_id', $id);
        }])->findOrFail($id);
    
        return view('pages.penilaian.index', compact('no', 'title', 'data_nilai'));
    }    

    public function store(Request $request) {
        $nilai = new data_nilai_mapel();
        $nilai->nomor_induk = $request->nomor_induk;
        $nilai->detail_mapel_id = $request->detail_mapel;
        $nilai->nilai_tugas = $request->nilai_tugas;

        if ($nilai->save()) {
            return redirect()->back()->with('success', 'Data nilai berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function update(Request $request, $id) {
        $nilaiMapel = data_nilai_mapel::findOrFail($id);

        $request->validate([
            'nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($request->has('nilai_tugas')) {
            $nilaiMapel->nilai_tugas = $request->nilai_tugas;
        }

        if ($request->has('nilai_uts')) {
            $nilaiMapel->nilai_uts = $request->nilai_uts;
        }

        if ($request->has('nilai_uas')) {
            $nilaiMapel->nilai_uas = $request->nilai_uas;
        }

        if ($request->has('nilai_kepribadian')) {
            $nilaiMapel->nilai_kepribadian = $request->nilai_kepribadian;
        }

        if ($nilaiMapel->save()) {
            return redirect()->back()->with('success', 'Data nilai berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }
}
