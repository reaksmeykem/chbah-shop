<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'tagline', 'description',
        'price_cents', 'image', 'badge', 'featured',
        'version', 'requirements', 'download_url', 'features', 'key_prefix',
        'sort',
    ];

    protected function casts(): array
    {
        return ['features' => 'array', 'featured' => 'boolean'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function licenseKeys(): HasMany
    {
        return $this->hasMany(LicenseKey::class);
    }

    public function getPriceAttribute(): string
    {
        return '$' . number_format($this->price_cents / 100, ($this->price_cents % 100 === 0) ? 0 : 2);
    }

    public function getImageUrlAttribute(): string
    {
        return asset("images/products/{$this->image}");
    }

    public function availableKeysCount(): int
    {
        return $this->licenseKeys()->where('status', 'available')->count();
    }

    /**
     * Localized text: looks up lang/{locale}/products.php by slug first,
     * falls back to the database column (English).
     */
    protected function localized(string $field, mixed $default): mixed
    {
        $key = "products.{$this->slug}.{$field}";
        $translated = __($key);

        return $translated === $key ? $default : $translated;
    }

    public function getDisplayTaglineAttribute(): string
    {
        return $this->localized('tagline', $this->tagline);
    }

    public function getDisplayDescriptionAttribute(): string
    {
        return $this->localized('description', $this->description);
    }

    public function getDisplayFeaturesAttribute(): array
    {
        return $this->localized('features', $this->features);
    }
}
