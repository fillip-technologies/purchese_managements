<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManageController extends Controller
{
    public function UserLog()
    {
        return view('users.login.signin');
    }

    public function UserLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            $loginUser = Auth::guard('user')->user();

            if ($loginUser->role->role === 'user') {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('user.log');
            }

        } else {
            return back()->with('error', 'Invalid credentials')->withInput();
        }
    }

     public function Userlogout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/app/user/log');
    }
}
