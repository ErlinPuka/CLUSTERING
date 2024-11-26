<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KlasterisasiController;
use App\Http\Controllers\LuasLahanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', function () {
    return view('login');
});


Route::get('/', [DashboardController::class, 'index_user']);
Route::resource('kecamatan', KecamatanController::class);
Route::resource('luaslahan', LuasLahanController::class);
Route::resource('produksi', ProduksiController::class);

Route::get('clustering', [KlasterisasiController::class, 'index']);
Route::get('cetak', [KlasterisasiController::class, 'cetak']);
Route::post('clustering/proses', [KlasterisasiController::class, 'proses'])->name('clustering.proses');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [LoginController::class, 'register']);
Route::get('dashboard', [DashboardController::class, 'index']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
