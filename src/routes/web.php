<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;

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

Route::get('/favorite', [ShopController::class, 'index'])->name('favorite');

Route::middleware('auth')->group(function () {
     Route::get('/', [AuthController::class, 'index']);
 });

Route::post('/register', [AuthController::class, 'store']);

 Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search')->name('search');
    Route::get('/detail/{shop_id}', 'detail');
});