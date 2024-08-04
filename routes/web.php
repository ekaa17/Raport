<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TahunAjaranController;
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
    Route::get('/dashboard', [LoginController::class, 'dashboard']);
    
});

Route::group(['middleware' => 'cekrole:admin'], function() {
    Route::get('/tutup-tahun-ajaran', [TahunAjaranController::class, 'tutup_tahun_ajaran']);
    Route::resource('/tahun-ajaran', TahunAjaranController::class)->names('tahun-ajaran');
    Route::resource('/jurusan', JurusanController::class)->names('jurusan');
    Route::resource('/data-staff', StaffController::class)->names('data-staff');

    Route::get('/data-siswa', [SiswaController::class, 'index']);
    Route::get('/data-siswa/create/{id}', [SiswaController::class, 'create']);
    Route::post('/data-siswa/store', [SiswaController::class, 'store']);
    Route::get('/data-siswa/edit/{id}', [SiswaController::class, 'edit']);
    Route::get('/data-siswa/show/{id}', [SiswaController::class, 'show']);
    Route::put('/data-siswa/update/{id}', [SiswaController::class, 'update']);
    Route::delete('/data-siswa/destroy/{id}', [SiswaController::class, 'destroy']);


    Route::resource('/data-kelas', KelasController::class)->names('data-kelas');
    Route::post('/data-kelas-mapel', [KelasController::class, 'show']);
    Route::delete('/hapus-kelas-mapel/{id}', [KelasController::class, 'destroy_mapel']);
    Route::resource('/data-walikelas', WaliKelasController::class)->names('data-walikelas');
    Route::resource('/data-mapel', MapelController::class)->names('data-mapel');
});

Route::group(['middleware' => 'cekrole:guru'], function() {
    Route::resource('/data-nilai', NilaiController::class)->names('data-nilai');
    Route::get('/data-raport/{id}', [RaportController::class, 'index']);
    Route::get('/raport/{id}', [RaportController::class, 'show']);
    // Route::get('/download/{id}', [RaportController::class, 'show']);
    Route::get('/raport-ttd/{id}', [RaportController::class, 'update_ttd_wali']);
});

Route::group(['middleware' => 'cekrole:kepala sekolah'], function() {
    Route::get('/data-raport', [RaportController::class, 'view']);
    Route::get('/nilai-raport/{id}', [RaportController::class, 'view_nilai']);
    Route::get('/ttd-raport/{id}', [RaportController::class, 'update_ttd_kepsek']);
});