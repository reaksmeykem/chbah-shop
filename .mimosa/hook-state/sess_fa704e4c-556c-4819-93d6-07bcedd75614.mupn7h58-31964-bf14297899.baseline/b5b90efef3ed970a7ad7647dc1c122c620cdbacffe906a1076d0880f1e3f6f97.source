<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products — Chbah Admin')]
class Products extends Component
{
    use WithPagination;

    public string $search = '';

    public function toggleFeatured(int $id): void
    {
        $product = Product::find($id);

        if ($product) {
            $product->update(['featured' => ! $product->featured]);
        }
    }

    public function delete(int $id): void
    {
        Product::find($id)?->delete();

        session()->flash('status', 'Product deleted.');
    }

    public function render()
    {
        $query = Product::with('category')
            ->withCount(['licenseKeys as available_keys' => fn ($q) => $q->where('status', 'available')])
            ->when($this->search, fn ($q) => $q->where(fn ($q) => $q
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('slug', 'like', "%{$this->search}%")))
            ->orderBy('category_id')
            ->orderBy('sort');

        return view('admin.products', [
            'products' => $query->paginate(20),
        ])->layout('layouts.admin');
    }
}
