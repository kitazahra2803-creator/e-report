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
                        $table->text('catatan_provinsi')->nullable()->after('catatan_kabupaten');
            
            // Alasan penolakan dari provinsi
            $table->text('alasan_tolak_provinsi')->nullable()->after('alasan_tolak_kabupaten');
            
            // Foto perbaikan dari provinsi (opsional)
            $table->string('foto_perbaikan_provinsi')->nullable()->after('foto_perbaikan_kabupaten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'catatan_provinsi',
                'alasan_tolak_provinsi',
                'foto_perbaikan_provinsi'
            ]);
        });
    }
};
