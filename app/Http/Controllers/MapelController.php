<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapelController extends Controller
{
    // menampilkan data
    public function index() {
        $no = 1;
        $title = 'Data Mata Pelajaran';
        return view('pages.admin.data-mapel.index', compact('no', 'title'));
    }
}
