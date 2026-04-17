<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequisition extends Model
{
    protected $fillable = [
        'req_no',
        'client_id',
        'project_name',
        'requested_by',
        'remarks',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function items()
    {
        return $this->hasMany(PurchaseRequisitionItem::class, 'requisition_id');
    }
}
