<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menyimpan tipe paket: 'Basic', 'Silver', 'Gold'
            $table->string('membership_type')->default('Basic')->after('password');
            
            // Menyimpan kapan paket berakhir (Null untuk Basic karena selamanya gratis)
            $table->dateTime('membership_expires_at')->nullable()->after('membership_type');
            
            // Menyimpan jumlah kuota upload yang tersisa (Opsional, tapi mempermudah pengecekan)
            // Atau kita bisa hitung real-time nanti. Mari kita simpan level prioritas user.
            $table->integer('priority_level')->default(3)->after('membership_type'); 
            // 1=Gold, 2=Silver, 3=Basic
        });

        Schema::table('properties', function (Blueprint $table) {
            // Tanggal otomatis hapus/nonaktif (Khusus Basic: 2 bulan)
            $table->dateTime('auto_expire_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['membership_type', 'membership_expires_at', 'priority_level']);
        });
        
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('auto_expire_at');
        });
    }
};