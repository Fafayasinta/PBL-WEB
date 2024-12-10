<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AgendaKegiatanController;
use App\Http\Controllers\AnggotaKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JabatanKegiatanController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\JenisPenggunaController;
use App\Http\Controllers\KegiatanJtiController;
use App\Http\Controllers\KegiatanNonJtiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PeriodeController;
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
        
        
        Route::group(['prefix' => 'jeniskegiatan'], function () {
            Route::get('/', [JenisKegiatanController::class, 'index']);
            Route::post('/list', [JenisKegiatanController::class, 'list']);
            Route::get('/{id}/show_ajax', [JenisKegiatanController::class, 'show_ajax']);
            Route::get('/create_ajax', [JenisKegiatanController::class, 'create_ajax']);
            Route::post('/ajax', [JenisKegiatanController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [JenisKegiatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [JenisKegiatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [JenisKegiatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [JenisKegiatanController::class, 'delete_ajax']);
        });
        
        Route::group(['prefix' => 'jabatankegiatan'], function () {
            Route::get('/', [JabatanKegiatanController::class, 'index']);
            Route::post('/list', [JabatanKegiatanController::class, 'list']);
            Route::get('/{id}/show_ajax', [JabatanKegiatanController::class, 'show_ajax']);
            Route::get('/create_ajax', [JabatanKegiatanController::class, 'create_ajax']);
            Route::post('/ajax', [JabatanKegiatanController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [JabatanKegiatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [JabatanKegiatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [JabatanKegiatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [JabatanKegiatanController::class, 'delete_ajax']);
        });
        
        Route::group(['prefix' => 'kegiatanjti'], function () {
            // Route::get('/', [KegiatanJtiController::class, 'index']);
            // Route::post('/list', [KegiatanJtiController::class, 'list']);
            // Route::get('/{id}/show', [KegiatanJtiController::class, 'show']);
            // Route::post('{id}/listAnggota', [KegiatanJtiController::class, 'listAnggota']);
            // Route::post('{id}/listAgenda', [KegiatanJtiController::class, 'listAgenda']);
            Route::get('/create_ajax', [KegiatanJtiController::class, 'create_ajax']);
            Route::post('/ajax', [KegiatanJtiController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [KegiatanJtiController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [KegiatanJtiController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [KegiatanJtiController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [KegiatanJtiController::class, 'delete_ajax']);
        });

        Route::group(['prefix' => 'anggota'], function () {
            Route::get('/create_ajax', [AnggotaKegiatanController::class, 'create_ajax']);
            Route::post('/ajax', [AnggotaKegiatanController::class, 'store_ajax']);
            Route::get('/{id}/show_ajax', [AnggotaKegiatanController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [AnggotaKegiatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [AnggotaKegiatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [AnggotaKegiatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [AnggotaKegiatanController::class, 'delete_ajax']);
        });

        Route::group(['prefix' => 'agenda'], function () {
            Route::get('/create_ajax', [AgendaKegiatanController::class, 'create_ajax']);
            Route::post('/ajax', [AgendaKegiatanController::class, 'store_ajax']);
            Route::get('/{id}/show_ajax', [AgendaKegiatanController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [AgendaKegiatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [AgendaKegiatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [AgendaKegiatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [AgendaKegiatanController::class, 'delete_ajax']);
        });

        Route::group(['prefix' => 'periode'], function () {
            Route::get('/', [PeriodeController::class, 'index']);
            Route::post('/list', [PeriodeController::class, 'list']);
            Route::get('/{id}/show_ajax', [PeriodeController::class, 'show_ajax']);
            Route::get('/create_ajax', [PeriodeController::class, 'create_ajax']);
            Route::post('/ajax', [PeriodeController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [PeriodeController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [PeriodeController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [PeriodeController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [PeriodeController::class, 'delete_ajax']);
        });

        Route::group(['prefix' => 'kegiatannonjti'], function () {
            // Route::get('/', [KegiatanNonJtiController::class, 'index']);
            // Route::post('/list', [KegiatanNonJtiController::class, 'list']);
            // Route::get('/{id}/show_ajax', [KegiatanNonJtiController::class, 'show_ajax']);
            Route::get('/create_ajax', [KegiatanNonJtiController::class, 'create_ajax']);
            Route::post('/ajax', [KegiatanNonJtiController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [KegiatanNonJtiController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [KegiatanNonJtiController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [KegiatanNonJtiController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [KegiatanNonJtiController::class, 'delete_ajax']);
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
            Route::get('/create_ajax', [PenggunaController::class, 'create_ajax']);
            Route::post('/ajax', [PenggunaController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [PenggunaController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [PenggunaController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [PenggunaController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [PenggunaController::class, 'delete_ajax']);
        });
        
    });
});

//Pimpinan dan Admin
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('/home', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:PIMPINAN,ADMIN'])->group(function () {
        Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan.dashboard');
        Route::post('/pimpinan/list', [PimpinanController::class, 'list']);
        
        Route::group(['prefix' => 'statistik'], function () {
            Route::get('/', [StatistikController::class, 'index']);
        });
    });
});

//Dosen
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('/home', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:DOSEN,ADMIN,PIMPINAN'])->group(function () {
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.dashboard');
        Route::post('/dosen/list', [DosenController::class, 'list']);
        
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'index']);
        });
        
        Route::group(['prefix' => 'kegiatanjti'], function () {
            Route::get('/', [KegiatanJtiController::class, 'index']);
            Route::post('/list', [KegiatanJtiController::class, 'list']);
            Route::get('/{id}/show', [KegiatanJtiController::class, 'show']);
            Route::post('{id}/listAnggota', [KegiatanJtiController::class, 'listAnggota']);
            Route::post('{id}/listAgenda', [KegiatanJtiController::class, 'listAgenda']);
            // Route::get('/create_ajax', [KegiatanJtiController::class, 'create_ajax']);
            // Route::post('/ajax', [KegiatanJtiController::class, 'store_ajax']);
            // Route::get('/{id}/edit_ajax', [KegiatanJtiController::class, 'edit_ajax']);
            // Route::put('/{id}/update_ajax', [KegiatanJtiController::class, 'update_ajax']);
            // Route::get('/{id}/delete_ajax', [KegiatanJtiController::class, 'confirm_ajax']);
            // Route::delete('/{id}/delete_ajax', [KegiatanJtiController::class, 'delete_ajax']);
        });

        Route::group(['prefix' => 'agenda'], function () {
            Route::get('/', [AgendaKegiatanController::class, 'index']);
            Route::post('/list', [AgendaKegiatanController::class, 'list']);
            Route::get('/create_ajax', [AgendaKegiatanController::class, 'create_ajax']);
            Route::post('/ajax', [AgendaKegiatanController::class, 'store_ajax']);
            Route::get('/{id}/show_ajax', [AgendaKegiatanController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [AgendaKegiatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [AgendaKegiatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [AgendaKegiatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [AgendaKegiatanController::class, 'delete_ajax']);
        });

        Route::group(['prefix' => 'kegiatannonjti'], function () {
            Route::get('/', [KegiatanNonJtiController::class, 'index']);
            Route::post('/list', [KegiatanNonJtiController::class, 'list']);
            Route::get('/{id}/show_ajax', [KegiatanNonJtiController::class, 'show_ajax']);
            // Route::get('/create_ajax', [KegiatanNonJtiController::class, 'create_ajax']);
            // Route::post('/ajax', [KegiatanNonJtiController::class, 'store_ajax']);
            // Route::get('/{id}/edit_ajax', [KegiatanNonJtiController::class, 'edit_ajax']);
            // Route::put('/{id}/update_ajax', [KegiatanNonJtiController::class, 'update_ajax']);
            // Route::get('/{id}/delete_ajax', [KegiatanNonJtiController::class, 'confirm_ajax']);
            // Route::delete('/{id}/delete_ajax', [KegiatanNonJtiController::class, 'delete_ajax']);
        });
    });
});