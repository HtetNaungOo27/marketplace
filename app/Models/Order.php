<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'order_date',
        'total_amount',
        'order_status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public function vendorPayouts()
    {
        return $this->hasMany(VendorPayout::class);
    }

    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }
}
