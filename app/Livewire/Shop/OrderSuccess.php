<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use Livewire\Component;

class OrderSuccess extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        abort_unless($order->customer_id === auth()->user()->customer->id, 403);

        $this->order = $order->load(['items.product', 'payment', 'delivery']);
    }

    public function render()
    {
        return view('livewire.shop.order-success')
            ->layout('layouts.marketplace');
    }
}