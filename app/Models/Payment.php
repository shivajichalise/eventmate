<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Relations\BelongsToThrough;

class Payment extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'invoice_id',
        'amount',
        'paid',
        'status',
    ];

    public static function revenue(): int
    {
        return self::where('paid', true)
                    ->where('status', 'verified')
                    ->sum('amount');
    }

    public function user(): BelongsToThrough
    {
        return $this->belongsToThrough(User::class, Invoice::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function ticket(): BelongsToThrough
    {
        return $this->belongsToThrough(Ticket::class, Invoice::class);
    }
}
