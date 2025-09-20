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
Route::get('/tugasakhir/{id}/edit', [TugasAkhirController::class, 'edit'])->name('tugasakhir.edit');
Route::put('/tugasakhir/{id}', [TugasAkhirController::class, 'update'])->name('tugasakhir.update');
Route::get('/tugasakhir/{id}/delete', [TugasAkhirController::class, 'destroy'])->name('tugasakhir.destroy');

