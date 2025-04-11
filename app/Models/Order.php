<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Order extends Model
{
    protected $fillable = [
        'nama_pemesan',
        'wa_pemesan',
        'tanggal',
        'schedule_id'
    ];

    /**
     * Get the flight that owns the ticket
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
