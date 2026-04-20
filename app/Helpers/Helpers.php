<?php

use App\Models\Dispatch;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

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

if (! function_exists('generatePOnumber')) {
    function generatePOnumber()
    {
        $prefix = 'PO';
        $year = date('Y');
        $month = date('m');
        $count = PurchaseOrder::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        $number = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        return "{$prefix}-{$year}-{$month}-{$number}";
    }
}

if (! function_exists('orderItems')) {
    function orderItems()
    {
        $id = Auth::guard('user')->user()->id;

        $orders = PurchaseOrder::with([
            'requisition' => function ($q) use ($id) {
                $q->where('requested_by', $id);
            },
        ])
            ->select('id', 'po_number')
            ->orderBy('id', 'desc')
            ->get();

        return $orders;
    }
}

if (! function_exists('dipsachdata')) {
    function dipsachdata()
    {
        $id = Auth::guard('user')->user()->id;
        $data = Dispatch::where('created_by', $id)->get();

        return $data;
    }
}
