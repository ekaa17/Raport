<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\data_kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    // menampilkan data
    public function index()
    {
        $title = 'Siswa Sekolah';
        $data_kelas = data_kelas::orderby('kelas')->get();
        return view('pages.admin.data-siswa.index', compact('title', 'data_kelas'));
    }

    public function show($id)
    {
        $title = 'Data Siswa Kelas';
        $kelas = data_kelas::findOrFail($id);
        $siswa = Siswa::where('kelas_id', $id)->get(); // Menggunakan ->get() untuk mengambil koleksi
        return view('pages.admin.data-siswa.detail-perkelas', compact('title', 'kelas', 'siswa'));
    }

    public function create($id)
    {
        $kelas = data_kelas::findOrFail($id);
        return view('pages.admin.data-siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
        ]);

        // Simpan data
        $siswa = new Siswa();
        $siswa->nomor_induk = $request->nomor_induk;
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->alamat;
        $siswa->kelas_id = $request->kelas;

        if ($siswa->save()) {
            return redirect('/data-siswa')->with('success', 'Data siswa berhasil ditambahkan.');
        } else {
            return redirect('/data-siswa')->with('error', 'Gagal menambahkan data.');
        }

    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('pages.admin.data-siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_induk' => 'required',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:L,P',
            'alamat' => 'required|string|max:255',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        if ($siswa->save()) {
            return redirect('/data-siswa')->with('success', 'Data siswa berhasil diupdate.');
        } else {
            return redirect('/data-siswa')->with('error', 'Gagal mengupdate data.');
        }
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        if ($siswa->delete()){
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
