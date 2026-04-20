<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            if (!Schema::hasColumn('reports', 'dana_level')) {
                $table->string('dana_level')->nullable()->after('status');
            }
            if (!Schema::hasColumn('reports', 'catatan')) {
                $table->text('catatan')->nullable()->after('dana_level');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['dana_level', 'catatan']);
        });
    }
};