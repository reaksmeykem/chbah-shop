<?php

namespace App\Livewire;

use App\Models\LicenseKey;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Analytics;
use App\Services\Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use RuntimeException;

class CartPanel extends Component
{
    public string $step = 'cart'; // cart | success

    public string $email = '';

    /** @var array<int, array{product: string, key: string, version: string, download: ?string}> */
    public array $issuedKeys = [];

    #[On('add-to-cart')]
    public function add(int $id, int $qty = 1): void
    {
        $product = Product::find($id);

        if (! $product) {
            return;
        }

        app(Cart::class)->add($id, $qty);
        $this->step = 'cart';
        Analytics::track('add_to_cart', ['product_id' => $product->id, 'meta' => ['qty' => $qty]]);
        $this->dispatch('cart-added', name: $product->name);
        $this->dispatch('cart-updated');
    }

    public function increase(int $id): void
    {
        app(Cart::class)->setQty($id, (app(Cart::class)->raw()[$id] ?? 0) + 1);
        $this->dispatch('cart-updated');
    }

    public function decrease(int $id): void
    {
        app(Cart::class)->setQty($id, (app(Cart::class)->raw()[$id] ?? 0) - 1);
        $this->dispatch('cart-updated');
    }

    public function remove(int $id): void
    {
        app(Cart::class)->remove($id);
        $this->dispatch('cart-updated');
    }

    public function clear(): void
    {
        app(Cart::class)->clear();
        $this->dispatch('cart-updated');
    }

    public function checkout(): void
    {
        $this->validate(
            ['email' => 'required|email'],
            ['email.required' => __('site.cart.email_required')],
        );

        $cart = app(Cart::class);
        $lines = $cart->lines();

        if ($lines->isEmpty()) {
            return;
        }

        try {
            $result = DB::transaction(function () use ($lines, $cart) {
                $order = Order::create([
                    'email' => $this->email,
                    'total_cents' => $cart->subtotalCents(),
                ]);

                $collected = [];

                foreach ($lines as $line) {
                    $product = $line['product'];
                    $qty = $line['qty'];

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'qty' => $qty,
                        'unit_price_cents' => $product->price_cents,
                    ]);

                    $keys = LicenseKey::where('product_id', $product->id)
                        ->where('status', 'available')
                        ->orderBy('id')
                        ->limit($qty)
                        ->lockForUpdate()
                        ->get();

                    if ($keys->count() < $qty) {
                        throw new RuntimeException($product->name);
                    }

                    foreach ($keys as $license) {
                        $license->update([
                            'status' => 'issued',
                            'order_id' => $order->id,
                            'issued_at' => now(),
                        ]);

                        $collected[] = [
                            'product' => $product->name,
                            'key' => $license->key,
                            'version' => $product->version,
                            'download' => $product->download_url,
                        ];
                    }
                }

                $cart->clear();

                return ['keys' => $collected, 'total' => $order->total_cents];
            });
        } catch (RuntimeException $soldOut) {
            $this->addError('checkout', __('site.cart.sold_out', ['name' => $soldOut->getMessage()]));

            return;
        }

        $this->issuedKeys = $result['keys'];
        $this->step = 'success';
        $this->resetErrorBag();
        Analytics::track('purchase', ['meta' => [
            'total_cents' => $result['total'],
            'keys' => count($result['keys']),
            'products' => implode(', ', array_column($result['keys'], 'product')),
        ]]);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $cart = app(Cart::class);

        return view('livewire.cart-panel', [
            'lines' => $cart->lines(),
            'subtotal' => $cart->subtotal(),
            'count' => $cart->count(),
        ]);
    }
}
