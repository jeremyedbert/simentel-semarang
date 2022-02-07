<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardTowerMacroController;
use App\Http\Controllers\DashboardTowerMicroController;
use App\Http\Controllers\DashboardPetaMacroController;
use App\Http\Controllers\DashboardPetaMicroController;
use App\Http\Controllers\DashboardListController;
use App\Http\Controllers\DashboardRiwayatController;
use App\Http\Controllers\CekStatusController;


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

// Route::get('/', [HomeController::class, 'index'])->name('home');
/* Untuk User */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/peta-menara', [UserController::class, 'peta_menara'])->name('peta-menara');
    Route::get('/peta-microcell', [UserController::class, 'peta_microcell'])->name('peta-microcell');
    // Guest User
    Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [UserController::class, 'authenticate'])->name('check');
    });

    // Authenticated User
    Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
        Route::get('/daftar-menara', [FormController::class, 'index'])->name('daftar-menara');
        Route::get('/daftar-menara/getKelurahan', [FormController::class, 'getKelurahan'])->name('daftar-menara.getKelurahan');
        Route::post('daftar-menara/createTower', [FormController::class, 'createTower'])->name('daftar-menara.createTower');
        Route::get('/cekstatus', [CekStatusListController::class, 'index']);
        Route::resource('/cekstatus', CekStatusController::class, ['parameters' => ['cekstatus' => 'pendaftaran']]);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});

/* Untuk Admin */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::get('/login', [LoginController::class, 'index_admin'])->name('login');
        Route::post('/login', [AdminController::class, 'authenticate'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.welcome');
        });

        Route::get('/pendaftaran', [DashboardListController::class, 'index']);
        Route::post('/pendaftaran/{pendaftaran}/decline', [DashboardListController::class, 'decline']);
        Route::post('/pendaftaran/{pendaftaran}/accept', [DashboardListController::class, 'accept']);
        Route::resource('/pendaftaran', DashboardListController::class);
        // Delete
        // Route::post('/list/{pendaftaran:id}', [DashboardListController::class, 'destroy']);

        // Edit menara ketika belum diacc
        Route::resource('/riwayat', DashboardRiwayatController::class);
        // Route::resource('/menara', DashboardTowerMacroController::class);
        Route::prefix('/menara')->group(function () {
            Route::resource('/makro', DashboardTowerMacroController::class);
            Route::resource('/mikro', DashboardTowerMicroController::class);
        });
        Route::prefix('/peta')->group(function () {
            Route::resource('/makro', DashboardPetaMacroController::class);
            Route::resource('/mikro', DashboardPetaMicroController::class);
        });
    });
});
