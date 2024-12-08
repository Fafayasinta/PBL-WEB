<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeriodeAPIController;
use App\Http\Controllers\Api\PimpinanAPIController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/periode', [PeriodeAPIController::class, 'index']);
Route::get('/periode/{id}', [PeriodeAPIController::class, 'show']);
Route::post('/periode', [PeriodeAPIController::class, 'store']);
Route::put('/periode/{id}', [PeriodeAPIController::class, 'update']);
Route::delete('/periode/{id}', [PeriodeAPIController::class, 'destroy']);


Route::get('/pimpinan/dashboard', [PimpinanAPIController::class, 'dashboard']);
Route::get('/pimpinan/kegiatan', [PimpinanAPIController::class, 'list']);

