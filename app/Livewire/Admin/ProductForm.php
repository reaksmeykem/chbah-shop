<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Support\AppIcon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductForm extends Component
{
    public ?Product $product = null;

    public function getTitleProperty(): string
    {
        return ($this->product->exists ? 'Edit product' : 'New product') . ' — Chbah Admin';
    }

    public string $name = '';

    public string $slug = '';

    public int $category_id = 0;

    public string $tagline = '';

    public string $description = '';

    public string $price = '';          // dollars, e.g. "24"

    public string $version = '1.0';

    public string $requirements = 'Windows 10/11 · 64-bit';

    public string $download_url = '';

    public string $features = '';       // one per line

    public string $key_prefix = '';

    public string $badge = '';

    public bool $featured = false;

    public bool $generate_art = true;

    public bool $saved = false;

    public function mount(?Product $product = null): void
    {
        if ($product?->exists) {
            $this->fill([
                'name' => $product->name,
                'slug' => $product->slug,
                'category_id' => $product->category_id,
                'tagline' => $product->tagline,
                'description' => $product->description,
                'price' => number_format($product->price_cents / 100, 2, '.', ''),
                'version' => $product->version,
                'requirements' => $product->requirements,
                'download_url' => $product->download_url ?? '',
                'features' => implode("\n", $product->features ?? []),
                'key_prefix' => $product->key_prefix,
                'badge' => $product->badge ?? '',
                'featured' => $product->featured,
                'generate_art' => false,
            ]);
            $this->product = $product;
        }
    }

    public function updatedName(): void
    {
        if (! $this->product?->exists) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'slug' => ['required', 'alpha_dash', 'max:100', Rule::unique('products', 'slug')->ignore($this->product?->id)],
            'category_id' => 'required|exists:categories,id',
            'tagline' => 'required|string|max:160',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:100000',
            'version' => 'required|string|max:20',
            'requirements' => 'required|string|max:160',
            'download_url' => 'nullable|string|max:255',
            'features' => 'required|string|min:2',
            'key_prefix' => ['required', 'alpha', 'min:2', 'max:6', Rule::unique('products', 'key_prefix')->ignore($this->product?->id)],
            'badge' => 'nullable|in:,New,Bestseller',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'tagline' => $this->tagline,
            'description' => $this->description,
            'price_cents' => (int) round(((float) $this->price) * 100),
            'version' => $this->version,
            'requirements' => $this->requirements,
            'download_url' => $this->download_url ?: null,
            'features' => collect(preg_split('/\r\n|\r|\n/', $this->features))->map(fn ($s) => trim($s))->filter()->values()->all(),
            'key_prefix' => strtoupper($this->key_prefix),
            'badge' => $this->badge ?: null,
            'featured' => $this->featured,
        ];

        if ($this->product?->exists) {
            $this->product->update($data);
            $product = $this->product;
        } else {
            $data['image'] = "{$this->slug}.svg";
            $data['sort'] = (Product::where('category_id', $this->category_id)->max('sort') ?? 0) + 1;
            $product = Product::create($data);
        }

        if ($this->generate_art) {
            AppIcon::generate($product->slug, $product->name);
        }

        session()->flash('status', $this->product?->exists ? 'Product updated.' : 'Product created — it is live in the shop.');

        $this->redirect(route('admin.products'), navigate: true);
    }

    public function render()
    {
        return view('admin.product-form', [
            'categories' => \App\Models\Category::orderBy('sort')->get(),
        ])->layout('layouts.admin');
    }
}
