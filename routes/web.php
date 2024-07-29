<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\WaliKelasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);


Route::group(['middleware' => 'cekrole:kepala sekolah,admin,guru'], function() {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });
    Route::resource('/data-staff', StaffController::class)->names('data-staff');
    Route::resource('/data-siswa', SiswaController::class)->names('data-siswa');
    Route::resource('/data-kelas', KelasController::class)->names('data-kelas');
    Route::resource('/data-walikelas', WaliKelasController::class)->names('data-walikelas');
    Route::resource('/data-mapel', MapelController::class)->names('data-mapel');
});