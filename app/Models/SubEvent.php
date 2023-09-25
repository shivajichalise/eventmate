<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Get the number of remaining days until the event starts.
     *
     * @return int
     */
    public function getRemainingDaysUntilEventStart(): int
    {
        // Check if the event_start date is set and in the future
        if (!$this->event_start || $this->event_start->isPast()) {
            return -1; // Return null if event_start is not set or in the past
        }

        // Calculate the remaining days
        $eventStartDate = $this->event_start;
        $remainingDays = Carbon::now()->diffInDays($eventStartDate);

        return max(0, $remainingDays); // Ensure a non-negative result
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }

    public function attendees()
    {
        return User::whereHas('payments', function (Builder $query) {
            $query->whereIn('invoice_id', function ($subQuery) {
                $subQuery->select('id')
                ->from('invoices')
                ->whereIn('ticket_id', function ($ticketSubQuery) {
                    $ticketSubQuery->select('id')
                    ->from('tickets')
                    ->whereIn('sub_event_id', function ($subEventSubQuery) {
                        $subEventSubQuery->select('id')
                        ->from('sub_events')
                        ->where('sub_event_id', $this->id); // Use $this->id to reference the event's ID
                    });
                });
            });
        });
    }
}
