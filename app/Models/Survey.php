<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'target_type',
        'target_id',
        'layanan',
        'kepuasan',
    ];

    /**
     * Polymorphic relation.
     * Contoh: Survey bisa untuk Cancel, Delegation, dll.
     */
    public function target()
    {
        return $this->morphTo();
    }
}
