<?php

namespace App\Livewire\Admin;

use App\Models\LicenseKey;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'availableKeys' => LicenseKey::where('status', 'available')->count(),
            'issuedKeys' => LicenseKey::where('status', 'issued')->count(),
            'orderCount' => Order::count(),
            'revenueCents' => (int) Order::sum('total_cents'),
            'recentOrders' => Order::with('items.product')->latest()->take(5)->get(),
        ])->layout('layouts.admin');
    }
}
