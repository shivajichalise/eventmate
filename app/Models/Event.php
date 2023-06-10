<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
