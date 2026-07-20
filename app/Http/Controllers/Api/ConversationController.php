<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversationRequest;
use App\Models\Conversation;
use App\Services\ConversationService;

class ConversationController extends Controller
{
    public function __construct(
        protected ConversationService $conversationService
    ) {}

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->conversationService->index()
        ]);
    }

    public function store(StoreConversationRequest $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Conversation created successfully',
            'data' => $this->conversationService->create(
                $request->validated()
            )
        ],201);
    }

    public function show(Conversation $conversation)
    {
        return response()->json([
            'success'=>true,
            'data'=>$this->conversationService->show($conversation)
        ]);
    }
}