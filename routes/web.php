<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController; // Pastikan ini ada
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// 1. Route untuk Menampilkan Halaman Edit
Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');

// 2. Route untuk Memproses Perubahan (Update)
Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');

// 1. Halaman Utama (Index + Search + Filter)
Route::get('/', [PropertyController::class, 'index'])->name('properties.index');

// 2. Halaman Form Tambah Property (Harus diletakkan SEBELUM route dinamis lain jika ada)
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');

// 3. Proses Simpan Data ke Database
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA (LANDHUB)
// Ini akan memanggil controller yang baru kita buat dan menampilkan daftar tanah



// 2. DASHBOARD (Halaman setelah Login)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// 3. FITUR PROFIL (Harus Login dulu)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. SISTEM AUTH (Login/Register bawaan)
require __DIR__.'/auth.php';