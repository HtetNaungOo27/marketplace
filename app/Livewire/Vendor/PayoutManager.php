<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\VendorPayout;

class PayoutManager extends Component
{
    public function render()
    {
        $vendorId = auth()->user()->vendor->id;

        $payouts = VendorPayout::with('order')
            ->where('vendor_id', $vendorId)
            ->latest()
            ->get();

        return view('livewire.vendor.payout-manager', [
            'payouts' => $payouts,
            'totalPending' => $payouts->where('payout_status', 'Pending')->sum('net_amount'),
            'totalReleased' => $payouts->where('payout_status', 'Released')->sum('net_amount'),
        ])->layout('layouts.marketplace');
    }
}