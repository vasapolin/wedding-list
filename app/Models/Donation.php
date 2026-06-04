<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    /** @use HasFactory<\Database\Factories\DonationFactory> */
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    public const STATUS_PAID = 'paid';

    public const STATUS_FAILED = 'failed';

    public const STATUS_REFUNDED = 'refunded';

    protected $fillable = [
        'gift_id',
        'donor_name',
        'donor_email',
        'donor_document',
        'amount_cents',
        'message',
        'is_anonymous',
        'payment_method',
        'status',
        'asaas_payment_id',
        'asaas_payload',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount_cents' => 'integer',
            'is_anonymous' => 'boolean',
            'asaas_payload' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    public function gift(): BelongsTo
    {
        return $this->belongsTo(Gift::class);
    }

    public function getAmountAttribute(): float
    {
        return $this->amount_cents / 100;
    }
}
