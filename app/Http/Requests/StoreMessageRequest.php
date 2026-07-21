<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conversation_id' => ['required', 'exists:conversations,id'],
            'sender_id'       => ['required', 'exists:users,id'],
            'message'         => ['nullable', 'string', 'max:5000'],
            // attachment: صور، فيديو، صوتیات (فويس)، مستندات وملفات بحد أقصى 25MB
            'attachment'      => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,webm,mp3,wav,ogg,m4a,aac,3gp,pdf,doc,docx,xls,xlsx,zip,rar,txt,csv,ppt,pptx',
                'max:25600'
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->message) && ! $this->hasFile('attachment')) {
                $validator->errors()->add('message', 'يجب إرسال نص أو ملف أو تسجيل صوتي على الأقل.');
            }
        });
    }
}