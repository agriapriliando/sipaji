<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoOption extends Model
{
    protected $table = 'info_options';

    // Biar gampang validasi & pakai ulang
    public const TYPES = ['informasi', 'gambar', 'slide'];

    protected $fillable = [
        'judul_informasi',
        'isi_informasi',
        'tipe_informasi',
        'gambar',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /** Scopes ringkas */
    public function scopeInformasi($q)
    {
        return $q->where('tipe_informasi', 'informasi');
    }
    public function scopeGambar($q)
    {
        return $q->where('tipe_informasi', 'gambar');
    }
    public function scopeSlide($q)
    {
        return $q->where('tipe_informasi', 'slide');
    }
}
