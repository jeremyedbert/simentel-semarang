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
use App\Http\Controllers\DashboardZoneController;
use App\Http\Controllers\DashboardRiwayatController;
use App\Http\Controllers\CekStatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PetaMacroController;
use App\Http\Controllers\PetaMicroController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function () {
    // Route::get('/peta-menara', [PetaMacroController::class, 'index'])->name('peta-menara');
    Route::resource('/peta-menara', PetaMacroController::class, ['parameters' => ['peta-menara' => 'tower']]);
    Route::get('/peta-microcell', [PetaMicroController::class, 'index'])->name('peta-microcell');
    // Guest User
    Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [UserController::class, 'authenticate'])->name('check');
    });

    // Authenticated User
    Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
        Route::middleware('verified')->group(function (){
            Route::get('/daftar-menara', [FormController::class, 'index'])->name('daftar-menara');
            // Route::resource('/daftar-menara', FormController::class, ['parameters' => ['daftar-menara' => 'pendaftaran']]);
            Route::get('/daftar-menara/getKelurahan', [FormController::class, 'getKelurahan'])->name('daftar-menara.getKelurahan');
            // Route::post('daftar-menara/store', [FormController::class, 'store'])->name('daftar-menara.store');
            Route::post('/daftar-menara/upload', [FormController::class, 'upload'])->name('daftar-menara.upload');
            Route::post('/daftar-menara/store', [FormController::class, 'store'])->name('daftar-menara.store');
            
            // Route::get('/cekstatus', [CekStatusListController::class, 'index']);
            Route::resource('/cekstatus', CekStatusController::class, ['parameters' => ['cekstatus' => 'pendaftaran']]);
        });
        Route::post('/logout', [UserController::class, 'logout']);
        // Edit Profil User
        Route::get('/edit', [UserController::class, 'edit']);
        Route::post('/update', [UserController::class, 'update']);
    });
});

/* Untuk Admin */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::get('/login', [LoginController::class, 'index_admin'])->name('login');
        Route::post('/login', [AdminController::class, 'authenticate'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::post('/logout', [AdminController::class, 'logout']);
        Route::get('/pendaftaran', [DashboardListController::class, 'index']);
        Route::post('/pendaftaran/{pendaftaran}/decline', [DashboardListController::class, 'decline']);
        Route::post('/pendaftaran/{pendaftaran}/accept', [DashboardListController::class, 'accept']);
        Route::post('/notifikasi/{notifikasi}', [NotifikasiController::class, 'update']);
        Route::resource('/pendaftaran', DashboardListController::class);
        Route::resource('/kelola-user', DashboardUserController::class, ['parameters' => ['kelola-user' => 'user']]);
        Route::resource('/zona', DashboardZoneController::class, ['parameters' => ['zona' => 'zone']]);
        // Delete
        // Route::post('/list/{pendaftaran:id}', [DashboardListController::class, 'destroy']);

        // Edit menara ketika belum diacc
        Route::resource('/riwayat', DashboardRiwayatController::class, ['parameters' => ['riwayat' => 'pendaftaran']]);
        // Route::resource('/menara', DashboardTowerMacroController::class);
        Route::prefix('/menara')->group(function () {
            Route::resource('/makro', DashboardTowerMacroController::class, ['parameters' => ['makro' => 'tower']]);
            Route::resource('/mikro', DashboardTowerMicroController::class, ['parameters' => ['mikro' => 'tower']]);
        });
        Route::prefix('/peta')->group(function () {
            Route::resource('/makro', DashboardPetaMacroController::class, ['parameters' => ['makro' => 'tower']]);
            Route::resource('/mikro', DashboardPetaMicroController::class, ['parameters' => ['mikro' => 'tower']]);
        });
        Route::prefix('/cetak')->group(function(){
            Route::get('/', [PDFController::class, 'index']);
        });
    });
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');