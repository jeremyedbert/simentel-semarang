<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginUserController;

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

/* Untuk User */
Route::get('/', [HomeController::class, 'index']);
Route::get('/login-user', [LoginUserController::class, 'index'])->name('login-user')->middleware('guest');

Route::post('/login-user', [LoginUserController::class, 'authenticate']);

Route::get('/daftar-menara', [FormController::class, 'index']);

Route::get('/peta-menara', [UserController::class, 'peta_menara']);

Route::get('/peta-microcell', [UserController::class, 'peta_microcell']);

Route::get('/login-admin', function () {
    return view('admin.login');
});

Route::get('/admin', function () {
    return view('admin.welcome');
});
