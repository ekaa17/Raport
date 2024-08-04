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

    public function create()
    {
        $kelas = data_kelas::all();
        return view('pages.admin.data-siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'nomor_induk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kelas_id' => 'required', // Pastikan tabel 'kelas' ada dan kolom 'id' valid
        ]);

        // Simpan data
        Siswa::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data-siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // public function show(Siswa $siswa)
    // {
    //     return view('pages.admin.data-siswa.show', compact('siswa'));
    // }

    // public function edit(Siswa $siswa)
    // {
    //     $jurusans = Jurusan::all();
    //     return view('siswa.edit', compact('siswa', 'jurusans'));
    // }

    // public function update(Request $request, Siswa $siswa)
    // {
    //     $request->validate([
    //         'nomor_induk' => 'required|string|max:255|unique:siswas,nomor_induk,' . $siswa->id,
    //         'nama' => 'required|string|max:255',
    //         'jenis_kelamin' => 'required|string|in:L,P',
    //         'alamat' => 'required|string|max:255',
    //         'kelas' => 'required|integer',
    //         'id_jurusan' => 'required|exists:jurusans,id',
    //     ]);

    //     $siswa->update($request->all());

    //     return redirect()->route('siswa.index')->with('success', 'Siswa updated successfully.');
    // }

    // public function destroy(Siswa $siswa)
    // {
    //     $siswa->delete();

    //     return redirect()->route('siswa.index')->with('success', 'Siswa deleted successfully.');
    // }
}
