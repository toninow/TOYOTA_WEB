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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard/inicio', function () {
        return view('dashboard.inicio.index');
    })->name('dashboard');
});

Route::get('/dashboard/vehiculos', function () {
    return view('dashboard.vehiculos.index');
});

Route::get('/profile', function () {
    return view('profile.show');
});

