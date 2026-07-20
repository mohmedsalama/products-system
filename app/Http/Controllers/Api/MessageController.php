<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Conversation;
use App\Services\MessageService;

class MessageController extends Controller
{
    public function __construct(
        protected MessageService $messageService
    ) {}

    public function index(Conversation $conversation)
    {
        return response()->json([
            'success' => true,
            'data' => $this->messageService->index($conversation)
        ]);
    }

    public function store(StoreMessageRequest $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $this->messageService->store($request->validated())
        ], 201);
    }
}