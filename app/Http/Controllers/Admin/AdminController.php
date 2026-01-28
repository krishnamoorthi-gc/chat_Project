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
        
        // Analytics
        $totalVisits = \App\Models\LandingPageVisit::count();
        $todayVisits = \App\Models\LandingPageVisit::whereDate('created_at', \Carbon\Carbon::today())->count();
        $visitsByDay = \App\Models\LandingPageVisit::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get()
            ->reverse();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalBots', 'recentUsers', 
            'totalVisits', 'todayVisits', 'visitsByDay'
        ));
    }

    public function pricing()
    {
        $plans = \App\Models\PricingPlan::latest()->get();
        return view('admin.pricing.index', compact('plans'));
    }

    public function storePricing(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'payment_url' => 'required|url',
        ]);

        $featuresString = $request->input('features_text') ?? '';
        $features = array_filter(array_map('trim', explode("\n", $featuresString)));

        \App\Models\PricingPlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'payment_url' => $request->payment_url,
            'description' => $request->description,
            'features' => $features,
            'billing_cycle' => $request->billing_cycle ?? 'monthly',
        ]);

        return back()->with('success', 'Pricing plan created successfully.');
    }

    public function updatePricing(Request $request, \App\Models\PricingPlan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'payment_url' => 'required|url',
        ]);

        $featuresString = $request->input('features_text') ?? '';
        $features = array_filter(array_map('trim', explode("\n", $featuresString)));

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'payment_url' => $request->payment_url,
            'description' => $request->description,
            'features' => $features,
            'billing_cycle' => $request->billing_cycle ?? 'monthly',
        ]);

        return back()->with('success', 'Pricing plan updated successfully.');
    }

    public function destroyPricing(\App\Models\PricingPlan $plan)
    {
        $plan->delete();
        return back()->with('success', 'Pricing plan deleted successfully.');
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
