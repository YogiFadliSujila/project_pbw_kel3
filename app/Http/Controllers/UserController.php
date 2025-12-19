<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // 1. Data untuk Stats Cards (Bagian Atas)
        // Asumsi: Kita membedakan role berdasarkan string atau logic tertentu.
        // Di sini saya buat simulasi hitungannya:
        $totalUsers = User::count();
        $thisMonth = User::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        
        // Hitung berdasarkan apakah user memiliki property (dipakai untuk memasang iklan)
        // Jika user memiliki property => penjual lahan
        $penjualLahan = User::whereHas('properties')->count();
        // Jika tidak memiliki property dan bukan admin => pencari lahan
        $pencariLahan = User::whereDoesntHave('properties')->where('role', '!=', 'admin')->count();

        // 2. Data untuk Tabel (Bagian Bawah)
        // Mengambil semua user, diurutkan terbaru, dan dipaginate 10 per halaman
        // Eager load properties sehingga view bisa mengecek dengan efisien
        $users = User::with('properties')->latest()->paginate(10);

        return view('users.index', compact('users', 'totalUsers', 'thisMonth', 'pencariLahan', 'penjualLahan'));
    }

    // Placeholder edit — route exists but full edit UI not implemented yet.
    public function edit(User $user)
    {
        return redirect()->route('users.index')->with('error', 'Fitur edit belum tersedia.');
    }

    // Destroy user
    public function destroy(User $user)
    {
        // Prevent deleting admin accounts accidentally
        if ($user->role === 'admin') {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus admin.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}