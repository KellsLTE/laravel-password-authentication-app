<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login/magic', [App\Http\Controllers\MagicLoginController::class, 'show'])->name('login-magic');

Route::post('/login/magic', [App\Http\Controllers\MagicLoginController::class, 'store'])->name('login-magic-post');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');