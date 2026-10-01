<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

/**
 * Session-backed cart: [product_id => quantity].
 * All mutations dispatch nothing themselves — Livewire components
 * broadcast 'cart-updated' so badges and panels stay in sync.
 */
class Cart
{
    public function add(int $productId, int $qty = 1): void
    {
        $cart = $this->raw();
        $cart[$productId] = min(($cart[$productId] ?? 0) + $qty, 99);
        session(['cart' => $cart]);
    }

    public function setQty(int $productId, int $qty): void
    {
        $cart = $this->raw();
        if ($qty <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = min($qty, 99);
        }
        session(['cart' => $cart]);
    }

    public function remove(int $productId): void
    {
        $cart = $this->raw();
        unset($cart[$productId]);
        session(['cart' => $cart]);
    }

    public function clear(): void
    {
        session()->forget('cart');
    }

    public function raw(): array
    {
        return session('cart', []);
    }

    /** @return Collection<int, array{product: Product, qty: int}> */
    public function lines(): Collection
    {
        if (empty($this->raw())) {
            return collect();
        }

        $products = Product::with('category')
            ->whereKey(array_keys($this->raw()))
            ->get()
            ->keyBy('id');

        return collect($this->raw())
            ->map(fn ($qty, $id) => $products->has($id) ? ['product' => $products[$id], 'qty' => $qty] : null)
            ->filter()
            ->values();
    }

    public function count(): int
    {
        return array_sum($this->raw());
    }

    public function subtotalCents(): int
    {
        return $this->lines()->sum(fn ($line) => $line['product']->price_cents * $line['qty']);
    }

    public function subtotal(): string
    {
        $cents = $this->subtotalCents();

        return '$' . number_format($cents / 100, ($cents % 100 === 0) ? 0 : 2);
    }
}
