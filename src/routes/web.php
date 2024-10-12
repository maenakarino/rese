<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class, 'index']);
Route::view('/done', 'done');

Route::get('/favorite', [ShopController::class, 'index'])->name('favorite');

Route::middleware('auth')->group(function () {
     Route::get('/', [AuthController::class, 'index']);
     Route::get('/logout', [AuthController::class,'getLogout']);
     Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
     Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
     
 });

Route::post('/register', [AuthController::class, 'store']);

 Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search')->name('search');
    Route::get('/detail/{shop_id}', 'detail');
});

Route::get('/shops/search', [ShopController::class, 'search']);

Route::post('/register', [AuthController::class,'postRegister']);
Route::post('/login', [AuthController::class,'postLogin']);
Route::view('/thanks', 'auth.thanks');

Route::controller(FavoriteController::class)->group(function () {
        Route::post('/favorite/store/{shop}', 'store')->name('favorite');
        Route::delete('/favorite/destroy/{shop}', 'destroy')->name('unfavorite');
    });

Route::prefix('reserve')->controller(ReserveController::class)->group(function () {
    Route::post('/reserve/store/{shop}', 'store')->name('reserve');
    Route::get('/done', 'done')->name('done');  // 正しいルート定義
    Route::delete('/destroy/{reserve}', 'destroy')->name('reserve.destroy');
    Route::get('/edit/{reserve}', 'edit')->name('reserve.edit');
    Route::post('/update/{reserve}', 'update')->name('reserve.update');
});