<?php

use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/form', function () {
    return view('form');
});

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');