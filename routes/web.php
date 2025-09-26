<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TugasAkhirController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/create-user', [AdminController::class, 'createUser'])->name('admin.create-user');
    Route::post('/create-user', [AdminController::class, 'storeUser'])->name('admin.store-user');

    Route::get('/users', [AdminController::class, 'listUsers'])->name('admin.users');

    // Hapus akun
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.delete-user');

    // Ubah password
    Route::put('/admin/users/{id}/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');

    Route::get('/tugasakhir/index', [TugasAkhirController::class, 'index'])->name('admin.tugasakhir.index');
    Route::get('/tugasakhir/add', [TugasAkhirController::class, 'add'])->name('tugasakhir.add');
    Route::post('/tugasakhir/store', [TugasAkhirController::class, 'store'])->name('tugasakhir.store');

    Route::get('/tugasakhir/{id_tugas_akhir}/edit', [TugasAkhirController::class, 'edit'])->name('tugasakhir.edit');
    Route::put('/tugasakhir/{id_tugas_akhir}/update', [TugasAkhirController::class, 'update'])->name('tugasakhir.update');
    Route::delete('/tugasakhir/{id_tugas_akhir}/delete', [TugasAkhirController::class, 'delete'])
        ->name('tugasakhir.delete');

    Route::get('admin/cetak/index', [App\Http\Controllers\PendadaranController::class, 'index'])->name('admin.pendadaran.index');
    Route::get('admin/{id}/cetak-revisi', [MahasiswaController::class, 'cetakRevisi'])
    ->name('admin./cetak/form_revisi');
    
});

// Dosen routes
Route::middleware(['auth:dosen'])->prefix('dosen')->group(function () {
    Route::get('/', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
});

// Mahasiswa routes
Route::middleware(['auth'])->prefix('mahasiswa')->group(function () {
    Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
});
