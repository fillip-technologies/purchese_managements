<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (! function_exists('app_date')) {
    function app_date($date, $format = 'd M Y')
    {
        return $date ? Carbon::parse($date)->format($format) : '';
    }
}

if (! function_exists('app_datetime')) {
    function app_datetime($date)
    {
        return $date ? Carbon::parse($date)->format('d M Y h:i A') : '';
    }
}

if (! function_exists('currency_inr')) {
    function currency_inr($amount)
    {
        return '₹ '.number_format((float) $amount, 2);
    }
}

if (! function_exists('number_only')) {
    function number_only($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}

if (! function_exists('slug_generate')) {
    function slug_generate($text)
    {
        return Str::slug($text);
    }
}

if (! function_exists('serial_no')) {
    function serial_no($loop, $items = null)
    {
        if ($items && method_exists($items, 'currentPage')) {
            return (($items->currentPage() - 1) * $items->perPage()) + $loop->iteration;
        }

        return $loop->iteration;
    }
}

if (! function_exists('status_badge')) {
    function status_badge($status)
    {
        if (strtolower($status) == 'active') {
            return '<span class="badge bg-success">Active</span>';
        }

        return '<span class="badge bg-danger">Inactive</span>';
    }
}

if (! function_exists('yes_no_badge')) {
    function yes_no_badge($value)
    {
        return $value
            ? '<span class="badge bg-success">Yes</span>'
            : '<span class="badge bg-secondary">No</span>';
    }
}

if (! function_exists('delete_btn')) {
    function delete_btn($route)
    {
        return '
        <form action="'.$route.'" method="POST" style="display:inline-block">
            '.csrf_field().'
            '.method_field('DELETE').'
            <button onclick="return confirm(\'Delete this record?\')" class="btn btn-danger btn-sm">
                Delete
            </button>
        </form>';
    }
}

if (! function_exists('edit_btn')) {
    function edit_btn($route)
    {
        return '<a href="'.$route.'" class="btn btn-warning btn-sm">Edit</a>';
    }
}

if (! function_exists('view_btn')) {
    function view_btn($route)
    {
        return '<a href="'.$route.'" class="btn btn-info btn-sm">View</a>';
    }
}

if (! function_exists('selected_option')) {
    function selected_option($value, $match)
    {
        return $value == $match ? 'selected' : '';
    }
}

if (! function_exists('checked_option')) {
    function checked_option($value, $match)
    {
        return $value == $match ? 'checked' : '';
    }
}

if (! function_exists('old_value')) {
    function old_value($key, $default = '')
    {
        return old($key, $default);
    }
}

if (! function_exists('vendor_name')) {
    function vendor_name($vendor)
    {
        return $vendor->vendor_name.(! empty($vendor->company_name) ? ' - '.$vendor->company_name : '');
    }
}

if (! function_exists('vendor_contact')) {
    function vendor_contact($vendor)
    {
        return $vendor->phone.(! empty($vendor->email) ? ' | '.$vendor->email : '');
    }
}

if (! function_exists('po_number')) {
    function po_number($id)
    {
        return 'PO-'.str_pad($id, 5, '0', STR_PAD_LEFT);
    }
}

if (! function_exists('invoice_number')) {
    function invoice_number($id)
    {
        return 'INV-'.date('Y').'-'.str_pad($id, 5, '0', STR_PAD_LEFT);
    }
}

if (! function_exists('purchase_total')) {
    function purchase_total($qty, $rate)
    {
        return $qty * $rate;
    }
}

if (! function_exists('req_no')) {
    function req_no()
    {
        $alpha = range('A', 'Z');
        $num = range(1,1000);
        $randomLetter = $alpha[array_rand($alpha)];
        $getnum = $num[array_rand($num)];
        return date('d-m-Y').'-'.$randomLetter.$getnum;
    }
}

if (! function_exists('payment_badge')) {
    function payment_badge($status)
    {
        if ($status == 'Paid') {
            return '<span class="badge bg-success">Paid</span>';
        } elseif ($status == 'Partial') {
            return '<span class="badge bg-warning text-dark">Partial</span>';
        }

        return '<span class="badge bg-danger">Unpaid</span>';
    }
}

/*
|--------------------------------------------------------------------------
| STOCK HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('stock_badge')) {
    function stock_badge($qty)
    {
        if ($qty <= 0) {
            return '<span class="badge bg-danger">Out of Stock</span>';
        } elseif ($qty <= 10) {
            return '<span class="badge bg-warning text-dark">Low Stock</span>';
        }

        return '<span class="badge bg-success">Available</span>';
    }
}
