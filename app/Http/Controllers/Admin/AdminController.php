<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = \App\Models\User::where('is_admin', false)->count();
        $totalBots = \App\Models\Chatbot::count();
        $recentUsers = \App\Models\User::where('is_admin', false)->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalUsers', 'totalBots', 'recentUsers'));
    }

    public function users()
    {
        $users = \App\Models\User::where('is_admin', false)->withCount('chatbots')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus(\App\Models\User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        
        return back()->with('success', 'User status updated successfully.');
    }

    public function updatePlan(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'plan_type' => 'required|string|in:free,pro,enterprise',
        ]);

        $user->plan_type = $request->plan_type;
        $user->save();

        return back()->with('success', 'User plan updated successfully.');
    }

    public function showUserBots(\App\Models\User $user)
    {
        $chatbots = $user->chatbots()->withCount('leads')->get();
        return view('admin.users.bots', compact('user', 'chatbots'));
    }}
