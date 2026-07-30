<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Gift extends Model
{
    /** @use HasFactory<\Database\Factories\GiftFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path',
        'category',
        'price_cents',
        'raised_cents',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price_cents' => 'integer',
            'raised_cents' => 'integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Gift $gift): void {
            if (empty($gift->slug) && ! empty($gift->name)) {
                $gift->slug = static::makeUniqueSlug($gift->name, $gift->id);
            }
        });

        static::deleting(function (Gift $gift): bool {
            return ! $gift->donations()
                ->where('status', Donation::STATUS_PAID)
                ->exists();
        });
    }

    protected static function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;
        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.++$i;
        }

        return $slug;
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function donationItems(): HasMany
    {
        return $this->hasMany(DonationItem::class);
    }

    /**
     * How much is still missing to fully fund this gift. Never negative:
     * concurrent payments can push `raised_cents` past the price.
     */
    public function getRemainingCentsAttribute(): int
    {
        return max(0, $this->price_cents - $this->raised_cents);
    }

    public function isFullyFunded(): bool
    {
        return $this->remaining_cents === 0;
    }

    /**
     * Uploaded gift photo, falling back to the admin-managed placeholder.
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image_path) {
            return Storage::disk('public')->url($this->image_path);
        }

        return SiteAsset::url(
            'gifts.placeholder',
            'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&q=80',
        );
    }

    public function getPriceAttribute(): float
    {
        return $this->price_cents / 100;
    }

    public function getRaisedAttribute(): float
    {
        return $this->raised_cents / 100;
    }

    public function getProgressPercentageAttribute(): int
    {
        if ($this->price_cents <= 0) {
            return 0;
        }

        return min(100, (int) floor(($this->raised_cents / $this->price_cents) * 100));
    }
}
