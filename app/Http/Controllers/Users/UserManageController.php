<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function profile()
    {
        $user = Auth::guard('user')->user();

        return view('users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('user')->user();

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('user')->user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = $request->new_password;
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}
