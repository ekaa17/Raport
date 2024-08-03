<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // menampilkan data
    public function index()
    {
        $no = 1;
        $title = 'Informasi Jurusan';
        $data_jurusan = Jurusan::orderby('nama_jurusan')->get();
        return view('pages.admin.data-jurusan.index', compact('no', 'title', 'data_jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required',
        ]);

        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function update($id, Request $request) {
        $request->validate([
            'nama_jurusan' => 'required',
        ]);

        $data_jurusan = Jurusan::findOrFail($id);
        $data_jurusan->nama_jurusan = $request->nama_jurusan;

        if ($data_jurusan->save()) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate data');
        }
    }

    public function destroy($id) {   
        $data_jurusan = Jurusan::find($id);

        if ($data_jurusan->delete()){
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
