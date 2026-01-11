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
        Schema::table('messages', function (Blueprint $table) {
            $table->string('type')->default('text'); // 'text' atau 'offer'
            $table->decimal('offer_price', 15, 2)->nullable(); // Nominal tawaran
            $table->string('offer_status')->nullable(); // 'pending', 'accepted', 'rejected'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            //
        });
    }
};
