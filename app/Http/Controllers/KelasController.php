<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\data_kelas;
use App\Models\data_mapel;
use App\Models\DetailMapelKelas;
use App\Models\Jurusan;

class KelasController extends Controller
{
    // menampilkan data
    public function index()
    {
        $no = 1;
        $title = 'Informasi Kelas';
        $data_kelas = data_kelas::orderby('kelas')->get();
        $data_mapel = data_mapel::orderby('nama_mapel')->get();
        return view('pages.admin.data-kelas.index', compact('no', 'title', 'data_kelas', 'data_mapel'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();

        // Mengirimkan data ke view
        return view('pages.admin.data-kelas.create', [
            'title' => 'Tambah Data Kelas',
            'jurusans' => $jurusans,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'nama_kelas' => 'required',
            'kelas' => 'required',
        ]);

        data_kelas::create($request->all());
        return redirect()->route('data-kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $title = 'Informasi Kelas';
        $jurusans = Jurusan::all();
        $data_kelas = data_kelas::findOrFail($id);
        return view('pages.admin.data-kelas.edit', compact('title','jurusans','data_kelas'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'nama_kelas' => 'required',
            'kelas' => 'required',
            'jurusan_id' => 'required',
        ]);

        $kelas = data_kelas::findOrFail($id);
        $kelas->update($request->all());

        if ($kelas->save()) {
            return redirect()->route('data-kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
        } else {
            return redirect()->route('data-kelas.index')->with('error', 'Gagal memperbarui data.');
        }

    }

    public function show(Request $request) {
        $detail_data = DetailMapelKelas::create([
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
        ]);

        if ($detail_data->save()) {
            return redirect()->route('data-kelas.index')->with('success', 'Mata Pelajaran Berhasil ditambahkan.');
        } else {
            return redirect()->route('data-kelas.index')->with('error', 'Gagal menambahkan mata pelajaran.');
        }
    }

    public function destroy_mapel($id)
    {
        $detail_kelas_mapel = DetailMapelKelas::findOrFail($id);
        $detail_kelas_mapel->delete();
        return redirect()->route('data-kelas.index')
            ->with('success', 'Data mata pelajaran berhasil dihapus.');
    }

    public function destroy($id)
    {
        $kelas = data_kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('data-kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}
