<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $plans = \App\Models\PricingPlan::where('is_active', true)->get();
    return view('welcome', compact('plans'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', [App\Http\Controllers\DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::get('/analytics', [App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics');
    
    // Settings Routes
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/update', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/password', [App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password');
    
    Route::resource('chatbots', App\Http\Controllers\ChatbotController::class);
    Route::get('/leads/export', [App\Http\Controllers\LeadController::class, 'export'])->name('leads.export');
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
    Route::post('/conversations/{conversation}/toggle-contact-form', [App\Http\Controllers\ConversationController::class, 'toggleContactForm'])->name('conversations.toggleContactForm');
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

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users.index');
        Route::post('/users/{user}/toggle-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::post('/users/{user}/update-plan', [App\Http\Controllers\Admin\AdminController::class, 'updatePlan'])->name('users.update-plan');
        Route::get('/users/{user}/bots', [App\Http\Controllers\Admin\AdminController::class, 'showUserBots'])->name('users.bots');
        
        // Pricing Management
        Route::get('/pricing', [App\Http\Controllers\Admin\AdminController::class, 'pricing'])->name('pricing.index');
        Route::post('/pricing', [App\Http\Controllers\Admin\AdminController::class, 'storePricing'])->name('pricing.store');
        Route::post('/pricing/{plan}', [App\Http\Controllers\Admin\AdminController::class, 'updatePricing'])->name('pricing.update');
        Route::delete('/pricing/{plan}', [App\Http\Controllers\Admin\AdminController::class, 'destroyPricing'])->name('pricing.destroy');

        // Analytics
        Route::get('/stats', [App\Http\Controllers\Admin\AdminAnalyticsController::class, 'stats'])->name('stats');
    });
});
