<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorProduct;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VendorProductImport implements ToModel,WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
       
        $vendorId = Vendor::where('vendor_name', $row['vender_name'])->select('id')->first();
        $productId = Product::where('product_name', $row['product_name'])->select('id')->first();

        return new VendorProduct([
            'vendor_id' => $vendorId->id ?? null,
            'product_id' => $productId->id ?? null,
            'price' => $row['price'] ?? null,
            'gst_percent' => $row['gst_percent'] ?? null,
            'lead_time_days' => $row['lead_time_date'] ?? null,
        ]);
    }
}

