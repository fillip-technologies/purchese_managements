<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientImport implements ToModel,WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
      
        return new Client([
            'client_name' => $row['client_name'] ?? null,
            'company_name' => $row['company_name'] ?? null,
            'address' => $row['address'] ?? null,
            'contact_person' => $row['contact_person'] ?? null,
            'phone' => $row['phone'] ?? null,
            'email' => $row['email'] ?? null,
            'gst_no' => $row['gst_no'] ?? null,
            'status'=>$row['status'] ?? null,
        ]);
    }
}

