<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'tagline', 'icon', 'sort'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected function localized(string $field, string $default): string
    {
        $key = "categories.{$this->slug}.{$field}";
        $translated = __($key);

        return $translated === $key ? $default : $translated;
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->localized('name', $this->name);
    }

    public function getDisplayTaglineAttribute(): string
    {
        return $this->localized('tagline', $this->tagline);
    }
}
