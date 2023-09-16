<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_event_id',
        'title',
        'description',
        'file',
    ];

    public function subEvent(): BelongsTo
    {
        return $this->belongsTo(SubEvent::class);
    }
}
