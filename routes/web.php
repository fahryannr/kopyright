<?php

use App\Models\Auth;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KategoriController;
use App\Models\Pesanan;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('home');
})->middleware('auth');

// login
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'autentic'])->middleware('guest');

// halaman
Route::get('/pengelolaan', [KategoriController::class, 'index'])->name('pengelolaan');
Route::get('/menu', [MenuController::class, 'index'])->middleware('auth');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index')->middleware('auth');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index')->middleware('auth');

// tambah
Route::get('/tambahkat', [KategoriController::class, 'create'])->middleware('auth');
Route::get('/tambahakun', [AuthController::class, 'create'])->middleware('auth');
Route::get('/tambahmenu', [MenuController::class, 'create'])->middleware('auth');
Route::get('/pemesan', [PesananController::class, 'create'])->middleware('auth');

// simpan data tambah
Route::post('/tambahkat',[KategoriController::class, 'store'])->middleware('auth');
Route::post('/tambahmenu',[MenuController::class, 'store'])->middleware('auth');
Route::post('/tambahakun',[AuthController::class, 'store'])->middleware('auth');
Route::post('/pesanan',[PesananController::class, 'store'])->middleware('auth');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store')->middleware('auth');

//konfirmasi
Route::post('/pesanan/konfirmasi/{id}', [PesananController::class, 'konfirmasi'])->name('pesanan.konfirmasi')->middleware('auth');

// hapus
Route::delete('/kathap/{id}', [KategoriController::class, 'delete'])->middleware('auth');
Route::delete('/menhap/{id}', [MenuController::class, 'delete'])->middleware('auth');
Route::delete('/pesanan/{id}', [PesananController::class, 'delete'])->middleware('auth');
Route::delete('/akun/{id}', [AuthController::class, 'delete'])->middleware('auth');

// edit
Route::get('/katup/{id}', [KategoriController::class, 'edit'])->middleware('auth');
Route::get('/menup/{id}', [MenuController::class, 'edit'])->middleware('auth');

// update
Route::put('/katedit/{id}', [KategoriController::class, 'update'])->middleware('auth');
Route::put('/menuedit/{id}', [MenuController::class, 'update'])->middleware('auth');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// export
Route::get('/export-pdf', [LaporanController::class, 'exportPdf'])->middleware('auth');
Route::get('/export-excel', [LaporanController::class, 'exportExcel'])->middleware('auth');