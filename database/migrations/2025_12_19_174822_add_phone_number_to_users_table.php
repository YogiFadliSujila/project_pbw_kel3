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
        Schema::table('users', function (Blueprint $table) {
            // Kita taruh setelah email, dan set nullable (boleh kosong)
            // agar tidak error pada data user lama yang belum punya no hp
            $table->string('phone_number')->nullable()->after('email'); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ini perintah untuk menghapus kolom jika migration di-rollback
            $table->dropColumn('phone_number');
        });
    }
};
