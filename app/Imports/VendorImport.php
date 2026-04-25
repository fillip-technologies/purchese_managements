<?php

namespace App\Imports;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VendorImport implements ToModel,WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        
        return new Vendor([
            'vendor_name' => $row['vendor_name'] ?? null,
            'company_name' => $row['company_name'] ?? null,
            'gst_no' => $row['gst_no'] ?? null,
            'address' => $row['address'] ?? null,
            'contact_person' => $row['contact_person'] ?? null,
            'phone' => $row['phone'] ?? null,
            'email' => $row['email'] ?? null,
            'status' => $row['status'] ?? null,
        ]);
    }
}

