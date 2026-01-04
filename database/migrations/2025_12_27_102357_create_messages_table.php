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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Room Chat
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            
            // Siapa pengirim pesan ini? (Bisa sender_id atau receiver_id dari tabel conversations)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Isi Pesan
            $table->text('body');
            
            // Status apakah sudah dibaca lawan bicara
            $table->boolean('is_read')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
