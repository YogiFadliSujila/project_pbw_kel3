<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // PENTING: Untuk generate kode acak
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyDeal;
use App\Models\Transaction;
use App\Models\TicketTimeline; // PENTING: Pastikan model ini ada

class PaymentController extends Controller
{
    public function show(Request $request)
    {
        // ... (Kode show() biarkan sama seperti sebelumnya) ...
        // SKENARIO 1: Pembayaran dari Hasil Tawar-Menawar
        if ($request->has('deal_id')) {
            $deal = PropertyDeal::with('property')->findOrFail($request->deal_id);
            if ($deal->user_id != Auth::id()) abort(403);
            if ($deal->status == 'paid') return redirect()->route('chat.index')->with('error', 'Tagihan ini sudah dibayar.');

            $property = $deal->property; 
            $priceToPay = $deal->agreed_price;
            $dealId = $deal->id;
        } 
        // SKENARIO 2: Pembayaran Langsung
        elseif ($request->has('property_id')) {
            $property = Property::findOrFail($request->property_id);
            if ($property->user_id == Auth::id()) return back()->with('error', 'Anda tidak bisa membeli properti sendiri.');
            
            $priceToPay = $property->price;
            $dealId = null;
        } else {
            return redirect()->route('landing');
        }

        return view('payment.checkout', compact('property', 'priceToPay', 'dealId'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
            'amount' => 'required'
        ]);

        $property = Property::findOrFail($request->property_id);

        // 1. Cek apakah properti sudah terjual (Double Spending Check)
        if ($property->status === 'Sold') {
            return redirect()->route('landing')->with('error', 'Maaf, properti ini baru saja terjual!');
        }

        // 2. Update Status Deal (Jika berasal dari Chat)
        if ($request->deal_id) {
            $deal = PropertyDeal::find($request->deal_id);
            if ($deal) $deal->update(['status' => 'paid']);
        }

        // 3. Generate Kode Transaksi
        $trxCode = 'TM-' . strtoupper(Str::random(6));

        // 4. Simpan ke Tabel Transaksi Utama (Fix Error 1364)
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'property_id' => $request->property_id,
            'transaction_code' => $trxCode, // <--- INI SOLUSINYA
            'price' => $request->amount,    // Simpan nominal yang dibayar
            'status' => 'Success',          // Anggap sukses
            'payment_method' => 'Bank Transfer'
        ]);

        // 5. Update Status Properti
        $property->update(['status' => 'Sold']);

        // 6. Buat Timeline (Agar fitur tracking Anda jalan)
        TicketTimeline::create([
            'transaction_id' => $transaction->id,
            'title' => 'Pembayaran Selesai',
            'description' => 'Pembayaran sebesar Rp ' . number_format($request->amount) . ' telah diverifikasi.',
            'status_type' => 'completed'
        ]);
        
        // Dummy Progress (Opsional, sesuai kode lama Anda)
        TicketTimeline::create([
            'transaction_id' => $transaction->id,
            'title' => 'Menyiapkan Berkas',
            'description' => 'Admin sedang menyiapkan dokumen kepemilikan.',
            'status_type' => 'progress',
            'created_at' => now()->addMinutes(2)
        ]);

        // 7. Redirect Kembali (PENTING: Gunakan with() agar Modal Sukses muncul)
        // Kita tidak redirect ke 'landing', tapi 'back()' agar modal checkout terganti modal sukses
        return redirect()->back()->with([
            'success_transaction' => true,
            'real_trx_code' => $trxCode,
            'real_trx_time' => now()->format('d-m-Y, H:i:s')
        ]);
    }
}