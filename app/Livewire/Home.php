<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'featured' => Product::with('category')
                ->where('featured', true)
                ->orderBy('sort')
                ->take(4)
                ->get(),
            'categories' => Category::orderBy('sort')->get(),
        ])->title(__('site.title.default'));
    }
}
