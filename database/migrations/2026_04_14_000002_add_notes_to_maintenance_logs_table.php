<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('maintenance_logs', 'notes')) {
            Schema::table('maintenance_logs', function (Blueprint $table) {
                $table->text('notes')->nullable()->after('amount');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('maintenance_logs', 'notes')) {
            Schema::table('maintenance_logs', function (Blueprint $table) {
                $table->dropColumn('notes');
            });
        }
    }
};
