<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = [
        'name',
        'description',
        'event_start',
        'event_end',
        'registration_start',
        'registration_end',
        'status'
    ];

    protected $dates = [
        'event_start',
        'event_end',
        'registration_start',
        'registration_end',
    ];

    protected static function booted(): void
    {
        // To have serial sn
        static::retrieved(function ($event) {
            $event->subEvents->each(function ($subEvent, $index) {
                $subEvent->sn = $index + 1;
            });
        });

        static::retrieved(function ($event) {
            $event->tickets->each(function ($ticket, $index) {
                $ticket->sn = $index + 1;
            });
        });
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

    public function subEvents(): HasMany
    {
        return $this->hasMany(SubEvent::class);
    }

    public function support(): HasOne
    {
        return $this->hasOne(Support::class);
    }

    public function tickets(): HasManyThrough
    {
        return $this->hasManyThrough(Ticket::class, SubEvent::class);
    }

    public function venue(): HasOne
    {
        return $this->hasOne(Venue::class);
    }

    public function scopeOngoing(): Builder
    {
        $currentDate = Carbon::now();

        return $this->whereDate('event_start', '<=', $currentDate)
            ->whereDate('event_end', '>=', $currentDate);
    }

    public function scopeUpcoming(): Builder
    {
        $currentDate = Carbon::now();

        return $this->whereDate('event_start', '>', $currentDate);
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
                        ->where('event_id', $this->id); // Use $this->id to reference the event's ID
                    });
                });
            });
        });
    }
}
