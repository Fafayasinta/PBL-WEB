<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
    return redirect('login');
});
Route::pattern('id', '[0-9]+');

//Route Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout']);
// Route Reset Password
Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->name('home');
    
    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/user/{id}', [UserController::class, 'updateUser'])->name('users.update');
    Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
});