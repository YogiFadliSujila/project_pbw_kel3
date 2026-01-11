<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use Carbon\Carbon;

class ExpireProperties extends Command
{
    /**
     * Nama perintah yang akan dipanggil oleh Scheduler atau Terminal.
     */
    protected $signature = 'properties:expire';

    /**
     * Deskripsi perintah.
     */
    protected $description = 'Mengecek dan menonaktifkan properti (Basic) yang sudah melewati batas waktu tayang.';

    /**
     * Eksekusi logika.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Cari properti yang:
        // 1. Punya tanggal expired (tidak null)
        // 2. Tanggal expired-nya sudah LEWAT dari sekarang
        // 3. Statusnya masih 'Available' (belum terjual/belum expired)
        
        $expiredProperties = Property::whereNotNull('auto_expire_at')
                            ->where('auto_expire_at', '<', $now)
                            ->whereNotIn('status', ['Sold', 'Expired']) // Jangan ubah yang sudah terjual
                            ->get();

        $count = $expiredProperties->count();

        if ($count > 0) {
            foreach ($expiredProperties as $prop) {
                $prop->update(['status' => 'Expired']);
                $this->info("Properti ID {$prop->id} ({$prop->title}) telah di-expired-kan.");
            }
            $this->info("Berhasil: {$count} properti telah dinonaktifkan.");
        } else {
            $this->info('Tidak ada properti yang perlu di-expired-kan hari ini.');
        }
    }
}