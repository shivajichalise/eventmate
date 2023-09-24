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
