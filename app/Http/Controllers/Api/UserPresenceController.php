<?php

namespace App\Http\Controllers\Api;

use App\Events\UserStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserPresenceController extends Controller
{
    // TTL for online status: 60 seconds (heartbeat must refresh it)
    private const ONLINE_TTL = 60;

    /**
     * Mark a user as online and broadcast the status change.
     */
    public function setOnline(Request $request)
    {
        $request->validate(['user_id' => 'required|integer|exists:users,id']);

        $userId = $request->user_id;
        $user   = User::find($userId);

        $wasOnline = Cache::has("online_user_{$userId}");

        // Refresh/set the online key with TTL
        Cache::put("online_user_{$userId}", [
            'id'   => $user->id,
            'name' => $user->name,
        ], now()->addSeconds(self::ONLINE_TTL));

        // Broadcast only when status actually changes (was offline, now online)
        if (! $wasOnline) {
            broadcast(new UserStatusChanged($user->id, $user->name, 'online'));
        }

        return response()->json([
            'success' => true,
            'status'  => 'online',
            'user_id' => $userId,
        ]);
    }

    /**
     * Mark a user as offline and broadcast the status change.
     */
    public function setOffline(Request $request)
    {
        $request->validate(['user_id' => 'required|integer|exists:users,id']);

        $userId = $request->user_id;
        $user   = User::find($userId);

        $wasOnline = Cache::has("online_user_{$userId}");
        Cache::forget("online_user_{$userId}");

        if ($wasOnline) {
            broadcast(new UserStatusChanged($user->id, $user->name, 'offline'));
        }

        return response()->json([
            'success' => true,
            'status'  => 'offline',
            'user_id' => $userId,
        ]);
    }

    /**
     * Return users status list (supports ?status=online / offline / all).
     */
    public function onlineUsers(Request $request)
    {
        $statusFilter = $request->query('status');

        $users = User::all()->map(function ($user) {
            $isOnline = Cache::has("online_user_{$user->id}");
            return [
                'id'        => $user->id,
                'name'      => $user->name,
                'is_online' => $isOnline,
                'status'    => $isOnline ? 'online' : 'offline',
            ];
        });

        if ($statusFilter === 'online') {
            $users = $users->filter(fn($u) => $u['is_online'])->values();
        } elseif ($statusFilter === 'offline') {
            $users = $users->filter(fn($u) => ! $u['is_online'])->values();
        }

        return response()->json([
            'success' => true,
            'data'    => $users,
        ]);
    }
}
