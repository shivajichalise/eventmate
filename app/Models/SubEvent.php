<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubEvent extends Model
{
    use HasFactory;

    protected $fillable =[
        'event_id',
        'name',
        'event_start',
        'event_end',
    ];

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
}
