<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Per-gift contributions making up this donation. A donation may spread a
     * partial amount across several gifts, so these items — not `gift_id` —
     * are what credit the gifts once the payment is confirmed.
     */
    public function items(): HasMany
    {
        return $this->hasMany(DonationItem::class);
    }

    public function getAmountAttribute(): float
    {
        return $this->amount_cents / 100;
    }

    /**
     * Short label for what this donation is for, or null when it is a free
     * contribution not tied to any gift.
     */
    public function getGiftSummaryAttribute(): ?string
    {
        $this->loadMissing('items.gift');

        $names = $this->items
            ->map(fn (DonationItem $item): ?string => $item->gift?->name)
            ->filter();

        if ($names->count() === 1) {
            return $names->first();
        }

        if ($names->count() > 1) {
            return $names->count().' presentes';
        }

        return $this->gift?->name;
    }
}
