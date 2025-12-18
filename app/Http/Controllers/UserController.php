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
        
        // Contoh logika jika nanti ada role spesifik (sesuaikan dengan database Anda)
        // Misal: role 'pencari' dan 'penjual'. Jika belum ada, data ini bisa dummy dulu.
        $pencariLahan = User::where('role', 'pencari')->count(); 
        $penjualLahan = User::where('role', 'penjual')->count();

        // 2. Data untuk Tabel (Bagian Bawah)
        // Mengambil semua user, diurutkan terbaru, dan dipaginate 10 per halaman
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users', 'totalUsers', 'thisMonth', 'pencariLahan', 'penjualLahan'));
    }
}