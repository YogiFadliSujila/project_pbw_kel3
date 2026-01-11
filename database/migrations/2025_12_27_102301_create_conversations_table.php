<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            
            // Pengirim Pertama (Pembeli/Penyewa)
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            
            // Penerima (Penjual/Pemilik Lahan)
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            
            // Opsional: Chat ini membahas properti apa? (Biar ada konteks di header chat)
            $table->foreignId('property_id')->nullable()->constrained()->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
