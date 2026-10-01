<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\Analytics;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public int $qty = 1;

    public function mount(string $slug): void
    {
        $this->product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        Analytics::track('product_viewed', ['product_id' => $this->product->id]);
    }

    public function add(): void
    {
        $this->dispatch('add-to-cart', id: $this->product->id, qty: max(1, $this->qty));
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'related' => Product::with('category')
                ->where('category_id', $this->product->category_id)
                ->where('id', '!=', $this->product->id)
                ->orderBy('sort')
                ->take(4)
                ->get(),
        ])->title(__('site.title.product', ['name' => $this->product->name]));
    }
}
