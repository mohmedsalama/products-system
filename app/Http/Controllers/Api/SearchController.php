<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Global search: search messages across ALL conversations.
     * GET /api/chat/search?q=keyword&limit=20
     */
    public function globalSearch(Request $request)
    {
        $request->validate([
            'q'     => 'required|string|min:1|max:255',
            'limit' => 'sometimes|integer|min:1|max:100',
        ]);

        $keyword = $request->q;
        $limit   = $request->get('limit', 20);

        $messages = Message::with(['sender', 'conversation'])
            ->where('message', 'LIKE', "%{$keyword}%")
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn ($msg) => [
                'id'              => $msg->id,
                'message'         => $msg->message,
                'sender_id'       => $msg->sender_id,
                'conversation_id' => $msg->conversation_id,
                'created_at'      => $msg->created_at->toISOString(),
                'sender'          => [
                    'id'   => $msg->sender->id,
                    'name' => $msg->sender->name,
                ],
                'conversation'    => [
                    'id' => $msg->conversation->id,
                ],
            ]);

        return response()->json([
            'success' => true,
            'query'   => $keyword,
            'count'   => $messages->count(),
            'data'    => $messages,
        ]);
    }

    /**
     * Conversation search: search messages within a SPECIFIC conversation.
     * GET /api/chat/conversations/{conversation}/search?q=keyword&limit=20
     */
    public function conversationSearch(Request $request, Conversation $conversation)
    {
        $request->validate([
            'q'     => 'required|string|min:1|max:255',
            'limit' => 'sometimes|integer|min:1|max:100',
        ]);

        $keyword = $request->q;
        $limit   = $request->get('limit', 20);

        $messages = $conversation->messages()
            ->with('sender')
            ->where('message', 'LIKE', "%{$keyword}%")
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn ($msg) => [
                'id'              => $msg->id,
                'message'         => $msg->message,
                'sender_id'       => $msg->sender_id,
                'conversation_id' => $msg->conversation_id,
                'created_at'      => $msg->created_at->toISOString(),
                'sender'          => [
                    'id'   => $msg->sender->id,
                    'name' => $msg->sender->name,
                ],
            ]);

        return response()->json([
            'success'         => true,
            'query'           => $keyword,
            'conversation_id' => $conversation->id,
            'count'           => $messages->count(),
            'data'            => $messages,
        ]);
    }
}
