<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TicketTimeline;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        // Ambil transaksi yang statusnya Success (artinya sudah jadi tiket layanan)
        $tickets = Transaction::with(['user', 'property', 'timelines'])
                    ->where('status', 'Success')
                    ->latest()
                    ->paginate(10);

        // Statistik Sederhana
        $totalTickets = Transaction::where('status', 'Success')->count();
        $completedTickets = Transaction::whereHas('timelines', function($q) {
            $q->where('status_type', 'finished');
        })->count();
        $onProgressTickets = $totalTickets - $completedTickets;

        // Ambil semua tiket yang SUDAH selesai beserta timelinenya
        $solvedTickets = Transaction::whereHas('timelines', function($q) {
            $q->where('status_type', 'finished');
        })->with('timelines')->get();

        $totalHours = 0;
        $countSolved = $solvedTickets->count();

        foreach ($solvedTickets as $ticket) {
            // Cari timeline yang statusnya 'finished'
            $finishNode = $ticket->timelines->where('status_type', 'finished')->first();
            
            if ($finishNode) {
                // Hitung selisih waktu (Jam) antara Transaksi Dibuat vs Status Finished
                // created_at di Laravel otomatis adalah instance Carbon
                $hours = $ticket->created_at->diffInHours($finishNode->created_at);
                $totalHours += $hours;
            }
        }

        // Hitung Rata-rata
        $avgResTime = 0;
        $avgResUnit = 'Hours';

        if ($countSolved > 0) {
            $avgRaw = $totalHours / $countSolved;
            
            // Jika lebih dari 24 jam, ubah ke Hari
            if ($avgRaw > 24) {
                $avgResTime = round($avgRaw / 24, 1); // 1 koma desimal, misal 2.5
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
            'avgResTime', // Kirim data baru
            'avgResUnit'  // Kirim satuan (Days/Hours)
        ));
    }

    // Fungsi untuk menambah Timeline Baru (Update Status)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status_type' => 'required|in:progress,finished',
        ]);

        TicketTimeline::create([
            'transaction_id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'status_type' => $request->status_type,
        ]);

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui!');
    }
}