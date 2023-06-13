<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'event_start',
        'event_end',
        'registration_start',
        'registration_end',
        'status'
    ];

    public function subEvent(): HasMany
    {
        return $this->hasMany(SubEvent::class);
    }

    public function support(): HasOne
    {
        return $this->hasOne(Support::class);
    }
}
