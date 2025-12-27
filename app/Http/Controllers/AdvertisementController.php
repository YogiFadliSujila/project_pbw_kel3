<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionLog;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Property;
use GrahamCampbell\ResultType\Success;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        // Start Query
        $query = SubscriptionLog::with('user')->latest();

        // 1. Logika Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Cari berdasarkan ID Transaksi
                $q->where('id', 'like', "%{$search}%")
                  // JIKA ADA kolom 'transaction_code' atau 'invoice_number', tambahkan ini:
                  ->orWhere('property_id', 'like', "%{$search}%") 
                  
                  // Cari berdasarkan User (Nama atau Email)
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->Where('email', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");

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
        $logs = $query->paginate(10)->appends($request->all());
        // 1. DATA TABEL (Log Transaksi Iklan)

        // ==========================================
        // 2. HITUNG STATISTIK KARTU (REAL DATA)
        // ==========================================

        // --- CARD 1: TOTAL ACTIVE ADS (User Premium) ---
        $totalActiveAds = User::where('membership_type', '!=', 'Basic')->count();
        
        // Hitung growth berdasarkan user yang upgrade bulan ini vs bulan lalu
        $upgradesThisMonth = SubscriptionLog::whereMonth('created_at', Carbon::now()->month)->count();
        $upgradesLastMonth = SubscriptionLog::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $activeAdsGrowth = $this->calculateGrowth($upgradesThisMonth, $upgradesLastMonth);


        // --- CARD 2: ADS GROWTH (Pertumbuhan Transaksi Iklan Bulanan) ---
        // Kita gunakan % kenaikan transaksi bulan ini sebagai angka utama
        $adsGrowthPercentage = $activeAdsGrowth; 


        // --- CARD 3: ADS REVENUE (Total Pendapatan) ---
        $adsRevenue = SubscriptionLog::sum('price');
        
        $revenueThisMonth = SubscriptionLog::whereMonth('created_at', Carbon::now()->month)->sum('price');
        $revenueLastMonth = SubscriptionLog::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('price');
        $revenueGrowth = $this->calculateGrowth($revenueThisMonth, $revenueLastMonth);


        // --- CARD 4: NEW ADVERTISERS (Pengiklan Baru Bulan Ini) ---
        // Menghitung user unik yang baru pertama kali transaksi bulan ini
        $newAdvertisers = SubscriptionLog::whereMonth('created_at', Carbon::now()->month)
                            ->distinct('user_id')
                            ->count('user_id');
        
        $newAdvLastMonth = SubscriptionLog::whereMonth('created_at', Carbon::now()->subMonth()->month)
                            ->distinct('user_id')
                            ->count('user_id');
                            
        $newAdvertisersGrowth = $this->calculateGrowth($newAdvertisers, $newAdvLastMonth);


        // Kirim SEMUA variabel ini ke View
        return view('admin.advertisement.index', compact(
            'logs', 
            'totalActiveAds', 'activeAdsGrowth',
            'adsGrowthPercentage',
            'adsRevenue', 'revenueGrowth',
            'newAdvertisers', 'newAdvertisersGrowth'
        ));
    }

    // Helper Function untuk Hitung Persentase
    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0; // Jika bulan lalu 0, naik 100% (atau 0 jika sama2 0)
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }
}