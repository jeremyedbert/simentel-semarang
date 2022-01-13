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
    return view('user.welcome');
});

Route::get('/peta-menara', function () {
    return view('user.peta-menara');
});

Route::get('/peta-microcell', function () {
    return view('user.peta-microcell');
});

Route::get('/login-user', function () {
    return view('user.login-user');
});

Route::get('/login-admin', function () {
    return view('user.login-admin');
});

Route::get('/login-admin', function () {
    return view('user.login-admin');
});

Route::get('/daftar-menara', function () {
    return view('user.form-menara');
});

Route::get('/daftar-microcell', function () {
    return view('user.form-microcell');
});

Route::get('/admin', function () {
    return view('admin.welcome');
});