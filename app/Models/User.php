<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'gender',
        'is_disabled',
        'password',
        'address_line_1',
        'state',
        'city',
        'country',
        'mobile_number',
        'emergency_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Invoice::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Check if the user has made a payment for a specific ticket.
     *
     * @param Ticket $ticket
     * @return bool
     */
    public function hasPaidForTicket(Ticket $ticket): bool
    {
        // Retrieve the invoice associated with the ticket and user
        $invoice = $this->invoices()
        ->where('ticket_id', $ticket->id)
        ->first();

        if ($invoice) {
            // Check if there is a payment associated with the invoice
            return $invoice->payment !== null;
        }

        return false; // No invoice found, indicating no payment
    }

    /**
     * Get all the tickets for which the user has made a payment.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ticketsWithPayments(): EloquentCollection
    {
        // Retrieve all the invoices associated with this user's payments
        $invoices = Invoice::whereHas('payment', function ($query) {
            $query->where('user_id', $this->id);
        })->get();

        // Extract the ticket IDs from the invoices
        $ticketIds = $invoices->pluck('ticket_id')->unique()->toArray();

        // Retrieve the tickets with those IDs
        return Ticket::whereIn('id', $ticketIds)->get();
    }

}
