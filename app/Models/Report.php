<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'desa',
        'deskripsi',
        'lokasi',
        'foto',
        'status',
        'kewenangan',
        'dana_level',
        'catatan',
        'catatan_kecamatan',
        'alasan_tolak',
        'alasan_tolak_kecamatan',
        'foto_perbaikan',
        'desa_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function desaRelasi()
    {
    return $this->belongsTo(Desa::class, 'desa_id');
    }
}