<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\data_kelas;
use App\Models\data_mapel;
use App\Models\data_tahun_ajaran;
use App\Models\Jurusan;

class KelasController extends Controller
{
    // menampilkan data
    public function index()
    {
        $no = 1;
        $title = 'Informasi Kelas dan Jurusan';
        return view('pages.admin.data-kelas.index', compact('no', 'title'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        $mapels = data_mapel::all();
        $data_tahun_ajarans = data_tahun_ajaran::all();

        // Mengirimkan data ke view
        return view('pages.admin.data-kelas.create', [
            'title' => 'Tambah Data Kelas',
            'jurusans' => $jurusans,
            'mapels' => $mapels,
            'data_tahun_ajarans' => $data_tahun_ajarans,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'mapel_id' => 'required',
            'nama_kelas' => 'required',
            'kelas' => 'required',
            'jurusans' => 'required',
        ]);

        data_kelas::create($request->all());
        return redirect()->route('data-kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(data_kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, data_kelas $kelas)
    {
        $request->validate([
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $kelas->update($request->all());
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(data_kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}
