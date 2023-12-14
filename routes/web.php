<?php

use App\Livewire\Admin\Auth;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\User;
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
    Route::get('login', Auth::class)->name('login');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('user', User::class)->name('user');
    });
});
