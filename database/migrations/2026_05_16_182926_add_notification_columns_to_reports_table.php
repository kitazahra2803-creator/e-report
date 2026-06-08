<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            if (!Schema::hasColumn('reports', 'is_read_kecamatan')) {
                $table->boolean('is_read_kecamatan')->default(false)->after('is_read_desa');
            }
            if (!Schema::hasColumn('reports', 'is_read_kabupaten')) {
                $table->boolean('is_read_kabupaten')->default(false)->after('is_read_kecamatan');
            }
            if (!Schema::hasColumn('reports', 'is_read_provinsi')) {
                $table->boolean('is_read_provinsi')->default(false)->after('is_read_kabupaten');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['is_read_kecamatan', 'is_read_kabupaten', 'is_read_provinsi']);
        });
    }
};
