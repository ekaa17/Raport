<?php

namespace App\Http\Controllers;

use App\Models\data_mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    // menampilkan data
    public function index()
    {
        $mapel = data_mapel::all();
        return view('pages.admin.data-mapel.index', ['mapel' => $mapel, 'title' => 'Daftar Mata Pelajaran']);
    }

    public function create()
    {
        return view('pages.admin.data-mapel.create', ['title' => 'Tambah Mapel']);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        // Simpan data
        data_mapel::create([
            'nama_mapel' => $request->input('nama_mapel'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('data-mapel.index')->with('success', 'Mapel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mapel = data_mapel::findOrFail($id); // Ambil data mapel berdasarkan ID
        return view('pages.admin.data-mapel.edit', [
            'title' => 'Edit Mapel',
            'mapel' => $mapel
        ]);
    }

    // Menyimpan pembaruan data
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        // Temukan data mapel berdasarkan ID dan perbarui
        $mapel = data_mapel::findOrFail($id);
        $mapel->update([
            'nama_mapel' => $request->input('nama_mapel'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('data-mapel.index')->with('success', 'Mapel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mapel = data_mapel::findOrFail($id); // Temukan data berdasarkan ID
        $mapel->delete(); // Hapus data

        // Redirect dengan pesan sukses
        return redirect()->route('data-mapel.index')->with('success', 'Mapel berhasil dihapus!');
    }
}
