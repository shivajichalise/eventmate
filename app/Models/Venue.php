<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'address',
        'country',
        'state',
        'city',
        'lat',
        'lng',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
