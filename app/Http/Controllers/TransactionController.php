<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Start Query
        $query = Transaction::with('user')->latest();

        // 1. Logika Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Cari berdasarkan ID Transaksi
                $q->where('id', 'like', "%{$search}%")
                  // JIKA ADA kolom 'transaction_code' atau 'invoice_number', tambahkan ini:
                  ->orWhere('transaction_code', 'like', "%{$search}%") 
                  ->orWhere('property_id', 'like', "%{$search}%") 
                  
                  // Cari berdasarkan User (Nama atau Email)
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Logika Filter Status
        // Cek jika status ada isinya DAN bukan 'All Status' (jika value optionnya text)
        if ($request->filled('status') && $request->status !== 'All Status') {
            $query->where('status', $request->status);
        }

        // 3. Eksekusi Pagination dengan APPENDS (PENTING!)
        // 'appends' menjaga agar search & filter tidak hilang saat klik halaman 2, 3, dst.
        $transactions = $query->paginate(10)->appends($request->all());

        // ==========================================
        // 2. HITUNG STATISTIK KARTU (REAL DATA)
        // ==========================================

        // --- CARD 1: TOTAL TRANSACTIONS ---
        $totalTransactions = Transaction::count();
        
        // Growth Mingguan (Minggu ini vs Minggu Lalu)
        $txThisWeek = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $txLastWeek = Transaction::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->count();
        $txGrowth = $this->calculateGrowth($txThisWeek, $txLastWeek);


        // --- CARD 2: TOTAL REVENUE (10% Fee dari Harga Properti) ---
        // Logika: Ambil semua transaksi sukses, jumlahkan harganya, lalu kali 10%
        $totalRevenue = Transaction::where('status', 'Success')->sum('price') * 0.10;
        
        // Growth Revenue Mingguan
        $revThisWeek = Transaction::where('status', 'Success')
                        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->sum('price') * 0.10;
        $revLastWeek = Transaction::where('status', 'Success')
                        ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                        ->sum('price') * 0.10;
        $revGrowth = $this->calculateGrowth($revThisWeek, $revLastWeek);


        // --- CARD 3: ACTIVE BUYERS ---
        // Menghitung user unik yang pernah membeli
        $activeBuyers = Transaction::distinct('user_id')->count('user_id');
        
        // Growth Buyers (User unik yang transaksi minggu ini)
        $buyersThisWeek = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                            ->distinct('user_id')->count('user_id');
        $buyersLastWeek = Transaction::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                            ->distinct('user_id')->count('user_id');
        $buyersGrowth = $this->calculateGrowth($buyersThisWeek, $buyersLastWeek);


        // --- CARD 4: THIS MONTH (Transaksi Bulan Ini) ---
        $thisMonthCount = Transaction::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count();
        
        // Bandingkan dengan bulan lalu
        $lastMonthCount = Transaction::whereMonth('created_at', Carbon::now()->subMonth()->month)
                            ->whereYear('created_at', Carbon::now()->subMonth()->year)
                            ->count();
        $monthGrowth = $this->calculateGrowth($thisMonthCount, $lastMonthCount);


        return view('admin.transactions.index', compact(
            'transactions',
            'totalTransactions', 'txGrowth',
            'totalRevenue', 'revGrowth',
            'activeBuyers', 'buyersGrowth',
            'thisMonthCount', 'monthGrowth'
        ));
    }

    // Helper Function Hitung Persentase
    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }
}

