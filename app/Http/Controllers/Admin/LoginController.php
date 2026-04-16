<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $loginUser = Auth::user();
            if ($loginUser->role->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                echo 'User DashBoard';
            }

        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function store(Request $request)
    {

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('admin@1275'),
        ]);

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin');
    }
}
