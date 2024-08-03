<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\data_kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    // menampilkan data
    public function index() {
        $no = 1;
        $title = 'Siswa Sekolah';
        $data_kelas = data_kelas::orderby('kelas')->get();
        return view('pages.admin.data-siswa.index', compact('no', 'title', 'data_kelas'));
    }

    public function show($id) {
        $title = 'Data Siswa Kelas';
        $kelas = data_kelas::findOrFail($id);
        $siswa = siswa::where('kelas_id', $id);
        return view('pages.admin.data-siswa.detail-perkelas', compact('title', 'kelas', 'siswa'));
    }
}
