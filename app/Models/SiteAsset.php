<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteAsset extends Model
{
    protected $fillable = [
        'key',
        'label',
        'image_path',
        'fallback_url',
    ];

    public function getUrlAttribute(): ?string
    {
        if ($this->image_path) {
            return Storage::disk('public')->url($this->image_path);
        }

        return $this->fallback_url;
    }

    public static function url(string $key, ?string $default = null): ?string
    {
        $asset = static::query()->where('key', $key)->first();

        return $asset?->url ?? $default;
    }
}
