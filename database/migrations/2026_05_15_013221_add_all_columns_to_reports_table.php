<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Cek apakah kolom sudah ada, kalau belum tambahin
            if (!Schema::hasColumn('reports', 'desa')) {
                $table->string('desa')->nullable()->after('judul');
            }

            if (!Schema::hasColumn('reports', 'desa_id')) {
                $table->foreignId('desa_id')->nullable()->after('desa');
            }

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

            // Update kolom status (tambah 'ditolak')
            if (Schema::hasColumn('reports', 'status')) {
                $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu')->change();
            }

            // Rename gambar jadi foto (kalau ada kolom gambar)
            if (Schema::hasColumn('reports', 'gambar') && !Schema::hasColumn('reports', 'foto')) {
                $table->renameColumn('gambar', 'foto');
            }
        });

        // Tambah foreign key
        Schema::table('reports', function (Blueprint $table) {
            if (Schema::hasColumn('reports', 'desa_id')) {
                $table->foreign('desa_id')->references('id')->on('desas')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['desa_id']);
            $table->dropColumn([
                'desa', 'desa_id', 'kecamatan', 'kabupaten', 'provinsi',
                'kewenangan', 'dana_level', 'catatan', 'catatan_kecamatan',
                'alasan_tolak', 'alasan_tolak_kecamatan', 'foto_perbaikan'
            ]);
        });
    }
};
