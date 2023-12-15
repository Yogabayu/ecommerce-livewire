<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('actionLogin', [AuthController::class, 'actionLogin'])->name('actionLogin');

    Route::middleware('auth')->group(function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('user', UserController::class);
        //     Route::get('user', User::class)->name('user');
    });
});
