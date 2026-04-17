<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id',
        'movement_type',
        'quantity',
        'reference_type',
        'reference_id',
        'remarks'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
