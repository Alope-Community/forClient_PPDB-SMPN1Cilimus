<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardCcontroller;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Models\Pendaftaran;
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

        Route::get('/dashboard', AdminDashboardCcontroller::class)->name('dashboard');

        Route::resource('/pendaftar', AdminPendaftaranController::class);
    });


Route::prefix('siswa')
    ->name('siswa.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/dashboard', DashboardController::class)->name('dashboard');
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