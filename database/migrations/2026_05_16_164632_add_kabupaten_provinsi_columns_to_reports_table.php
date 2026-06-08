<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Kolom untuk Kabupaten
            if (!Schema::hasColumn('reports', 'catatan_kabupaten')) {
                $table->text('catatan_kabupaten')->nullable()->after('catatan_kecamatan');
            }
            if (!Schema::hasColumn('reports', 'alasan_tolak_kabupaten')) {
                $table->text('alasan_tolak_kabupaten')->nullable()->after('alasan_tolak_kecamatan');
            }

            // Kolom untuk Provinsi
            if (!Schema::hasColumn('reports', 'catatan_provinsi')) {
                $table->text('catatan_provinsi')->nullable()->after('catatan_kabupaten');
            }
            if (!Schema::hasColumn('reports', 'alasan_tolak_provinsi')) {
                $table->text('alasan_tolak_provinsi')->nullable()->after('alasan_tolak_kabupaten');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'catatan_kabupaten',
                'alasan_tolak_kabupaten',
                'catatan_provinsi',
                'alasan_tolak_provinsi'
            ]);
        });
    }
};
