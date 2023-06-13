<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    use HasFactory;

    protected $fillable =[
        'event_id',
        'name',
        'event_start',
        'event_end',
    ];
}
