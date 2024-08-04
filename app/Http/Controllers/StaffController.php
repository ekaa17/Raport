<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    // menampilkan data
    public function index()
    {
        $title = 'Daftar Staff';
        $staff = Staff::all(); // Mengambil semua data staff

        return view('pages.admin.data-staff.index', compact('title', 'staff'));
    }

    public function create()
    {
        return view('pages.admin.data-staff.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nip' => 'required|integer||digits:18|unique:staff',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:staff',
            'jenis_kelamin' => 'required|in:L,P',
            'role' => 'required|in:admin,guru,kepala sekolah',
            // 'walikelas' => 'required|in:ya,tidak',
            'password' => 'required|string|min:8',
        ]);

        if ($request->hasFile('tandatangan')) {
            $ttd_digital = $request->file('tandatangan');
            $imageName = $request->nip . '_' . $request->nama . '.' . $ttd_digital->extension();
            $ttd_digital->move(public_path('assets/img/ttd-staff/'), $imageName);
        } else {
            $imageName = null;
        }

        // Membuat staff baru
        Staff::create([
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'role' => $request->input('role'),
            // 'walikelas' => $request->input('walikelas'),
            'tanda_tangan' => $imageName,
            'password' => bcrypt($request->input('password')), // Mengenkripsi password
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data-staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    // Menampilkan detail staff
    public function show(Staff $staff)
    {
        return view('pages.admin.data-staff.show', compact('staff'));
    }

    // Menampilkan form untuk mengedit staff
    public function edit($id)
    {
        // Menemukan staff berdasarkan ID
        $staff = Staff::findOrFail($id);

        // Mengembalikan view dengan data staff
        return view('pages.admin.data-staff.edit', compact('staff'));
    }

    // Memproses pembaruan staff
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nip' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'role' => 'required|in:admin,guru,kepala sekolah',
            // 'walikelas' => 'required|in:ya,tidak',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Menemukan staff berdasarkan ID
        $staff = Staff::findOrFail($id);

        if ($request->hasFile('tandatangan')) {
            if ($staff->tanda_tangan && file_exists(public_path('assets/img/ttd-staff/' . $staff->tanda_tangan))) {
                unlink(public_path('assets/img/ttd-staff/' . $staff->tanda_tangan));
            }
            $tanda_tanganImage = $request->file('tandatangan');
            $imageName = $request->nip . '_' . $request->nama . '.' . $tanda_tanganImage->extension();
            $tanda_tanganImage->move(public_path('assets/img/ttd-staff/'), $imageName);
        } else {
            $imageName = $staff->tanda_tangan;
        }

        // Memperbarui data staff
        $staff->nip = $validatedData['nip'];
        $staff->nama = $validatedData['nama'];
        $staff->email = $validatedData['email'];
        $staff->jenis_kelamin = $validatedData['jenis_kelamin'];
        $staff->role = $validatedData['role'];
        $staff->tanda_tangan = $imageName;
        // $staff->walikelas = $validatedData['walikelas'];

        // Memperbarui password jika ada
        if ($request->filled('password')) {
            $staff->password = bcrypt($validatedData['password']);
        }

        $staff->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('data-staff.index')->with('success', 'Staff updated successfully.');
    }

    // Menghapus staff
    public function destroy($id)
    {
        // Temukan staff berdasarkan ID
        $staff = Staff::findOrFail($id);

        // Hapus staff
        $staff->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('data-staff.index')->with('success', 'Staff deleted successfully.');
    }
}
