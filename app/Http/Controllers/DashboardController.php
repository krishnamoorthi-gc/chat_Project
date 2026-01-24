<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;
use App\Models\KnowledgeSource;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch counts for the dashboard
        // Using 0 as default if models don't have records yet or tables aren't migrated fully
        try {
            $totalChatbots = Chatbot::count();
            $totalKnowledgeSources = KnowledgeSource::count();
            // Mocking some other data for the UI since we might not have 'active' flag or 'messages' yet
            $activeChatbots = Chatbot::where('created_at', '>=', now()->subDays(30))->count(); 
            $totalMessages = 0; // Placeholder for now
        } catch (\Exception $e) {
            $totalChatbots = 0;
            $totalKnowledgeSources = 0;
            $activeChatbots = 0;
            $totalMessages = 0;
        }

        return view('dashboard', compact('totalChatbots', 'totalKnowledgeSources', 'activeChatbots', 'totalMessages'));
    }
}
