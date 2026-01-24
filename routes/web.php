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
    
    Route::post('/knowledge/upload', [App\Http\Controllers\KnowledgeController::class, 'upload'])->name('knowledge.upload');
    Route::post('/knowledge/crawl', [App\Http\Controllers\KnowledgeController::class, 'crawl'])->name('knowledge.crawl');
    Route::post('/knowledge/store-text', [App\Http\Controllers\KnowledgeController::class, 'storeText'])->name('knowledge.storeText');
    Route::post('/knowledge/store-qa', [App\Http\Controllers\KnowledgeController::class, 'storeQA'])->name('knowledge.storeQA');
    Route::post('/knowledge/{source}/retry', [App\Http\Controllers\KnowledgeController::class, 'retry'])->name('knowledge.retry');
    Route::delete('/knowledge/{knowledgeSource}', [App\Http\Controllers\KnowledgeController::class, 'destroy'])->name('knowledge.destroy');
    
    Route::get('/help', function() {
        return view('help.index');
    })->name('help');
});

// Public Chat Routes
Route::get('/chat/{chatbot}/widget', function (\App\Models\Chatbot $chatbot) {
    return view('chat.widget', compact('chatbot'));
})->name('chat.widget');

Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'send'])->name('chat.send');


