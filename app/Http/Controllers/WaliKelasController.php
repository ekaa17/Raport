<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    // menampilkan data
    public function index() {
        $no = 1;
        $title = 'Data Wali Kelas';
        return view('pages.admin.data-walikelas.index', compact('no', 'title'));
    }
}
