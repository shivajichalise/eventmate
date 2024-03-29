<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable =[
        'sub_event_id',
        'code',
        'currency',
        'price',
        'tax',
        'limit',
    ];

    public function subEvent(): BelongsTo
    {
        return $this->belongsTo(SubEvent::class);
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Invoice::class);
    }
}
