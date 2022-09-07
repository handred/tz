<?php

use App\Http\Controllers\Goods;
use App\Http\Controllers\OrderController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function (Request $request) {
    Auth::login(User::find(1), 100000);
    return $request->user();
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return 'logout';
});

Route::get('catalog', [Goods::class, 'catalog']);

Route::post('/create-order', [OrderController::class, 'create'])
        ->middleware('auth')
;

