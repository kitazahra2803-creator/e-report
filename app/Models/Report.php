<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'lokasi',
        'foto',
        'status',
        'desa_id',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'is_read',
        'is_read_desa',
        'is_read_kecamatan',
        'is_read_kabupaten',
        'is_read_provinsi',
        'foto_perbaikan',
        'catatan',
        'catatan_kecamatan',
        'catatan_kabupaten',     // TAMBAHKAN
        'catatan_provinsi',      // TAMBAHKAN
        'alasan_tolak',
        'alasan_tolak_kecamatan',
        'alasan_tolak_kabupaten', // TAMBAHKAN
        'alasan_tolak_provinsi',  // TAMBAHKAN
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔥 INI YANG PENTING! Nama methodnya harus "desaRelasi"
    public function desaRelasi()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}
