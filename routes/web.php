<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route Autentikasi (login, logout, register, reset password)
// Dibutuhkan oleh layout (route 'logout') dan halaman auth.
Auth::routes();

// Semua halaman aplikasi hanya bisa diakses setelah login (middleware 'auth').
// Pengunjung yang belum login otomatis diarahkan ke halaman login.
Route::middleware('auth')->group(function () {

    // Route Halaman Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Route Resource untuk Master Data Kelas
    // Nama parameter dipaksa 'kela' agar cocok dengan type-hint (Kelas $kela) di KelasController.
    Route::resource('kelas', KelasController::class)
        ->except('show')
        ->parameters(['kelas' => 'kela']);

    // Route Resource untuk Master Data Siswa
    Route::resource('siswa', SiswaController::class)
        ->parameters(['siswa' => 'siswa']);

    // Route Resource untuk Master Data Guru
    Route::resource('guru', GuruController::class)
        ->except('show')
        ->parameters(['guru' => 'guru']);

    // Route Resource untuk Master Data Mata Pelajaran (Mapel)
    Route::resource('mapel', MapelController::class)
        ->except('show')
        ->parameters(['mapel' => 'mapel']);

    // Route Resource untuk Data Nilai Akademik
    Route::resource('nilai', NilaiController::class)
        ->except('show')
        ->parameters(['nilai' => 'nilai']);
});
