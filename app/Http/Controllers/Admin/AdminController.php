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
        // dd(Hash::make('admin123'));
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

    public function updateAdmin(Request $request, $id)
    {
        $getdata = User::findOrFail($id);
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $getdata->update([
            'fill_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Profile Updated SuccessFul');
    }

    public function admin_password(Request $request, $id)
    {
        $getdata = User::findOrFail($id);
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $getdata->update([
            'password' => $request->password,
        ]);

        return back()->with('success', 'Password Updated SuccessFul');

    }
}
