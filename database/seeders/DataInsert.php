<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataInsert extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $vendors = Vendor::all();
        $products = Product::all();

        foreach ($vendors as $vendor) {

           
            $randomProducts = $products->random(rand(2, 5));

            foreach ($randomProducts as $product) {
                VendorProduct::create([
                    'vendor_id' => $vendor->id,
                    'product_id' => $product->id,
                    'price' => rand(100, 5000),
                    'gst_percent' => [5, 12, 18][array_rand([5,12,18])],
                    'lead_time_days' => rand(1, 10),
                ]);
            }
        }
    }
}
