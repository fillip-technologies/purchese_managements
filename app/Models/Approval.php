<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
     protected $fillable = [
        'purchase_order_id',
        'approved_by',
        'approval_status',
        'comments',
        'approved_at'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
