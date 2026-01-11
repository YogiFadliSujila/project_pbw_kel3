<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TicketTimeline;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\EstimationUpgraded;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        // Query Dasar: Hanya ambil transaksi sukses (Tiket Layanan)
        $query = Transaction::with(['user', 'property', 'timelines'])
                    ->where('status', 'Success')
                    ->latest();

        // 1. Logika Search (Tetap sama)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // 2. LOGIKA FILTER BARU (Update untuk "Baru dibuat")
        if ($request->filled('status') && $request->status !== 'All Status') {
            $filterTitle = $request->status;

            if ($filterTitle == 'Baru dibuat') {
                // LOGIKA KHUSUS:
                // Cari tiket yang BELUM punya data timeline sama sekali (Kosong)
                $query->doesntHave('timelines'); 
            } else {
                // LOGIKA STANDAR:
                // Cari tiket yang timeline TERAKHIRNYA sesuai judul
                $query->whereHas('latestTimeline', function($q) use ($filterTitle) {
                    $q->where('title', $filterTitle);
                });
            }
        }

        $tickets = $query->paginate(10)->appends($request->all());


        // ==========================================
        // STATISTIK (Perbaikan Logika)
        // ==========================================
        
        // --- STATISTIK (Update agar cek status terakhir juga) ---
        $totalTickets = Transaction::where('status', 'Success')->count();

        // Hitung Completed berdasarkan Status Terakhir = 'finished'
        $completedTickets = Transaction::where('status', 'Success')
            ->whereHas('latestTimeline', function($q) {
                $q->where('status_type', 'finished');
            })->count();
            
        $onProgressTickets = $totalTickets - $completedTickets;

        // 4. Average Response Time
        $solvedTickets = Transaction::where('status', 'Success')
            ->whereHas('timelines', function($q) {
                $q->where('status_type', 'finished'); // Ubah juga di sini
            })->with('timelines')->get();

        $totalHours = 0;
        $countSolved = $solvedTickets->count();

        foreach ($solvedTickets as $ticket) {
            // Cari timeline yang status_type-nya 'finished'
            $finishNode = $ticket->timelines->where('status_type', 'finished')->sortByDesc('created_at')->first();
            
            if ($finishNode) {
                $created = Carbon::parse($ticket->created_at);
                $finished = Carbon::parse($finishNode->created_at);
                $totalHours += $created->diffInHours($finished);
            }
        }

        $avgResTime = 0;
        $avgResUnit = 'Hours';

        if ($countSolved > 0) {
            $avgRaw = $totalHours / $countSolved;
            if ($avgRaw > 24) {
                $avgResTime = round($avgRaw / 24, 1);
                $avgResUnit = 'Days';
            } else {
                $avgResTime = round($avgRaw);
                $avgResUnit = 'Hours';
            }
        }

        return view('admin.tickets.index', compact(
            'tickets', 
            'totalTickets', 
            'completedTickets', 
            'onProgressTickets',
            'avgResTime',
            'avgResUnit'
        ));
    }

    // Update function (Tetap sama, pastikan input title sesuai)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string', // Ini yang jadi kunci filter
            'description' => 'nullable|string',
            'status_type' => 'required|in:progress,finished', // Tetap simpan tipe untuk styling warna
        ]);

        TicketTimeline::create([
            'transaction_id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'status_type' => $request->status_type,
        ]);

        // Jika admin menambahkan timeline yang berkaitan dengan estimasi,
        // kirim notifikasi ke user pemilik transaksi (pembeli)
        try {
            $titleLower = strtolower($request->title);
            if (str_contains($titleLower, 'estimasi') || str_contains($titleLower, 'estimasi')) {
                $transaction = Transaction::find($id);
                if ($transaction && $transaction->user) {
                    $transaction->user->notify(new EstimationUpgraded($transaction, $request->description ?? null));
                }
            }
        } catch (\Throwable $e) {
            // Jangan crash jika notifikasi gagal, hanya log (opsional)
            logger()->error('Notify EstimationUpgraded failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Timeline berhasil ditambahkan!');
    }
}