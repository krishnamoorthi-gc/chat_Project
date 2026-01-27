<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt login using name or email
        $user = \App\Models\User::where('email', $request->email)
            ->orWhere('name', $request->email)
            ->first();

        if ($user && \Hash::check($request->password, $user->password)) {
            if (!$user->is_admin) {
                return back()->withErrors(['email' => 'Access denied.']);
            }
            if (!$user->is_active) {
                return back()->withErrors(['email' => 'Your account is disabled.']);
            }
            
            auth()->login($user, $request->remember);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }}
