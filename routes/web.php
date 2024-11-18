<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenAnggotaController;
use App\Http\Controllers\DosenPICController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\AuthController;
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
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin'])->name('postLogin');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Group routes untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Routes untuk admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    // Routes untuk pimpinan
    Route::middleware(['role:pimpinan'])->group(function () {
        Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan.dashboard');
    });

    // Routes untuk dosen
    Route::middleware(['role:dosen'])->group(function () {
        Route::get('/dosen', [DosenPICController::class, 'index'])->name('dosen.dashboard');
    });
});

