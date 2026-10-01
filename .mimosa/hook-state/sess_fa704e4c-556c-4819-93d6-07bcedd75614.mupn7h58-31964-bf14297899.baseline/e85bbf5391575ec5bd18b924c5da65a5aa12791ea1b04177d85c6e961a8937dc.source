<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class LicenseKey extends Model
{
    protected $fillable = ['product_id', 'key', 'status', 'order_id', 'issued_at'];

    protected function casts(): array
    {
        return ['issued_at' => 'datetime'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /** Mint new keys for a product and return how many were created. */
    public static function generateFor(Product $product, int $count = 10): int
    {
        $created = 0;

        for ($i = 0; $i < $count; $i++) {
            self::create([
                'product_id' => $product->id,
                'key' => sprintf(
                    '%s-%s-%s-%s',
                    $product->key_prefix,
                    Str::upper(Str::random(4)),
                    Str::upper(Str::random(4)),
                    Str::upper(Str::random(4)),
                ),
                'status' => 'available',
            ]);
            $created++;
        }

        return $created;
    }
}
