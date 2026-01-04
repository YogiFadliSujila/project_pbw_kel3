<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_timelines', function (Blueprint $table) {
            $table->id();
            
            // Kolom Relasi ke Transaksi
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            // Kolom Data Timeline
            $table->string('title'); // Judul status (misal: Pembayaran Selesai)
            $table->text('description')->nullable(); // Keterangan tambahan
            $table->string('status_type')->default('progress'); // progress/completed/pending
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_timelines');
    }
};