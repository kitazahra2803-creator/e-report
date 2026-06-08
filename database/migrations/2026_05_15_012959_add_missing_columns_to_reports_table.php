<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Tambah kolom yang BELUM ADA (cek dulu sebelum tambah)

            if (!Schema::hasColumn('reports', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('desa_id');
            }

            if (!Schema::hasColumn('reports', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('kecamatan');
            }

            if (!Schema::hasColumn('reports', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('kabupaten');
            }

            if (!Schema::hasColumn('reports', 'kewenangan')) {
                $table->string('kewenangan')->nullable()->after('lokasi');
            }

            if (!Schema::hasColumn('reports', 'dana_level')) {
                $table->string('dana_level')->nullable()->after('kewenangan');
            }

            if (!Schema::hasColumn('reports', 'catatan')) {
                $table->text('catatan')->nullable()->after('dana_level');
            }

            if (!Schema::hasColumn('reports', 'catatan_kecamatan')) {
                $table->text('catatan_kecamatan')->nullable()->after('catatan');
            }

            if (!Schema::hasColumn('reports', 'alasan_tolak')) {
                $table->text('alasan_tolak')->nullable()->after('catatan_kecamatan');
            }

            if (!Schema::hasColumn('reports', 'alasan_tolak_kecamatan')) {
                $table->text('alasan_tolak_kecamatan')->nullable()->after('alasan_tolak');
            }

            if (!Schema::hasColumn('reports', 'foto_perbaikan')) {
                $table->string('foto_perbaikan')->nullable()->after('foto');
            }

            // Update status enum (tambah 'ditolak')
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu')->change();
        });

        // Tambah foreign key desa_id (kalau belum ada)
        try {
            Schema::table('reports', function (Blueprint $table) {
                $table->foreign('desa_id')->references('id')->on('desas')->onDelete('set null');
            });
        } catch (\Exception $e) {
            // Foreign key mungkin sudah ada
        }
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['desa_id']);
            $table->dropColumn([
                'kecamatan', 'kabupaten', 'provinsi', 'kewenangan',
                'dana_level', 'catatan', 'catatan_kecamatan',
                'alasan_tolak', 'alasan_tolak_kecamatan', 'foto_perbaikan'
            ]);
            $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu')->change();
        });
    }
};
