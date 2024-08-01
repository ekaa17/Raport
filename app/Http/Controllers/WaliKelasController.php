<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_wali_kelas;
use App\Http\Controllers\Controller;
use App\Models\data_tahun_ajaran;
use App\Models\Staff;

class WaliKelasController extends Controller
{
    // menampilkan data
    public function index()
    {
        $no = 1;
        $title = 'Data Wali Kelas';
        return view('pages.admin.data-walikelas.index', compact('no', 'title'));
    }

    public function create()
    {
        $kelas = data_wali_kelas::all();
        $title = 'Tambah Data Wali Kelas';
        $staff = Staff::all();
        $tahunAjaran = data_tahun_ajaran::all();
        return view('pages.admin.data-walikelas.create', [
            'kelas' => $kelas,
            'staff' => $staff,
            'tahunAjaran' => $tahunAjaran,
            'title' => $title
        ]);
    }

    // Menyimpan wali kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:data_kelas,id',
            'id_staff' => 'required|exists:staff,id',
            'data_tahun_ajaran' => 'required|exists:data_tahun_ajaran,id',
        ]);

        data_wali_kelas::create([
            'id_kelas' => $request->input('id_kelas'),
            'id_staff' => $request->input('id_staff'),
            'data_tahun_ajaran' => $request->input('data_tahun_ajaran'),
        ]);

        return redirect()->route('data-wali-kelas.index')->with('success', 'Wali Kelas berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit wali kelas
    public function edit($id)
    {
        $waliKelas = data_wali_kelas::findOrFail($id);
        $kelas = data_wali_kelas::all();
        $staff = Staff::all();
        $tahunAjaran = data_tahun_ajaran::all();
        return view('pages.admin.data-wali-kelas.edit', [
            'title' => 'Edit Wali Kelas',
            'waliKelas' => $waliKelas,
            'kelas' => $kelas,
            'staff' => $staff,
            'tahunAjaran' => $tahunAjaran
        ]);
    }

    // Memperbarui data wali kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kelas' => 'required|exists:data_kelas,id',
            'id_staff' => 'required|exists:staff,id',
            'data_tahun_ajaran' => 'required|exists:data_tahun_ajaran,id',
        ]);

        $waliKelas = data_wali_kelas::findOrFail($id);
        $waliKelas->update([
            'id_kelas' => $request->input('id_kelas'),
            'id_staff' => $request->input('id_staff'),
            'data_tahun_ajaran' => $request->input('data_tahun_ajaran'),
        ]);

        return redirect()->route('data-wali-kelas.index')->with('success', 'Wali Kelas berhasil diperbarui!');
    }

    // Menghapus wali kelas
    public function destroy($id)
    {
        $waliKelas = data_wali_kelas::findOrFail($id);
        $waliKelas->delete();

        return redirect()->route('data-wali-kelas.index')->with('success', 'Wali Kelas berhasil dihapus!');
    }
}
