<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id', 
        'judul',
        'deskripsi', 
        'lokasi', 
        'gambar', 
        'status'
        ];
}