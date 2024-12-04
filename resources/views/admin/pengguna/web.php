<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JabatanKegiatanController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\JenisPenggunaController;
use App\Http\Controllers\KegiatanJtiController;
use App\Http\Controllers\KegiatanNonJtiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

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

Route::pattern('id', '[0-9]+');

Route::get('/', function () {
    return redirect()->route('login');
});

//Route Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
// Route Register
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);
// Route Reset Password
Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');



Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('/home', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADMIN'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/list', [AdminController::class, 'list']);
        
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'index']);
        });
        
        Route::group(['prefix' => 'jeniskegiatan'], function () {
            Route::get('/', [JenisKegiatanController::class, 'index']);
            Route::post('/list', [JenisKegiatanController::class, 'list']);
            Route::get('/create_ajax', [JenisKegiatanController::class, 'create_ajax']);
            Route::post('/ajax', [JenisKegiatanController::class, 'store_ajax']);
            Route::get('/{id}/show_ajax', [JenisKegiatanController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [JenisKegiatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [JenisKegiatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [JenisKegiatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [JenisKegiatanController::class, 'delete_ajax']);
        });
        
        Route::group(['prefix' => 'jabatankegiatan'], function () {
            Route::get('/', [JabatanKegiatanController::class, 'index']);
            Route::post('/list', [JabatanKegiatanController::class, 'list']);
            Route::get('/{id}/show_ajax', [JabatanKegiatanController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [JabatanKegiatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [JabatanKegiatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [JabatanKegiatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [JabatanKegiatanController::class, 'delete_ajax']);
        });
        
        Route::group(['prefix' => 'kegiatanjti'], function () {
            Route::get('/', [KegiatanJtiController::class, 'index']);
            Route::post('/list', [KegiatanJtiController::class, 'list']);
            Route::get('/{id}/show_ajax', [KegiatanJtiController::class, 'show_ajax']);
        });
        
        Route::group(['prefix' => 'kegiatannonjti'], function () {
            Route::get('/', [KegiatanNonJtiController::class, 'index']);
            Route::post('/list', [KegiatanNonJtiController::class, 'list']);
            Route::get('/{id}/show_ajax', [KegiatanNonJtiController::class, 'show_ajax']);
        });
        
        Route::group(['prefix' => 'jenispengguna'], function () {
            Route::get('/', [JenisPenggunaController::class, 'index']);
            Route::post('/list', [JenisPenggunaController::class, 'list']);
            Route::get('/{id}/show_ajax', [JenisPenggunaController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [JenisPenggunaController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [JenisPenggunaController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [JenisPenggunaController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [JenisPenggunaController::class, 'delete_ajax']);
        });
        
        Route::group(['prefix' => 'pengguna'], function () {
            Route::get('/', [PenggunaController::class, 'index']);
            Route::post('/list', [PenggunaController::class, 'list']);
            Route::get('/{id}/show_ajax', [PenggunaController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [PenggunaController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [PenggunaController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [PenggunaController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [PenggunaController::class, 'delete_ajax']);
        });
        
        Route::group(['prefix' => 'statistik'], function () {
            Route::get('/', [StatistikController::class, 'index']);
        });
    });
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {
//         return view('dashboard');
//     })->name('home');
    
//     Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
//     Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::put('/user/{id}', [UserController::class, 'updateUser'])->name('users.update');
//     Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
// });
