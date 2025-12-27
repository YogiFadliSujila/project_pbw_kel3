<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('properties')->latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        if ($request->status == 'admin') {
            $query->where('role', 'admin');
        } elseif ($request->status == 'penjual') {
            $query->has('properties');
        } elseif ($request->status == 'pencari') {
            $query->whereDoesntHave('properties')->where('role', '!=', 'admin');
        }
        $users = $query->paginate(10)->appends($request->all());
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

        $pencariCount = User::whereDoesntHave('properties')
                            ->where('role', '!=', 'admin')
                            ->count();
        
        // Growth Pencari (User baru bulan ini yg belum upload properti)
        $pencariThisMonth = User::whereDoesntHave('properties')
                                ->where('role', '!=', 'admin')
                                ->whereMonth('created_at', Carbon::now()->month)->count();
        $pencariLastMonth = User::whereDoesntHave('properties')
                                ->where('role', '!=', 'admin')
                                ->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $pencariGrowth = $this->calculateGrowth($pencariThisMonth, $pencariLastMonth);


        // --- CARD 2: PENJUAL LAHAN (User yang punya properti) ---
        $penjualCount = User::has('properties')->count();

        // Growth Penjual
        $penjualThisMonth = User::has('properties')
                                ->whereMonth('created_at', Carbon::now()->month)->count();
        $penjualLastMonth = User::has('properties')
                                ->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $penjualGrowth = $this->calculateGrowth($penjualThisMonth, $penjualLastMonth);


        // --- CARD 3: TOTAL USERS ---
        $totalUsers = User::count();
        $usersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count();
        $usersLastMonth = User::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $totalUserGrowth = $this->calculateGrowth($usersThisMonth, $usersLastMonth);


        // --- CARD 4: THIS MONTH (User Baru Bergabung) ---
        $newUsersCount = $usersThisMonth; // Sama dengan variabel di atas
        $newUserGrowth = $totalUserGrowth; // Sama dengan growth total user baru


        return view('users.index', compact(
            'users',
            'pencariCount', 'pencariGrowth',
            'penjualCount', 'penjualGrowth',
            'totalUsers', 'totalUserGrowth',
            'newUsersCount', 'newUserGrowth'
        ));

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

    // Helper Function Hitung Persentase
    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }

    // ... method edit, update, destroy lainnya biarkan tetap ada ...

}