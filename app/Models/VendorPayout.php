<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPayout extends Model
{
    protected $fillable = [
        'vendor_id',
        'order_id',
        'gross_amount',
        'commission_rate',
        'commission_amount',
        'net_amount',
        'payout_status',
        'payout_date',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
