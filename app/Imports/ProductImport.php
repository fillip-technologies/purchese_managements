<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductImport implements ToModel,WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {

        return new Product([
            'product_name' => $row['product_name'] ?? null,
            'sku_code' => Str::slug($row['product_name']) ?? null,
            'category' => $row['category'] ?? null,
            'description' => $row['description'] ?? null,
            'unit' => $row['unit'] ?? null,
            'base_price' => $row['base_price'] ?? null,
            'gst_percent' => $row['gst_percent'] ?? null,
            'status' => $row['status'] ?? null,
        ]);
    }
}

