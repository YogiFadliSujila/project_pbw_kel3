<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
<<<<<<< HEAD
=======
use App\Models\Review;
>>>>>>> origin/memperbaiki-landing
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TicketTimeline;
use Illuminate\Support\Facades\Schema;

class LandingController extends Controller
{
    public function index()
    {
        $properties = \App\Models\Property::with('user')
                ->where('status', 'Accepted') // Hanya yang aktif
                ->orderBy('priority_level', 'asc') // [PENTING] Urutkan Level 1 -> 2 -> 3
                ->latest() // [PENTING] Jika level sama, yang baru upload tampil duluan
                ->take(8)
                ->get();
        
        // 2. Data Khusus Section "Featured Gold" (Ambil 4 Terbaru)
        $featuredProperties = \App\Models\Property::with('user')
                    ->where('priority_level', 1) // 1 = Gold
                    ->where('status', 'Accepted')
                    ->latest()
                    ->take(4)
                    ->get();

        // 3. Data Khusus Pop-up Promo (Ambil 1 secara Acak)
        $popupProperty = \App\Models\Property::with('user')
                    ->where('priority_level', 1) // 1 = Gold
                    ->where('status', 'Accepted')
                    ->inRandomOrder() // Acak agar semua Gold dapat giliran
                    ->first();

        $notifications = collect();
        if (auth()->check() && Schema::hasTable('notifications')) {
            try {
                $notifications = auth()->user()->unreadNotifications()->take(10)->get();
            } catch (\Exception $e) {
                // Jika terjadi error pada query notifikasi (mis. struktur DB tidak sesuai), jangan hentikan halaman
                $notifications = collect();
            }
        }

<<<<<<< HEAD
        return view('landing', compact('properties', 'featuredProperties', 'popupProperty', 'notifications'));
=======
        $reviews = [];
        try {
            $reviews = Review::latest()->take(6)->get();
        } catch (\Exception $e) {
            $reviews = collect();
        }

        return view('landing', compact('properties', 'featuredProperties', 'popupProperty', 'notifications', 'reviews'));
>>>>>>> origin/memperbaiki-landing
    }

    // Tambahkan ini di bawah method index()
    public function listing()
    {
        // Ambil semua properti berstatus 'accepted' untuk halaman listing
        $properties = Property::latest()
            ->where('status', 'accepted')
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
        $property = Property::with(['gallery', 'user', 'comments.user'])->findOrFail($id);

        return view('detail', compact('property'));
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

        // [PENTING] Validasi Tambahan: Cek apakah properti SUDAH terjual sebelumnya?
        if ($property->status === 'Sold') {
            return redirect()->back()->withErrors(['msg' => 'Maaf, properti ini baru saja terjual!']);
        }

        // Simpan ke Database
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'property_id' => $property->id,
            // Generate kode unik acak, misal: TM-8475
            'transaction_code' => 'TM-' . strtoupper(Str::random(6)), 
            'price' => $property->price,
            'status' => 'Success', // Anggap langsung sukses
            'payment_method' => 'Bank Transfer'
        ]);

        // [TAMBAHAN BARU] Buat Timeline Pertama
        TicketTimeline::create([
            'transaction_id' => $transaction->id,
            'title' => 'Pembayaran Selesai',
            'description' => 'Pembayaran telah diverifikasi oleh sistem.',
            'status_type' => 'completed'
        ]);
        // Tambahkan dummy timeline (PROSES CONTOH) agar tampilan tidak sepi saat demo

        TicketTimeline::create([
            'transaction_id' => $transaction->id,
            'title' => 'Tiket Dibuat',
            'description' => 'Menunggu konfirmasi admin untuk proses selanjutnya.',
            'status_type' => 'progress',
            'created_at' => now()->addMinutes(5) // Simulasi waktu beda
        ]);


        // 3. [LOGIKA BARU] Update Status Properti Jadi "Sold"
        $property->update([
            'status' => 'Sold'
        ]);

        // Redirect kembali dengan membawa pesan sukses (untuk trigger modal)
        return redirect()->back()->with([
            'success_transaction' => true,
            'real_trx_code' => $transaction->transaction_code, // Kirim Kode TM-...
            'real_trx_time' => $transaction->created_at->format('d-m-Y, H:i:s') // Kirim Waktu Asli
        ]);
    }

    // Tambahkan method ini
    public function profil()
    {
        $user = auth()->user();

        // Siapkan variabel agar tidak error di view
        $transactions = [];
        $myProperties = [];

        // Logika Berdasarkan Role
        // Asumsi: Kita cek apakah dia punya properti yang dijual
        // Atau Anda bisa pakai kolom 'role' jika ada ($user->role == 'penjual')
        
        // Kita ambil dua-duanya untuk fleksibilitas (atau gunakan if/else role)
        
        // 1. Data untuk Pencari (Riwayat Beli)
        $transactions = \App\Models\Transaction::with('property')
                        ->where('user_id', $user->id)
                        ->latest()
                        ->get();

        // 2. Data untuk Penjual (Properti Saya)
        // Pastikan di tabel properties ada kolom 'user_id' untuk tahu siapa pemiliknya
        // Jika belum ada relasi user->properties, tambahkan dulu.
        // Asumsi: Di Model User sudah ada relasi public function properties() { return $this->hasMany(Property::class); }
        
        // Jika belum ada relasi di Model User, kita pakai query manual:
        // $myProperties = \App\Models\Property::where('user_id', $user->id)->latest()->get();
        
        // Jika sudah ada relasi:
        if ($user->role == 'penjual' || $user->properties()->exists()) {
             $myProperties = \App\Models\Property::where('user_id', $user->id)->latest()->get();
        }

        return view('profil', compact('user', 'transactions', 'myProperties'));
    }

    public function trackTicket($transactionCode)
    {
        // Cari transaksi berdasarkan kode (misal: TM-A1B2C3)
        $transaction = \App\Models\Transaction::with(['timelines', 'property'])
                        ->where('transaction_code', $transactionCode)
                        ->firstOrFail();

        return view('ticket-status', compact('transaction'));
    }
    
    // AJAX: tandai semua notifikasi yang belum dibaca sebagai dibaca
    public function markNotificationsRead(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false], 403);
        }

        // Jika tabel notifications tidak ada, abaikan (hindari error saat pertama kali deploy)
        if (!Schema::hasTable('notifications')) {
            return response()->json(['success' => true]);
        }

        $user = auth()->user();
        try {
            $user->unreadNotifications->markAsRead();
        } catch (\Exception $e) {
            // silent fail
        }

        return response()->json(['success' => true]);
    }
    
    // Tambahkan method ini
    public function pricing()
    {
        return view('pricing');
    }
}