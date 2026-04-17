<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $fillable = [
        'client_name',
        'company_name',
        'address',
        'contact_person',
        'phone',
        'email',
        'gst_no',
        'status'
    ];
}
