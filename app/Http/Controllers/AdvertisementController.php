<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionLog;
use App\Models\User;

class AdvertisementController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Tabel (Log Transaksi Iklan)
        $logs = SubscriptionLog::with('user')->latest()->paginate(10);

        // 2. Hitung Statistik untuk Kartu Atas
        
        // Total Active Ads (User yang paketnya BUKAN Basic)
        $totalActiveAds = User::where('membership_type', '!=', 'Basic')->count();

        // Ads Revenue (Total uang masuk dari tabel logs)
        $adsRevenue = SubscriptionLog::sum('price');

        // New Advertisers (User yang baru subscribe bulan ini)
        $newAdvertisers = SubscriptionLog::whereMonth('created_at', date('m'))
                            ->distinct('user_id')
                            ->count('user_id');

        // Growth (Dummy logic atau perbandingan bulan lalu)
        $lastMonthAds = SubscriptionLog::whereMonth('created_at', date('m', strtotime('-1 month')))->count();
        $thisMonthAds = SubscriptionLog::whereMonth('created_at', date('m'))->count();
        
        $growth = 0;
        if($lastMonthAds > 0) {
            $growth = (($thisMonthAds - $lastMonthAds) / $lastMonthAds) * 100;
        } else {
            $growth = 100; // Jika bulan lalu 0, pertumbuhan 100%
        }

        return view('admin.advertisement.index', compact('logs', 'totalActiveAds', 'adsRevenue', 'newAdvertisers', 'growth'));
    }
}