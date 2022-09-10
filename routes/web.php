<?php

use App\Http\Controllers\GoodsController;
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

Route::get('login', function (Request $request) {
    Auth::login(User::find(1), true);
    return $request->user();
})->name('login');

Route::get('logout', function () {
    Auth::logout();
    return 'logout';
});

Route::get('catalog', [GoodsController::class, 'index']);

Route::get('catalog/{item}', [GoodsController::class, 'view']);

Route::post('create-order', [OrderController::class, 'create'])
        ->middleware('auth');

Route::post('approve-order', [OrderController::class, 'approve'])
        ->middleware('auth');

