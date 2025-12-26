<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // <--- PENTING: Untuk generate random string
use App\Models\SubscriptionLog; // <--- PENTING: Import Model ini agar tidak error

class MembershipController extends Controller
{
    // 1. Tampilkan Halaman Pembayaran (Khusus Silver/Gold)
    public function payment(Request $request)
    {
        $package = $request->query('package'); // Ambil dari URL ?package=Gold

        // Validasi paket
        if (!in_array($package, ['Silver', 'Gold'])) {
            return redirect()->route('pricing.index');
        }

        // Setup Data Paket untuk Tampilan
        $data = match($package) {
            'Silver' => [
                'name' => 'Silver Package',
                'price' => 679000,
                'duration' => '3 Bulan',
                'color' => 'bg-gray-500', 
                'benefits' => 'Prioritas pencarian, 5 Slot Iklan'
            ],
            'Gold' => [
                'name' => 'Gold Package',
                'price' => 779000,
                'duration' => '6 Bulan',
                'color' => 'bg-yellow-500',
                'benefits' => 'Prioritas Utama, Unlimited Slot, Homepage Feature'
            ],
        };

        return view('membership.payment', compact('package', 'data'));
    }

    // 2. Proses Aktivasi Paket (Dipanggil setelah tombol Bayar diklik)
    public function process(Request $request)
    {
        $user = Auth::user();
        $package = $request->package; // Basic, Silver, Gold

        // Logika Durasi Paket
        $daysToAdd = match($package) {
            'Silver' => 90,  // 3 Bulan
            'Gold'   => 180, // 6 Bulan
            default  => 0    // Basic (Selamanya / Reset)
        };

        // Update User
        $user->update([
            'membership_type' => $package,
            'membership_expires_at' => $daysToAdd > 0 ? Carbon::now()->addDays($daysToAdd) : null,
            'priority_level' => match($package) { 'Gold' => 1, 'Silver' => 2, default => 3 }
        ]);

        // SIMPAN LOG TRANSAKSI IKLAN (Kecuali Basic)
        // Ini untuk data di halaman Admin Advertisement
        if ($package != 'Basic') {
            $price = match($package) { 'Silver' => 679000, 'Gold' => 779000, default => 0 };
            
            SubscriptionLog::create([
                'user_id' => $user->id,
                'transaction_code' => 'ADS-' . strtoupper(Str::random(6)),
                'package_name' => $package,
                'price' => $price,
                'duration_days' => $daysToAdd,
                'status' => 'Success',
                'start_date' => now(),
                'end_date' => now()->addDays($daysToAdd),
            ]);
        }

        // Untuk Basic, langsung redirect dashboard
        if ($package == 'Basic') {
             return redirect()->route('dashboard')->with('success', "Paket Basic berhasil diaktifkan.");
        }

        // Untuk Silver/Gold, redirect kembali ke halaman payment dengan sinyal SUKSES
        return redirect()->back()->with([
            'success_transaction' => true,
            'package_name' => $package,
            'trx_time' => now()->format('d-m-Y, H:i:s'),
            'trx_ref' => 'INV-' . strtoupper(uniqid())
        ]);
    }
}