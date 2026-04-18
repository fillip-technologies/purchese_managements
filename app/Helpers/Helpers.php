<?php

use App\Models\Vendor;

if (! function_exists('AllVendor')) {

    function AllVendor()
    {
        $verndors = Vendor::orderBy('id', 'desc')->get();

        return $verndors;
    }
}
if (! function_exists('req_no')) {
    function req_no()
    {
        $alpha = range('A', 'Z');
        $num = range(1, 1000);
        $randomLetter = $alpha[array_rand($alpha)];
        $getnum = $num[array_rand($num)];

        return date('d-m-Y').'-'.$randomLetter.$getnum;
    }
}


if (!function_exists('generatePOnumber')) {
    function generatePOnumber()
    {
        $prefix = 'PO';
        $year = date('Y');
        $month = date('m');
        $count = \App\Models\PurchaseOrder::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();
        $number = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        return "{$prefix}-{$year}-{$month}-{$number}";
    }
}
