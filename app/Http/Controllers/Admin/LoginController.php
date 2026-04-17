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

    if (Auth::guard('admin')->attempt($credentials)) {

        $request->session()->regenerate();

        $loginUser = Auth::guard('admin')->user();

        if (optional($loginUser->role)->role === 'admin') {
            return redirect()->route('dashboard');
        }
        Auth::guard('admin')->logout();
        return back()->with('error', 'Unauthorized access');
    }

    return back()->with('error', 'Invalid credentials.');
}
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
