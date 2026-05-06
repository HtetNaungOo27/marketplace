<?php

namespace App\Livewire\Vendor;

use App\Models\Order;
use App\Models\Product;
use App\Models\VendorPayout;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $vendor = auth()->user()->vendor;

        $productsCount = Product::where('vendor_id', $vendor->id)->count();

        $orders = Order::with(['items.product', 'customer.user', 'payment'])
            ->whereHas('items.product', function ($query) use ($vendor) {
                $query->where('vendor_id', $vendor->id);
            })
            ->latest()
            ->get();

        $pendingOrders = $orders->where('order_status', 'Pending')->count();

        $pendingPayout = VendorPayout::where('vendor_id', $vendor->id)
            ->where('payout_status', 'Pending')
            ->sum('net_amount');

        $releasedPayout = VendorPayout::where('vendor_id', $vendor->id)
            ->where('payout_status', 'Released')
            ->sum('net_amount');

        $recentOrders = $orders->take(5);

        return view('livewire.vendor.dashboard', [
            'vendor' => $vendor,
            'productsCount' => $productsCount,
            'ordersCount' => $orders->count(),
            'pendingOrders' => $pendingOrders,
            'pendingPayout' => $pendingPayout,
            'releasedPayout' => $releasedPayout,
            'recentOrders' => $recentOrders,
        ])->layout('layouts.marketplace');
    }
}