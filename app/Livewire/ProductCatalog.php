<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Services\Analytics;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $category = '';

    #[Url]
    public string $sort = 'featured';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        if (mb_strlen(trim($this->search)) >= 2) {
            Analytics::track('search', ['search' => trim($this->search)]);
        }
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function setCategory(string $slug): void
    {
        $this->category = $slug;
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::with('category')
            ->when($this->search, function ($q) {
                $term = '%' . str_replace(' ', '%', trim($this->search)) . '%';
                $q->where(fn ($q) => $q
                    ->where('name', 'like', $term)
                    ->orWhere('tagline', 'like', $term)
                    ->orWhere('description', 'like', $term));
            })
            ->when($this->category, fn ($q, $slug) => $q->whereHas(
                'category',
                fn ($c) => $c->where('slug', $slug),
            ));

        $query = match ($this->sort) {
            'newest' => $query->orderByDesc('created_at')->orderByDesc('id'),
            'price-asc' => $query->orderBy('price_cents'),
            'price-desc' => $query->orderByDesc('price_cents'),
            default => $query->orderByDesc('featured')->orderBy('sort'),
        };

        return view('livewire.product-catalog', [
            'products' => $query->paginate(9),
            'categories' => Category::orderBy('sort')->get(),
        ])->title(__('site.title.shop'));
    }
}
