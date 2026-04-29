<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('index');

/*
|--------------------------------------------------------------------------
| Auth (hanya untuk guest / belum login)
|--------------------------------------------------------------------------
*/
Route::prefix('auth')
    ->name('auth.')
    ->middleware('guest') // ⬅️ penting
    ->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    });

/*
|--------------------------------------------------------------------------
| Admin (harus login)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth') // ⬅️ wajib login
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/pendaftar', function () {
            return view('admin.pendaftar');
        })->name('pendaftar');
    });

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('auth.login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Resource (harus login juga)
|--------------------------------------------------------------------------
*/

Route::resource('/pendaftaran', PendaftaranController::class);