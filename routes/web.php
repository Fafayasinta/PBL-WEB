<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenAnggotaController;
use App\Http\Controllers\DosenPICController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\WelcomeController;
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
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/pimpinan', [PimpinanController::class, 'index']);
Route::get('/dosenPIC', [DosenPICController::class, 'index']);
Route::get('/dosenAnggota', [DosenAnggotaController::class, 'index']);
