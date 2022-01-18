<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
/* Untuk User */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/peta-menara', [UserController::class, 'peta_menara'])->name('peta-menara');
    Route::get('/peta-microcell', [UserController::class, 'peta_microcell'])->name('peta-microcell');
    Route::middleware(['guest'])->group(function () {
        Route::get('/register', [RegisterUserController::class, 'index'])->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::get('/login', [LoginUserController::class, 'index'])->name('login');
        Route::post('/login', [LoginUserController::class, 'authenticate']);
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/daftar-menara', [FormController::class, 'index'])->name('daftar-menara');
        Route::post('/logout', [LoginUserController::class, 'logout']);
    });
});

/* Untuk Admin */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        // Route::get('/login', [LoginUserController::class, 'index'])->name('login');
    });
});


// Route::get('/login-admin', function () {
//     return view('admin.login');
// });

// Route::get('/admin', function () {
//     return view('admin.welcome');
// });
