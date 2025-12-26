<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController; // Pastikan ini ada
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Inertia\Inertia;
use App\Http\Controllers\LandingController; // <--- Import Controller

// Route Detail Properti (Menerima parameter ID)
Route::get('/property/{id}', [App\Http\Controllers\LandingController::class, 'show'])->name('property.show');

// Route Halaman Pembayaran
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/{id}', [App\Http\Controllers\LandingController::class, 'payment'])->name('payment.show');
    Route::post('/payment/process', [App\Http\Controllers\LandingController::class, 'processPayment'])->name('payment.process');
    Route::get('/profil', [App\Http\Controllers\LandingController::class, 'profil'])->name('profil');
    Route::get('/ticket-status/{transactionCode}', [App\Http\Controllers\LandingController::class, 'trackTicket'])->name('ticket.status');
});

// Ubah route '/' default menjadi ini:
Route::get('/', [LandingController::class, 'index'])->name('landing');
// Route untuk halaman list properti publik
Route::get('/temukan-lahan', [LandingController::class, 'listing'])->name('listing.index');

Route::get('/dashboard', function () {
    return view('dashboard'); // <--- Mengarah ke dashboard.blade.php
})->middleware(['auth', 'verified', 'admin'])->name('dashboard'); 
// Catatan: Saya tambahkan middleware 'admin' agar dashboard ini hanya untuk admin

// 3. FITUR PROFIL (Harus Login dulu)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Akses membuat properti: bisa diakses oleh semua user yang terautentikasi (admin, penjual, pembeli)
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
});

// Route Publik (Bisa diakses siapa saja, misal halaman depan)
// Route::get('/', ...); 

// GROUP ROUTE KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard Admin
    Route::get('/admin', [PropertyController::class, 'index'])->name('properties.index');

    // Routes untuk manajemen properti oleh admin
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

    // Manajemen user oleh admin
    Route::get('/users', [UserController::class, 'index'])->name('users.index');    
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');

    Route::get('/admin/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
    Route::post('/admin/tickets/{id}/update', [App\Http\Controllers\TicketController::class, 'update'])->name('tickets.update');

});

// 4. SISTEM AUTH (Login/Register bawaan)
require __DIR__.'/auth.php';