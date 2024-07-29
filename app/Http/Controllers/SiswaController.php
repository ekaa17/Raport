<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // menampilkan data
    public function index() {
        $no = 1;
        $title = 'Siswa Sekolah';
        return view('pages.admin.data-siswa.index', compact('no', 'title'));
    }
}
