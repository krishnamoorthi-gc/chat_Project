<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;
use App\Models\KnowledgeSource;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch counts for the dashboard
        try {
            $totalChatbots = Chatbot::count();
            $totalKnowledgeSources = KnowledgeSource::count();
            $activeChatbots = Chatbot::where('created_at', '>=', now()->subDays(30))->count(); 
            $totalMessages = 0; 
            $totalLeads = Lead::count();
        } catch (\Exception $e) {
            $totalChatbots = 0;
            $totalKnowledgeSources = 0;
            $activeChatbots = 0;
            $totalMessages = 0;
            $totalLeads = 0;
        }

        return view('dashboard', compact('totalChatbots', 'totalKnowledgeSources', 'activeChatbots', 'totalMessages', 'totalLeads'));
    }
}
