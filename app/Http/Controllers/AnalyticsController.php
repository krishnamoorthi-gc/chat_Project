<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Gather some basic stats
        $totalConversations = Conversation::count();
        $totalMessages = Message::count();
        $totalLeads = Lead::count();
        
        // Get conversations per day for the last 7 days
        $conversationsChart = Conversation::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        // Get messages per day
        $messagesChart = Message::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('analytics.index', compact('totalConversations', 'totalMessages', 'totalLeads', 'conversationsChart', 'messagesChart'));
    }
}
