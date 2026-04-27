<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function users()
    {
        return view('admin.mastersetup.users.createUser');
    }

    public function vendors()
    {
        return view('admin.mastersetup.vendors.addVendor');
    }

    public function clients()
    {
        return view('admin.mastersetup.clients.addClient');
    }

    public function add_product()
    {
        return view('admin.mastersetup.products.addProduct');
    }

    public function vendor_product()
    {
        return view('admin.mastersetup.products.venderProducts');
    }

    public function admin_login()
    {
        return view('admin.login.signin');
    }

    public function admin_profile()
    {
        $user = Auth::guard('admin')->user() ?? null;

        return view('admin.profile.profile', compact('user'));
    }
}
