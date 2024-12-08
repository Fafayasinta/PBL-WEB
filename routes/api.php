<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeriodeAPIController;
use App\Http\Controllers\Api\PimpinanAPIController;
use App\Http\Controllers\Api\ProfileAPIController;
use App\Http\Controllers\Api\StatistikAPIController;
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
});


Route::get('/periode', [PeriodeAPIController::class, 'index']);
Route::get('/periode/{id}', [PeriodeAPIController::class, 'show']);
Route::post('/periode', [PeriodeAPIController::class, 'store']);
Route::put('/periode/{id}', [PeriodeAPIController::class, 'update']);
Route::delete('/periode/{id}', [PeriodeAPIController::class, 'destroy']);


Route::get('/pimpinan/dashboard', [PimpinanAPIController::class, 'dashboard']);
Route::get('/pimpinan/kegiatan', [PimpinanAPIController::class, 'list']);


Route::get('/profile', [ProfileAPIController::class, 'index']);
Route::put('/profile/update', [ProfileAPIController::class, 'update']);



Route::get('/statistik', [StatistikAPIController::class, 'index']);
Route::get('/statistik/{id}', [StatistikAPIController::class, 'show']);
