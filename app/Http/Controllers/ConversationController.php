<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::with(['chatbot', 'lead', 'messages' => function($q) {
            $q->latest()->limit(1);
        }])
        ->orderBy('last_message_at', 'desc')
        ->paginate(20);

        return view('conversations.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        $conversation->load(['chatbot', 'lead', 'messages' => function($q) {
            $q->orderBy('created_at', 'asc');
        }]);

        return view('conversations.show', compact('conversation'));
    }

    public function reply(Request $request, Conversation $conversation)
    {
        $request->validate([
            'message' => 'required_without:file|string|nullable',
            'file' => 'nullable|file|max:10240', // 10MB
        ]);

        $filePath = null;
        $fileType = null;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('chat_files', 'public');
            $filePath = Storage::url($path);
            $fileType = $request->file('file')->getClientOriginalExtension() ?: $request->file('file')->extension();
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender' => 'admin',
            'message' => $request->message,
            'file_path' => $filePath,
            'file_type' => $fileType,
        ]);

        $conversation->touch('last_message_at');

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }

    public function toggleStatus(Conversation $conversation)
    {
        $conversation->status = $conversation->status === 'human' ? 'active' : 'human';
        $conversation->save();

        return response()->json(['status' => $conversation->status]);
    }

    public function toggleContactForm(Conversation $conversation)
    {
        $conversation->contact_form_enabled = !$conversation->contact_form_enabled;
        $conversation->save();

        return response()->json(['contact_form_enabled' => $conversation->contact_form_enabled]);
    }

    public function getUpdates(Conversation $conversation)
    {
        $lastMessageId = request('last_message_id');
        $messages = $conversation->messages()
            ->where('id', '>', $lastMessageId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages
        ]);
    }
}
