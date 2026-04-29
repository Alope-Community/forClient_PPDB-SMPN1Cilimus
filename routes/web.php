<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::get("/login", [AuthController::class, 'login'])->name('auth.login');
Route::post("/login", [AuthController::class, 'authenticate'])->name('auth.authenticate');


Route::resource("/pendaftaran", PendaftaranController::class);