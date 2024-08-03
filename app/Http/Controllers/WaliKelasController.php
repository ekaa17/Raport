<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_wali_kelas;
use App\Http\Controllers\Controller;
use App\Models\data_kelas;
use App\Models\data_tahun_ajaran;
use App\Models\Staff;

class WaliKelasController extends Controller
{
    // menampilkan data
    public function index()
    {
        $no = 1;
        $title = 'Data Wali Kelas';
        $wali_kelas = data_wali_kelas::all();
        $tahun_pelajaran = data_tahun_ajaran::orderby('created_at', 'desc')->get();
        return view('pages.admin.data-walikelas.index', compact('no', 'title', 'wali_kelas', 'tahun_pelajaran'));
    }

    public function create()
    {
        $title = 'Tambah Data Wali Kelas';
        $staff = Staff::where('role', 'guru')->get();
        $kelas = data_kelas::all();
        return view('pages.admin.data-walikelas.create', [
            'kelas' => $kelas,
            'staff' => $staff,
            'title' => $title
        ]);
    }

    // Menyimpan wali kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:data_kelas,id',
            'id_staff' => 'required|exists:staff,id',
        ]);

        $tahun_ajaran = data_tahun_ajaran::where('status', 'aktif')->first();

        data_wali_kelas::create([
            'id_kelas' => $request->input('id_kelas'),
            'id_staff' => $request->input('id_staff'),
            'tahun_ajarans_id' => $tahun_ajaran->id,
        ]);

        return redirect()->route('data-walikelas.index')->with('success', 'Wali Kelas berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit wali kelas
    public function edit($id)
    {
        $waliKelas = data_wali_kelas::findOrFail($id);
        $kelas = data_kelas::all();
        $staff = Staff::where('role', 'guru')->get();
        $tahunAjaran = data_tahun_ajaran::all();
        return view('pages.admin.data-walikelas.edit', [
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
            'id_kelas' => 'required',
            'id_staff' => 'required'
        ]);

        $waliKelas = data_wali_kelas::findOrFail($id);
        $waliKelas->update($request->all());

        if ($waliKelas->save()) {
            return redirect()->route('data-walikelas.index')->with('success', 'Wali Kelas berhasil diperbarui.');
        } else {
            return redirect()->route('data-walikelas.index')->with('error', 'Gagal memperbarui data.');
        }
    }

    // Menghapus wali kelas
    public function destroy($id)
    {
        $waliKelas = data_wali_kelas::findOrFail($id);
        $waliKelas->delete();

        return redirect()->route('data-wali-kelas.index')->with('success', 'Wali Kelas berhasil dihapus!');
    }
}
