<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TugasAkhirController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard']);

// Tugas Akhir
Route::get('/tugasakhir/index', [TugasAkhirController::class, 'index'])->name('tugasakhir.index');
Route::get('/tugasakhir/add', [TugasAkhirController::class, 'add'])->name('tugasakhir.add');
Route::post('/tugasakhir/store', [TugasAkhirController::class, 'store'])->name('tugasakhir.store');

