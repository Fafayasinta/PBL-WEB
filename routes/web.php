<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenAnggotaController;
use App\Http\Controllers\DosenPICController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JabatanKegiatanController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\JenisPenggunaController;
use App\Http\Controllers\KegiatanJtiController;
use App\Http\Controllers\KegiatanNonJtiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistikController;
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
//
// Halaman utama
// Route::get('/', function () {
//     return view('welcome');
// });

Route::pattern('id', '[0-9]+');

// Auth routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [ProfileController::class, 'index']);
});

Route::group(['prefix' => 'jabatankegiatan'], function () {
    Route::get('/', [JabatanKegiatanController::class, 'index']);
});

Route::group(['prefix' => 'jeniskegiatan'], function () {
    Route::get('/', [JenisKegiatanController::class, 'index']);
});

Route::group(['prefix' => 'kegiatanjti'], function () {
    Route::get('/', [KegiatanJtiController::class, 'index']);
});

Route::group(['prefix' => 'kegiatannonjti'], function () {
    Route::get('/', [KegiatanNonJtiController::class, 'index']);
});

Route::group(['prefix' => 'jenispengguna'], function () {
    Route::get('/', [JenisPenggunaController::class, 'index']);
});

Route::group(['prefix' => 'pengguna'], function () {
    Route::get('/', [PenggunaController::class, 'index']);
});

Route::group(['prefix' => 'statistik'], function () {
    Route::get('/', [StatistikController::class, 'index']);
});




Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
    });
});

// Pimpinan routes
Route::middleware(['role:pimpinan'])->group(function () {
    Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan.dashboard');
});

// Dosen routes
Route::middleware(['role:dosen'])->group(function () {
    Route::get('/dosen', [DosenPICController::class, 'index'])->name('dosen.dashboard');
});
// Protected routes (authenticated users only)


