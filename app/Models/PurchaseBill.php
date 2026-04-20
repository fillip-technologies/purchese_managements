<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseBill extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'vendor_id',
        'bill_no',
        'bill_date',
        'bill_amount',
        'gst_amount',
        'total_amount',
        'bill_file',
        'uploaded_by'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'uploaded_by');
    }
}
