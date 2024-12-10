<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KegiatanController;
use App\Http\Controllers\Api\NotifikasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);


    // Kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'index']);
    Route::get('/kegiatan/{id}', [KegiatanController::class, 'show']);
    Route::get('/kegiatan-user', [KegiatanController::class, 'userKegiatan']);
    Route::prefix('amount-kegiatan')->group(function () {
        Route::get('/', [KegiatanController::class, 'countByStatus']);
        Route::get('/by-user', [KegiatanController::class, 'countByUser']);
        Route::get('/by-category', [KegiatanController::class, 'countByCategory']);
    });


    // Notifikasi
    Route::get('/notifikasi', [NotifikasiController::class, 'index']);
});
