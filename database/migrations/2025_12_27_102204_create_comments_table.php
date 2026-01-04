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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            
            // Relasi: Siapa yang berkomentar
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Relasi: Di properti mana dia berkomentar
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            
            // Isi komentar
            $table->text('body');
            
            // Opsional: Jika nanti ingin fitur "Balas Komentar" (Reply)
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
