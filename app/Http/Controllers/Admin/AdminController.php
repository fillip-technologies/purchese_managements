<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login_admin()
    {
        return view('admin.login.signin');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
