<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'membership_type')) {
                $table->string('membership_type')->default('Basic')->after('password');
            }
            if (!Schema::hasColumn('users', 'membership_expires_at')) {
                $table->dateTime('membership_expires_at')->nullable()->after('membership_type');
            }
            if (!Schema::hasColumn('users', 'priority_level')) {
                $table->integer('priority_level')->default(3)->after('membership_type');
            }
        });
    }

    public function down(): void
    {
        // Kosongkan saja agar aman saat rollback
    }
};