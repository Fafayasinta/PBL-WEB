<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;

Route::get('/', function () {
   return redirect()->route('login');
});

// Auth Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
// Route Register
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);
// Route Reset Password
Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// Protected Dosen Routes
Route::middleware(['auth'])->group(function () {
   Route::get('/home', [DosenController::class, 'index']);
   
   Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.dashboard');
   Route::get('/dosen/kegiatan-jti', [DosenController::class, 'kegiatanJTI'])->name('dosen.kegiatan.jti');
   Route::get('/dosen/kegiatan/{id}', [DosenController::class, 'detailKegiatan'])->name('dosen.kegiatan.detail');
   Route::post('/dosen/kegiatan/{id}/anggota', [DosenController::class, 'tambahAnggota'])->name('dosen.kegiatan.tambah');
});