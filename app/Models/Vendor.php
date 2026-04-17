<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
     protected $fillable = [
        'vendor_name',
        'company_name',
        'gst_no',
        'address',
        'contact_person',
        'phone',
        'email',
        'status'
    ];
}
