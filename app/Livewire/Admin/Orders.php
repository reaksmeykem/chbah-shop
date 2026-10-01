<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Orders — Chbah Admin')]
class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        return view('admin.orders', [
            'orders' => Order::with(['items.product', 'licenseKeys.product'])
                ->latest()
                ->paginate(10),
        ])->layout('layouts.admin');
    }
}
