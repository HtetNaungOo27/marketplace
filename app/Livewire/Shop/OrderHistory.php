<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Order;

class OrderHistory extends Component
{
    public function render()
    {
        $customer = auth()->user()->customer;

        $orders = Order::with(['items.product', 'delivery'])
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();

        return view('livewire.shop.order-history', [
            'orders' => $orders,
        ])->layout('layouts.marketplace');
    }
}