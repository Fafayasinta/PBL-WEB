<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenAnggotaController as ControllersDosenAnggotaController;

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
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
// Route Reset Password
Route::get('resetpassword', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('resetpassword', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// dosen
Route::get('/dosen', [App\Http\Controllers\DosenAnggota\DosenAnggotaController::class, 'index'])->name('dosen.dashboard');
Route::get('/kegiatandosenjti', [App\Http\Controllers\DosenAnggota\KegiatanJtiDosenController::class, 'index']);
Route::get('/kegiatandosennonjti', [App\Http\Controllers\DosenAnggota\KegiatanNonJtiDosenController::class, 'index']);
Route::get('/profile', [App\Http\Controllers\DosenAnggota\ProfileController::class, 'index']);

// Route::middleware('auth')->group(function () {
//     Route::get('/', [App\Http\Controllers\AdminController::class, 'index']);

 // dosen
//  Route::middleware(['authorize:DOSEN'])->group(function(){
//     Route::get('/dosen', [App\Http\Controllers\DosenAnggota\DosenAnggotaController::class, 'index'])->name('dosen.dashboard');

        // Route::group(['prefix' => 'user'], function () {
        //     Route::get('/', [App\Http\Controllers\DosenAnggota\DosenAnggotaController::class, 'index']);
        //     Route::post('/list', [App\Http\Controllers\Admin\UserController::class, 'list']);
        //     Route::get('/create_ajax', [App\Http\Controllers\Admin\UserController::class, 'create_ajax']);
        //     Route::post('/ajax', [App\Http\Controllers\Admin\UserController::class, 'store_ajax']);
        //     Route::get('/{id}/edit_ajax', [App\Http\Controllers\Admin\UserController::class, 'edit_ajax']);
        //     Route::put('/{id}/update_ajax', [App\Http\Controllers\Admin\UserController::class, 'update_ajax']);
        //     Route::get('/{id}/delete_ajax', [App\Http\Controllers\Admin\UserController::class, 'confirm_ajax']);
        //     Route::delete('/{id}/delete_ajax', [App\Http\Controllers\Admin\UserController::class, 'delete_ajax']);
        //     Route::get('/{id}/show_ajax', [App\Http\Controllers\Admin\UserController::class, 'show_ajax']);
        // });

        // Route::group(['prefix' => 'alpam'], function () {
        //     Route::get('/', [App\Http\Controllers\Admin\AlpaController::class, 'index']);
        // });

        // Route::group(['prefix' => 'kompenma'], function () {
        //     Route::get('/', [App\Http\Controllers\Admin\KompenMhsController::class, 'index']);
        // });

        // Route::group(['prefix' => 'tugas'], function () {
        //     Route::get('/', [App\Http\Controllers\Admin\TugasController::class, 'index']);
        //     Route::get('/create_ajax', [App\Http\Controllers\Admin\TugasController::class, 'create_ajax']);
        //     Route::post('/ajax', [App\Http\Controllers\Admin\TugasController::class, 'store_ajax']);
        //     Route::get('/{id}/detail', [App\Http\Controllers\Admin\TugasController::class, 'detail']);
        //     Route::get('/getkompetensi/{jenis_id}', [App\Http\Controllers\Admin\TugasController::class, 'kompetensi']);
        //     Route::get('/{id}/edit_ajax', [App\Http\Controllers\Admin\TugasController::class, 'edit_ajax']);     
        //     Route::put('/{id}/update_ajax', [App\Http\Controllers\Admin\TugasController::class, 'update_ajax']);
        //     Route::get('/{id}/delete_ajax', [App\Http\Controllers\Admin\TugasController::class, 'confirm_ajax']);  
        //     Route::delete('/{id}/delete_ajax', [App\Http\Controllers\Admin\TugasController::class, 'delete_ajax']);
        // });

        // Route::group(['prefix' => 'jenis'], function () {
        //     Route::get('/', [App\Http\Controllers\Admin\JenisController::class, 'index']);
        //     Route::get('/create_ajax', [App\Http\Controllers\Admin\JenisController::class, 'create_ajax']);
        //     Route::post('/ajax', [App\Http\Controllers\Admin\JenisController::class, 'store_ajax']);
        //     Route::get('/{id}/edit_ajax', [App\Http\Controllers\Admin\JenisController::class, 'edit_ajax']);     
        //     Route::put('/{id}/update_ajax', [App\Http\Controllers\Admin\JenisController::class, 'update_ajax']);
        //     Route::get('/{id}/delete_ajax', [App\Http\Controllers\Admin\JenisController::class, 'confirm_ajax']);  
        //     Route::delete('/{id}/delete_ajax', [App\Http\Controllers\Admin\JenisController::class, 'delete_ajax']);
        // });

        // Route::group(['prefix' => 'kompetensi'], function () {
        //     Route::get('/', [App\Http\Controllers\Admin\KompetensiController::class, 'index']);
        //     Route::get('/create_ajax', [App\Http\Controllers\Admin\KompetensiController::class, 'create_ajax']);
        //     Route::post('/ajax', [App\Http\Controllers\Admin\KompetensiController::class, 'store_ajax']);
        //     Route::get('/{id}/edit_ajax', [App\Http\Controllers\Admin\KompetensiController::class, 'edit_ajax']);     
        //     Route::put('/{id}/update_ajax', [App\Http\Controllers\Admin\KompetensiController::class, 'update_ajax']);
        //     Route::get('/{id}/delete_ajax', [App\Http\Controllers\Admin\KompetensiController::class, 'confirm_ajax']);  
        //     Route::delete('/{id}/delete_ajax', [App\Http\Controllers\Admin\KompetensiController::class, 'delete_ajax']);
        // });

        // Route::group(['prefix' => 'pesan'], function () {
        //     Route::get('/', [App\Http\Controllers\Admin\PesanController::class, 'index']);
        // });
        
        // Route::group(['prefix' => 'profil'], function() {
        //     Route::get('/', [App\Http\Controllers\Admin\ProfileController::class, 'index']);
        //     Route::get('/{id}/edit_ajax', [App\Http\Controllers\Admin\ProfileController::class, 'edit_ajax']);
        //     Route::put('/{id}/update_ajax', [App\Http\Controllers\Admin\ProfileController::class, 'update_ajax']);
        //     Route::get('/{id}/edit_foto', [App\Http\Controllers\Admin\ProfileController::class, 'edit_foto']);
        //     Route::put('/{id}/update_foto', [App\Http\Controllers\Admin\ProfileController::class, 'update_foto']);
        // });
//     });
// });

























// Route::get('/', function () {
//     return redirect('login');
// });
// Route::pattern('id', '[0-9]+');

// //Route Login
// Route::get('login', [AuthController::class, 'login'])->name('login');
// Route::post('login', [AuthController::class, 'postlogin']);
// Route::get('logout', [AuthController::class, 'logout']);
// // Route Reset Password
// Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

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