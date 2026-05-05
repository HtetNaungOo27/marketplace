<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'order_id',
        'delivery_staff_id',
        'tracking_number',
        'delivery_status',
        'delivery_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function deliveryStaff()
    {
        return $this->belongsTo(User::class, 'delivery_staff_id');
    }
}
