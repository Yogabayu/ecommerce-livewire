<?php

use App\Livewire\Admin\Auth;
use App\Livewire\Contact;
use App\Livewire\Home;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',Home::class);
// Route::get('/contact',Contact::class)->name('contact');

Route::prefix('admin')->group(function(){
    Route::get('login', Auth::class)->name('login');
    Route::get('dashboard', function(){
        return view('pages.admin.dashboard');
    })->name('admin-dashboard');
});
