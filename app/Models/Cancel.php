<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cancel extends Model
{
    use HasUuids;
    protected $fillable = [
        'user_id',
        'nomor_porsi',
        'nama',
        'bin_binti',
        'ttl_tempat',
        'ttl_tanggal',
        'pekerjaan',
        'alamat',
        'alasan_pembatalan',
        'status_cetak',
        'status_surveys',
    ];

    protected $casts = [
        'ttl_tanggal'    => 'date',
        'status_cetak'   => 'boolean',
        'status_surveys' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
