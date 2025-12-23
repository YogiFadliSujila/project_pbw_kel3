<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil properti terbaru berstatus 'available' untuk ditampilkan di landing
        // Batasi jumlah menjadi 2 sample agar tidak memuat terlalu banyak data
        $properties = Property::latest()
            ->where('status', 'available')
            ->take(2)
            ->get();

        return view('landing', compact('properties'));
    }

    // Tambahkan ini di bawah method index()
    public function listing()
    {
        // Ambil semua properti berstatus 'available' untuk halaman listing
        $properties = Property::latest()
            ->where('status', 'available')
            ->get();

        return view('listing', compact('properties'));
    }

    // Tambahkan di bawah method listing()
    public function show($id)
    {
        // Cari properti berdasarkan ID, jika tidak ketemu tampilkan 404
        $property = Property::findOrFail($id);

        // Kirim data ke view detail
        return view('detail', compact('property'));
    }

    // Tambahkan di bawah method show()
    public function payment($id)
    {
        // Ambil data properti berdasarkan ID
        $property = Property::findOrFail($id);

        // Tampilkan halaman payment dengan data tersebut
        return view('payment', compact('property'));
    }
    
    public function processPayment(Request $request)
    {
        // Validasi input
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'card_holder_name' => 'required|string',
            // Validasi lain bisa ditambahkan
        ]);

        $property = Property::findOrFail($request->property_id);

        // Simpan ke Database
        $transaction = Transaction::create([
            'user_id' => auth()->id,
            'property_id' => $property->id,
            // Generate kode unik acak, misal: TM-8475
            'transaction_code' => 'TM-' . strtoupper(Str::random(6)), 
            'price' => $property->price,
            'status' => 'Success', // Anggap langsung sukses
            'payment_method' => 'Bank Transfer'
        ]);

        // Redirect kembali dengan membawa pesan sukses (untuk trigger modal)
        return redirect()->back()->with([
        'success_transaction' => true,
        'real_trx_code' => $transaction->transaction_code, // Kirim Kode TM-...
        'real_trx_time' => $transaction->created_at->format('d-m-Y, H:i:s') // Kirim Waktu Asli
    ]);
    }
}