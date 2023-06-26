<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'event_start',
        'event_end',
    ];

    protected $casts = [
        'event_start' => 'datetime',
        'event_end' => 'datetime'
    ];

    protected $appends = [
        'formatted_event_date',
    ];

    public function getFormattedEventDateAttribute()
    {
        $startMonth = $this->event_start->format('F');
        $endMonth = $this->event_end->format('F');
        $startDay = $this->event_start->format('j');
        $endDay = $this->event_end->format('j');
        $startYear = $this->event_start->format('Y');
        $endYear = $this->event_end->format('Y');

        if ($startMonth === $endMonth && $startYear === $endYear) {
            // If the month and year are the same
            if ($startDay === $endDay) {
                return $this->event_start->format('F d, Y');
            } else {
                return "{$startMonth} {$startDay}-{$endDay}, {$startYear}";
            }
        } elseif ($startYear === $endYear) {
            // If only the year is the same
            return "{$startMonth} {$startDay} - {$endMonth} {$endDay}, {$startYear}";
        } else {
            // If nothing is the same
            return "{$startMonth} {$startDay}, {$startYear} - {$endMonth} {$endDay}, {$endYear}";
        }
    }

    public function getEventStartDate()
    {
        return $this->event_start->format('F j, Y');
    }

    public function getEventEndDate()
    {
        return $this->event_end->format('F j, Y');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
}
