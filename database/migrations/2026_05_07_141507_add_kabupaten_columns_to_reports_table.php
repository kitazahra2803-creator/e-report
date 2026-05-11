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
        Schema::table('reports', function (Blueprint $table) {
            $table->text('catatan_kabupaten')->nullable();
            $table->text('alasan_tolak_kabupaten')->nullable();
            $table->string('foto_perbaikan_kabupaten')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['catatan_kabupaten', 'alasan_tolak_kabupaten', 'foto_perbaikan_kabupaten']);
        });
    }
};
