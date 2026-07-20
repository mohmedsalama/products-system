<?php

use App\Models\User;
use App\Models\Conversation;
use App\Services\ConversationService;
use App\Services\MessageService;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Chat API Local Testing ---\n";

// 1. Check existing users
$users = User::all();
echo "Users in DB: " . $users->count() . "\n";
foreach ($users as $u) {
    echo " - ID {$u->id}: {$u->name} ({$u->email})\n";
}

if ($users->count() < 2) {
    echo "Error: Need at least 2 users to test.\n";
    exit(1);
}

$user1 = $users[0];
$user2 = $users[1];

echo "\n--- 2. Creating Conversation between ID {$user1->id} and ID {$user2->id} ---\n";
$convoService = app(ConversationService::class);
$conversation = $convoService->create([
    'users' => [$user2->id],
]);
// Simulating request current_user_id for testing
request()->merge(['current_user_id' => $user1->id]);

// Re-run create with request populated
$conversation = $convoService->create([
    'users' => [$user2->id]
]);

echo "Created Conversation ID: {$conversation->id}\n";
echo "Participants:\n";
foreach ($conversation->users as $u) {
    echo " - {$u->name}\n";
}

echo "\n--- 3. Sending Message ---\n";
$msgService = app(MessageService::class);
$message = $msgService->store([
    'conversation_id' => $conversation->id,
    'sender_id'       => $user1->id,
    'message'         => 'Hello! This is a test message from ' . $user1->name
]);

echo "Message Sent!\n";
echo "Message ID: {$message->id}\n";
echo "From: {$message->sender->name}\n";
echo "Content: {$message->message}\n";

echo "\n--- 4. Listing Messages for Conversation ---\n";
$messages = $msgService->index($conversation);
foreach ($messages as $msg) {
    echo " - [{$msg->created_at}] {$msg->sender->name}: {$msg->message}\n";
}

echo "\n--- All basic functionality is working! ---\n";
