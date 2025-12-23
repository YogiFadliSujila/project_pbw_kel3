<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Statistik untuk Kartu Atas
        $totalTransactions = Transaction::count();
        
        // Hitung total revenue (Sum kolom price)
        $totalRevenue = Transaction::sum('price');
        
        // Hitung pembeli aktif (User unik yang pernah beli)
        $activeBuyers = Transaction::distinct('user_id')->count('user_id');
        
        // Transaksi bulan ini
        $thisMonth = Transaction::whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();

        // 2. Ambil Data List Transaksi (Paginate)
        $transactions = Transaction::with(['user', 'property'])->latest()->paginate(10);

        return view('admin.transactions.index', compact(
            'transactions', 
            'totalTransactions', 
            'totalRevenue', 
            'activeBuyers', 
            'thisMonth'
        ));
    }
}