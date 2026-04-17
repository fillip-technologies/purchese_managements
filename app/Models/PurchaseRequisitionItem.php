<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequisitionItem extends Model
{
    protected $fillable = [
        'requisition_id',
        'product_id',
        'quantity',
        'unit',
        'remarks'
    ];

    public function requisition()
    {
        return $this->belongsTo(PurchaseRequisition::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
