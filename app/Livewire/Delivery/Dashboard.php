<?php

namespace App\Livewire\Delivery;

use App\Models\Delivery;
use Livewire\Component;

class Dashboard extends Component
{
    public function updateDeliveryStatus($deliveryId, $status)
    {
        $delivery = Delivery::where('delivery_staff_id', auth()->id())
            ->findOrFail($deliveryId);

        $delivery->update([
            'delivery_status' => $status,
            'delivery_date' => $status === 'Delivered' ? now() : null,
        ]);

        if ($status === 'Delivered') {
            $delivery->order->update([
                'order_status' => 'Delivered',
            ]);
        }

        session()->flash('message', 'Delivery status updated.');
    }

    public function render()
    {
        $deliveries = Delivery::with(['order.customer.user', 'order.items.product'])
            ->where('delivery_staff_id', auth()->id())
            ->latest()
            ->get();

        return view('livewire.delivery.dashboard', [
            'deliveries' => $deliveries,
        ])->layout('layouts.marketplace');
    }
}