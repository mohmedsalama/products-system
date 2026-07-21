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

    public function allMessages(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Message::with('sender')->latest();

        if ($request->has('conversation_id')) {
            $query->where('conversation_id', $request->conversation_id);
        }

        if ($request->has('sender_id')) {
            $query->where('sender_id', $request->sender_id);
        }

        return response()->json([
            'success' => true,
            'data'    => $query->get()
        ]);
    }

    public function attachments(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Message::whereNotNull('attachment')
            ->with('sender')
            ->latest();

        if ($request->has('conversation_id')) {
            $query->where('conversation_id', $request->conversation_id);
        }

        if ($request->has('type')) {
            $query->where('attachment_type', $request->type);
        }

        $attachments = $query->get()->map(function ($msg) {
            return [
                'id'              => $msg->id,
                'conversation_id' => $msg->conversation_id,
                'sender_id'       => $msg->sender_id,
                'sender_name'     => $msg->sender ? $msg->sender->name : null,
                'message'         => $msg->message,
                'attachment'      => $msg->attachment,
                'attachment_type' => $msg->attachment_type,
                'file_url'        => asset('storage/' . $msg->attachment),
                'created_at'      => $msg->created_at,
            ];
        });

        return response()->json([
            'success' => true,
            'count'   => $attachments->count(),
            'data'    => $attachments,
        ]);
    }

    public function store(StoreMessageRequest $request)
    {
        $message = $this->messageService->store(
            $request->validated(),
            $request->file('attachment')
        );

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }
}