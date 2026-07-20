<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Conversation;

class MessageService
{
    public function index(Conversation $conversation)
    {
        return $conversation->messages()
            ->with('sender')
            ->latest()
            ->get();
    }

    public function store(array $data): Message
    {
        $message = Message::create([
            'conversation_id' => $data['conversation_id'],
            'sender_id'       => $data['sender_id'],
            'message'         => $data['message'],
        ]);

        $message->load('sender');

        broadcast(new \App\Events\MessageSent($message));

        return $message;
    }
}