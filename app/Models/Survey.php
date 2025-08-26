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
        'kritik_saran',
    ];

    /**
     * Polymorphic relation.
     * Contoh: Survey bisa untuk Cancel, Delegation, dll.
     */
    public function target()
    {
        return $this->morphTo();
    }

    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('kritik_saran', 'like', "%{$term}%");
            });
        }
        return $query;
    }
}
