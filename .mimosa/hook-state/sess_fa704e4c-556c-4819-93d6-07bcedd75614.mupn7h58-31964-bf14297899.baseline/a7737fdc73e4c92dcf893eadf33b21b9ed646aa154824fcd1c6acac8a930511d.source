<?php

namespace App\Livewire;

use App\Services\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartBadge extends Component
{
    #[On('cart-updated')]
    public function render()
    {
        return view('livewire.cart-badge', [
            'count' => app(Cart::class)->count(),
        ]);
    }
}
