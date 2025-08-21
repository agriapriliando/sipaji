<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Delegation extends Model
{
    use HasUuids;
    protected $fillable = [
        'user_id',
        'nomor_porsi',
        'nama_asal',
        'bin_binti_asal',
        'nama_penerima',
        'bin_binti_penerima',
        'ttl_tempat',
        'ttl_tanggal',
        'pekerjaan',
        'alamat',
        'nomor_hp',
        'alasan_pelimpahan',
        'status_surveys',
        'jenis_persyaratan',
    ];

    protected $casts = [
        'ttl_tanggal'     => 'date',
        'status_cetak'    => 'boolean',
        'status_surveys'  => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('nama_penerima', 'like', "%{$term}%")
                    ->orWhere('nomor_porsi', 'like', "%{$term}%");
            });
        }
        return $query;
    }
}
