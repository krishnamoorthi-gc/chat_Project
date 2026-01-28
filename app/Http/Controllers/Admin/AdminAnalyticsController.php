<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAnalyticsController extends Controller
{
    public function stats()
    {
        return response()->json([
            'totalUsers' => \App\Models\User::where('is_admin', false)->count(),
            'totalBots' => \App\Models\Chatbot::count(),
            'totalVisits' => \App\Models\LandingPageVisit::count(),
            'todayVisits' => \App\Models\LandingPageVisit::whereDate('created_at', \Carbon\Carbon::today())->count(),
        ]);
    }}
