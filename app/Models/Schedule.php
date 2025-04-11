<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Schedule extends Model
{
    protected $fillable = [
        'nomor_lapangan',
        'jam_mulai',
        'jam_selesai'
    ];

    /**
     * Get all tickets for this flight
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
