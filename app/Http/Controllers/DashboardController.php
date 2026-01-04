<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. DATA KARTU STATISTIK
        
        // Total User & Growth (Bulan ini vs Bulan Lalu)
        $totalUsers = User::count();
        $usersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count();
        $usersLastMonth = User::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $userGrowth = $this->calculateGrowth($usersThisMonth, $usersLastMonth);

        // Total Properties & Growth
        $totalProperties = Property::count();
        $propsThisMonth = Property::whereMonth('created_at', Carbon::now()->month)->count();
        $propsLastMonth = Property::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $propGrowth = $this->calculateGrowth($propsThisMonth, $propsLastMonth);

        // Total Sales (Transaksi Sukses)
        $totalSales = Transaction::where('status', 'Success')->count();
        $salesThisMonth = Transaction::where('status', 'Success')->whereMonth('created_at', Carbon::now()->month)->count();
        $salesLastMonth = Transaction::where('status', 'Success')->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $salesGrowth = $this->calculateGrowth($salesThisMonth, $salesLastMonth);

        // Total Pending (Properti Menunggu Review Admin)
        $totalPending = Property::where('status', 'Pending')->count();
        // Atau jika ingin pending transaksi: Transaction::where('status', 'Pending')->count();
        
        
        // 2. DATA GRAFIK (TRANSAKSI PER BULAN TAHUN INI)
        $transactionsData = Transaction::select(
                DB::raw('MONTH(created_at) as month'), 
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Normalisasi Data (Isi bulan yang kosong dengan 0)
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $transactionsData[$i] ?? 0;
        }

        return view('dashboard', compact(
            'totalUsers', 'userGrowth',
            'totalProperties', 'propGrowth',
            'totalSales', 'salesGrowth',
            'totalPending',
            'chartData' // Array [0, 5, 10, ...] untuk grafik
        ));
    }

    // Helper sederhana hitung persentase
    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }
}