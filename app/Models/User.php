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
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

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
        'profile_status',
        'is_active'
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
        'profile_status' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Set the default value for 'profile_status'
            $user->profile_status = json_encode(['profileInfo', 'addressInfo', 'contactInfo']);
        });
    }

    public function isProfileCompleted(): bool
    {
        // Check if profile_status array is empty
        return empty($this->profile_status);
    }

    /**
     * Assign a role to the user if they have completed their profile.
     *
     * @param string $roleName
     * @return bool Whether the role was assigned or not.
     */
    public function assignRoleIfProfileCompleted($roleName): bool
    {
        // Check if the user has completed their profile
        if ($this->isProfileCompleted()) {
            // Check if the user already has the role
            if (!$this->hasRole($roleName)) {
                // Assign the role to the user
                $this->assignRole($roleName);

                return true; // Role assigned successfully
            }
        }

        return false; // Role not assigned
    }

    /**
     * Get the comma-separated string of role names assigned to the user.
     *
     * @return string
     */
    public function assignedRoles(): string
    {
        $roleNames = $this->roles->pluck('name')->toArray();
        // Capitalize the first letter of each role name
        $roleNames = array_map('ucfirst', $roleNames);

        return implode(', ', $roleNames);
    }

    /**
     * Get user registration data by month using Eloquent.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getUserRegistrationDataByMonth()
    {
        return static::select(
            \DB::raw('YEAR(created_at) as year'),
            \DB::raw('MONTH(created_at) as month'),
            \DB::raw('COUNT(*) as registrations')
        )
            ->groupBy(['year', 'month'])
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();
    }

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
    public function ticketsWithPayments(?string $relationship = null): EloquentCollection
    {
        // Retrieve all the invoices associated with this user's payments
        $invoices = Invoice::whereHas('payment', function ($query) {
            $query->where('user_id', $this->id);
        })->get();

        // Extract the ticket IDs from the invoices
        $ticketIds = $invoices->pluck('ticket_id')->unique()->toArray();

        // Retrieve the tickets with those IDs
        $query = Ticket::whereIn('id', $ticketIds)->orderBy('created_at', 'desc');

        if($relationship) {
            $query->with($relationship);
        }

        return $query->get();
    }

}
