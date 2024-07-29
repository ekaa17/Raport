<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    // menampilkan data
    public function index() {
        $no = 1;
        $title = 'Informasi Kelas dan Jurusan';
        return view('pages.admin.data-kelas.index', compact('no', 'title'));
    }
}
