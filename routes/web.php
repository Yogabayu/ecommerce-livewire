<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
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
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::resource('dashboard', DashboardController::class);

        //user
        Route::resource('user', UserController::class);
        Route::get('show-user/{uuid}', [UserController::class, 'showUser'])->name('showUser');
        Route::put('update-user/{uuid}', [UserController::class, 'updateUser'])->name('updateUser');

        Route::resource('banner', BannerController::class);
        Route::resource('setting', SettingController::class);
        Route::resource('tag', TagController::class);
        Route::resource('faq', FaqController::class);

        //categories
        Route::resource('category', CategoryController::class);
        Route::put('category-update/{slug}', [CategoryController::class, 'update'])->name('category-update');

        //product
        Route::resource('product', ProductController::class);
        Route::get('get-cities/{provinceCode}', [ProductController::class, 'getCities'])->name('getCities');
        Route::put('product-update/{slug}', [ProductController::class, 'update'])->name('product-update');
        Route::get('change-visibility/{id}', [ProductController::class, 'changeVisibility'])->name('changeVisibility');
        Route::post('add-photos', [ProductController::class, 'addPhotos'])->name('addPhotos');
        Route::get('delete-photos/{id}', [ProductController::class, 'deletePhotos'])->name('deletePhotos');
        Route::get('change-primary/{id}', [ProductController::class, 'changePhotoPrimary'])->name('changePhotoPrimary');
    });
});
