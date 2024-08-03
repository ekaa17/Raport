<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_tahun_ajaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TahunAjaranController extends Controller
{
    // menampilkan data
    public function index()
    {
        $no = 1;
        $title = 'Informasi Tahun Ajaran';
        $data_tahun_ajaran = data_tahun_ajaran::where('status', 'aktif')->first();
        return view('pages.admin.data-tahun-ajaran.index', compact('no', 'title', 'data_tahun_ajaran'));
    }

    public function store(Request $request) {
        // dd($request);    
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);

        $tahun_ajaran = new data_tahun_ajaran();
        $tahun_ajaran->tahun_ajaran = $request->tahun_ajaran;
        $tahun_ajaran->semester = $request->semester;
        $tahun_ajaran->status = 'aktif';

        if ($tahun_ajaran->save()) {
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function update($id, Request $request) {
        // dd($request);    
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);

        $tahun_ajaran = data_tahun_ajaran::findOrFail($id);
        $tahun_ajaran->tahun_ajaran = $request->tahun_ajaran;
        $tahun_ajaran->semester = $request->semester;

        if ($tahun_ajaran->save()) {
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function tutup_tahun_ajaran() {

        $data_jurusan = DB::table('data_tahun_ajarans')
        ->where('status', 'aktif')
        ->update([
            'status' => 'nonaktif',
        ]);

        if ($data_jurusan) {
            return redirect()->back()->with('success', 'Tahun ajaran ditutup');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate tahun ajaran');
        }
    }
}
