<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Check if status is 1 (optional check if you still use that column)
            if (Auth::guard('admin')->user()->status != 1) {
                Auth::guard('admin')->logout();
                return back()->with('error', 'Your account is inactive.');
            }

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
