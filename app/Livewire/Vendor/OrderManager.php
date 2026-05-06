<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Order;
use \App\Models\Delivery;

class OrderManager extends Component
{
    public function updateStatus($orderId, $status)
    {
        $order = \App\Models\Order::findOrFail($orderId);

        // optional security check
        $vendorId = auth()->user()->vendor->id;

        $hasProduct = $order->items()->whereHas('product', function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->exists();

        if (!$hasProduct) {
            abort(403);
        }

        $order->update([
            'order_status' => $status,
        ]);

        if ($status === 'Shipped' && !$order->delivery) {

            Delivery::create([

                'order_id' => $order->id,

                'delivery_staff_id' => null,

                'tracking_number' => 'TRK-' . strtoupper(uniqid()),

                'delivery_status' => 'Preparing',

                'delivery_date' => null,

            ]);
        }

        session()->flash('message', 'Order status updated.');
    }
    public function render()
    {
        $vendorId = auth()->user()->vendor->id;

        $orders = Order::with(['items.product', 'customer.user', 'payment','delivery'])
            ->whereHas('items.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->latest()
            ->get();

        return view('livewire.vendor.order-manager', [
            'orders' => $orders,
        ])->layout('layouts.marketplace');
    }
}
