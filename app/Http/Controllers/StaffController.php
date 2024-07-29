<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    // menampilkan data
    public function index() {
        $no = 1;
        $title = 'Staff Sekolah';
        return view('pages.admin.data-staff.index', compact('no', 'title'));
    }
}
