<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'dispatch_date',
        'transport_mode',
        'vehicle_no',
        'driver_name',
        'driver_phone',
        'from_location',
        'to_location',
        'transport_cost',
        'remarks',
        'dispatch_photo',
        'created_by'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
