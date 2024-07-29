<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        // dd($request);
        // $request->validate([
        //     'nip' => 'required|digits:18',
        //     'password'=> 'required' 
        //  ], [
        //     'nip.required' => 'Kolom NIP tidak boleh kosong.',
        //     'nip.digits' => 'Kolom NIP terdiri dari 18 digit angka.',
        //     'password.required' => 'Kolom Password tidak boleh kosong.',
        // ]);


         if (Auth::attempt($request->only('nip', 'password'))) {
            $user = Auth::user();
            
            if ($user->role === 'kepala sekolah' || $user->role === 'admin' || $user->role === 'guru') {
                return redirect('/dashboard');
            } else {
                return redirect('/')->with('wrong', 'Role tidak Ditemukan !');
            }
        } else {
            return redirect('/')->with('wrong', 'Invalid NIP and Password!');
        }
    }

    public function logout() {
        if (Auth::check()) {
            $role = Auth::user()->role;
    
            if ($role === 'kepala sekolah' || $role === 'admin'|| $role === 'guru') {
                Auth::logout();
            }
        } 
        return redirect('/');
    }
}
