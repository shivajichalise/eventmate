<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'number',
        'number',
        'issued_date',
        'due_date',
        'amount',
        'discount',
        'tax',
        'total_amount',
        'status'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoice->number = static::generateInvoiceNumber();
        });
    }

    protected static function generateInvoiceNumber(): string
    {
        // Generate the invoice number based on your desired format
        // For example, you can use a combination of prefix, date, and incremental number
        $prefix = 'INV';
        $date = now()->format('Ymd');
        $increment = static::query()->count() + 1;
        $number = str_pad($increment, 5, '0', STR_PAD_LEFT);

        return $prefix . '-' . $date . '-' . $number;
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

}
