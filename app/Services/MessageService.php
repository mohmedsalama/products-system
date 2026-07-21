<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\UploadedFile;

class MessageService
{
    public function index(Conversation $conversation)
    {
        return $conversation->messages()
            ->with('sender')
            ->latest()
            ->get();
    }

    public function store(array $data, ?UploadedFile $file = null): Message
    {
        $attachmentPath = null;
        $attachmentType = null;

        if ($file) {
            // حفظ الملف في storage/app/public/chat-attachments
            $attachmentPath = $file->store('chat-attachments', 'public');
            
            $mime         = strtolower($file->getMimeType() ?? '');
            $extension    = strtolower($file->getClientOriginalExtension());
            $originalName = strtolower($file->getClientOriginalName());

            // التسجيلات الصوتية في المتصفح تكون بصيغة webm ويدرجها المتصفح كـ video/webm أحياناً
            // لذلك نفحص الصوت/الفويس أولاً قبل الفيديو
            if (
                str_starts_with($mime, 'audio/') ||
                str_contains($originalName, 'voice_') ||
                in_array($extension, ['mp3', 'wav', 'ogg', 'm4a', 'aac', '3gp', 'amr'])
            ) {
                $attachmentType = 'voice';
            } elseif (str_starts_with($mime, 'image/')) {
                $attachmentType = 'image';
            } elseif (str_starts_with($mime, 'video/')) {
                $attachmentType = 'video';
            } else {
                $attachmentType = 'file';
            }
        }

        $messageText = (isset($data['message']) && trim($data['message']) !== '') ? trim($data['message']) : null;

        $message = Message::create([
            'conversation_id' => $data['conversation_id'],
            'sender_id'       => $data['sender_id'],
            'message'         => $messageText,
            'attachment'      => $attachmentPath,
            'attachment_type' => $attachmentType,
        ]);

        $message->load('sender');

        broadcast(new \App\Events\MessageSent($message));

        return $message;
    }
}