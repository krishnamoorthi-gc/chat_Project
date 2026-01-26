<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('chatbots', App\Http\Controllers\ChatbotController::class);
    Route::resource('leads', App\Http\Controllers\LeadController::class);
    
    Route::post('/knowledge/upload', [App\Http\Controllers\KnowledgeController::class, 'upload'])->name('knowledge.upload');
    Route::post('/knowledge/crawl', [App\Http\Controllers\KnowledgeController::class, 'crawl'])->name('knowledge.crawl');
    Route::post('/knowledge/store-text', [App\Http\Controllers\KnowledgeController::class, 'storeText'])->name('knowledge.storeText');
    Route::post('/knowledge/store-qa', [App\Http\Controllers\KnowledgeController::class, 'storeQA'])->name('knowledge.storeQA');
    Route::post('/knowledge/{source}/retry', [App\Http\Controllers\KnowledgeController::class, 'retry'])->name('knowledge.retry');
    Route::delete('/knowledge/{knowledgeSource}', [App\Http\Controllers\KnowledgeController::class, 'destroy'])->name('knowledge.destroy');
    
    Route::get('/help', function() {
        return view('help.index');
    })->name('help');

    // Conversations
    Route::get('/conversations', [App\Http\Controllers\ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/{conversation}', [App\Http\Controllers\ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{conversation}/reply', [App\Http\Controllers\ConversationController::class, 'reply'])->name('conversations.reply');
    Route::post('/conversations/{conversation}/toggle-status', [App\Http\Controllers\ConversationController::class, 'toggleStatus'])->name('conversations.toggle');
    Route::get('/conversations/{conversation}/updates', [App\Http\Controllers\ConversationController::class, 'getUpdates'])->name('conversations.updates');
});

// Public Chat Routes
Route::get('/chat/{chatbot}/widget', function (\App\Models\Chatbot $chatbot) {
    // Prioritize query parameter, then chatbot setting, then default
    if (!request()->has('lang') && isset($chatbot->settings['language'])) {
        app()->setLocale($chatbot->settings['language']);
    }
    return view('chat.widget', compact('chatbot'));
})->name('chat.widget');

Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'send'])->name('chat.send');
Route::post('/chat/lead', [App\Http\Controllers\ChatController::class, 'submitLead'])->name('chat.lead');
Route::get('/chat/updates', [App\Http\Controllers\ChatController::class, 'getWidgetUpdates'])->name('chat.updates');


