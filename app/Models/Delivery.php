<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
     protected $fillable = [
        'dispatch_id',
        'received_by_name',
        'received_date',
        'drop_point',
        'received_photo',
        'receipt_file',
        'remarks',
        'created_by'
    ];

    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
