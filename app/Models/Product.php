<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'sku_code',
        'category',
        'description',
        'unit',
        'base_price',
        'gst_percent',
        'status'
    ];
}
