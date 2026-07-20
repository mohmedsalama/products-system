<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UserPresenceController;
use App\Http\Controllers\Api\SearchController;

Route::prefix('chat')->group(function () {

    // Conversations
    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::post('/conversations', [ConversationController::class, 'store']);
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show']);

    // Messages
    Route::get('/conversations/{conversation}/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);

    // Search
    Route::get('/search', [SearchController::class, 'globalSearch']);                              // Global
    Route::get('/conversations/{conversation}/search', [SearchController::class, 'conversationSearch']); // Per conversation

    // Presence (Online/Offline)
    Route::get('/users/online', [UserPresenceController::class, 'onlineUsers']);
    Route::post('/presence/online', [UserPresenceController::class, 'setOnline']);
    Route::post('/presence/offline', [UserPresenceController::class, 'setOffline']);

});