<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function index()
    {
        $chatbots = Chatbot::where('user_id', Auth::id())->withCount('knowledgeSources')->latest()->get();
        return view('chatbots.index', compact('chatbots'));
    }

    public function create()
    {
        return view('chatbots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $chatbot = Chatbot::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'settings' => [],
        ]);

        // Redirect to the "Train" page (show)
        return redirect()->route('chatbots.show', $chatbot)->with('success', 'Chatbot created successfully! Let\'s train it.');
    }

    public function show(Chatbot $chatbot)
    {
        if ($chatbot->user_id !== Auth::id()) {
            abort(403);
        }
        
        $chatbot->load('knowledgeSources');
        return view('chatbots.show', compact('chatbot'));
    }

    public function edit(Chatbot $chatbot)
    {
         if ($chatbot->user_id !== Auth::id()) {
            abort(403);
        }
        return view('chatbots.edit', compact('chatbot'));
    }

    public function update(Request $request, Chatbot $chatbot)
    {
        if ($chatbot->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'prompt_template' => 'nullable|string',
            'response_mode' => 'nullable|string|in:ai,direct',
            'branding' => 'nullable|array',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'prompt_template']);
        
        // Handle Settings Update
        $settings = $chatbot->settings ?? [];
        
        if ($request->has('response_mode')) {
            $settings['response_mode'] = $request->response_mode;
        }

        if ($request->has('branding')) {
            $settings['branding'] = array_merge($settings['branding'] ?? [], $request->branding);
        }

        // Handle Icon Upload
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists
            if (isset($settings['branding']['icon_url'])) {
                $oldPath = str_replace('/storage/', '', $settings['branding']['icon_url']);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }

            $iconPath = $request->file('icon')->store('chatbot_icons', 'public');
            $settings['branding']['icon_url'] = \Illuminate\Support\Facades\Storage::url($iconPath);
        }

        $chatbot->update(array_merge($data, ['settings' => $settings]));

        if ($request->ajax()) {
            return response()->json(['message' => 'Settings updated successfully.', 'chatbot' => $chatbot]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function destroy(Chatbot $chatbot)
    {
        if ($chatbot->user_id !== Auth::id()) {
            abort(403);
        }
        $chatbot->delete();
        return redirect()->route('chatbots.index')->with('success', 'Chatbot deleted.');
    }
}
