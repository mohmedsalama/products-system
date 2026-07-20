<?php

namespace App\Services;

use App\Models\Conversation;
use Illuminate\Support\Facades\DB;

class ConversationService
{
    public function create(array $data): Conversation
    {
        return DB::transaction(function () use ($data) {

            $conversation = Conversation::create();

            $users = $data['users'];

            $currentUserId = request('current_user_id') ?? auth()->id();
            if ($currentUserId) {
                $users[] = $currentUserId;
            }

            $users = array_unique($users);

            $conversation->users()->attach($users);

            return $conversation->load('users');
        });
    }

    public function index()
    {
        $userId = request('user_id') ?? auth()->id();

        if ($userId) {
            $user = \App\Models\User::find($userId);
            if ($user) {
                return $user->conversations()
                    ->with('users')
                    ->latest()
                    ->get();
            }
        }

        return Conversation::with('users')
            ->latest()
            ->get();
    }

    public function show(Conversation $conversation)
    {
        return $conversation->load([
            'users',
            'messages.sender'
        ]);
    }
}