<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

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

//TOKEN - Administrador - validador de Rutas
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard/inicios', function () {
        return view('dashboard.inicios.index');
    })->name('dashboard');
    Route::get('/dashboard/vehiculos', function () {
        return view('dashboard.vehiculos.index');
    });

    Route::get('/profile', function () {
        return view('profile.show');
    });

    Route::resource('/dashboard/inicios', InicioController::class);
});



