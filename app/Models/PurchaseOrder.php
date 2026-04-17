<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
     protected $fillable = [
        'po_number',
        'requisition_id',
        'vendor_id',
        'client_id',
        'approved_by',
        'subtotal',
        'gst_amount',
        'total_amount',
        'status'
    ];

    public function requisition()
    {
        return $this->belongsTo(PurchaseRequisition::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }
}
