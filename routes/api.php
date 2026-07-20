<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;



Route::prefix('chat')->group(function () {

    // Conversations
    Route::get('/conversations', [ConversationController::class, 'index']);

    Route::post('/conversations', [ConversationController::class, 'store']);

    Route::get('/conversations/{conversation}', [ConversationController::class, 'show']);

    // Messages
    Route::get('/conversations/{conversation}/messages', [MessageController::class, 'index']);

    Route::post('/messages', [MessageController::class, 'store']);

});