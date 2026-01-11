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
        Schema::create('property_deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pembeli
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Properti
            $table->decimal('agreed_price', 15, 2); // Harga Deal
            $table->string('status')->default('waiting_payment'); // waiting_payment, paid, expired
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_deals');
    }
};
