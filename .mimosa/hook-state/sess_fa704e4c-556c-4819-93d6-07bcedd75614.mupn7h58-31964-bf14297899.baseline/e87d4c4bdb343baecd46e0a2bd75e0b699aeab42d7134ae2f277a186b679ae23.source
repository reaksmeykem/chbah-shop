<?php

namespace App\Livewire\Admin;

use App\Models\LicenseKey;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('License keys — Chbah Admin')]
class Keys extends Component
{
    public function generate(int $productId, int $count = 10): void
    {
        $product = Product::find($productId);

        if ($product) {
            LicenseKey::generateFor($product, $count);
            session()->flash('status', "{$count} new keys generated for {$product->name}.");
        }
    }

    public function render()
    {
        return view('admin.keys', [
            'products' => Product::withCount([
                'licenseKeys as available_count' => fn ($q) => $q->where('status', 'available'),
                'licenseKeys as issued_count' => fn ($q) => $q->where('status', 'issued'),
            ])->orderBy('sort')->get(),
        ])->layout('layouts.admin');
    }
}
