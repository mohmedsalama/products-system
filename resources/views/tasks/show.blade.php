@extends('layouts.app')
@section('title', 'تفاصيل المهمة')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">تفاصيل المهمة</h1>
        <p class="page-subtitle">#{{ $task->id }} — {{ Str::limit($task->title, 50) }}</p>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary" id="btn-back">← رجوع للقائمة</a>
</div>

<div class="form-page-wrap">
    {{-- Task Detail Card --}}
    <div class="form-card" style="margin-bottom: 1rem">
        <div class="form-card-header">
            <div class="form-card-icon">📋</div>
            <div class="form-card-title">معلومات المهمة</div>
            <div style="margin-right: auto">
                @if($task->status === 'pending')
                    <span class="badge badge-pending"><span class="badge-dot"></span> Pending</span>
                @else
                    <span class="badge badge-completed"><span class="badge-dot"></span> Completed</span>
                @endif
            </div>
        </div>
        <div class="form-card-body">
            <div class="detail-row">
                <div class="detail-label">العنوان</div>
                <div class="detail-value" style="font-size: 1.1rem; font-weight: 600">{{ $task->title }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">الوصف</div>
                <div class="detail-value" style="color: var(--text-secondary); line-height: 1.6">
                    {{ $task->description ?? 'لا يوجد وصف' }}
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">المسؤول</div>
                <div class="detail-value">
                    <div class="user-cell" style="margin-top: 4px">
                        <div class="user-avatar" style="width:36px; height:36px; font-size: 0.9rem">
                            {{ mb_substr($task->user->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <div style="font-weight: 500">{{ $task->user->name ?? 'غير محدد' }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted)">{{ $task->user->email ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">تاريخ الإنشاء</div>
                <div class="detail-value">{{ $task->created_at->format('Y/m/d — H:i') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">آخر تحديث</div>
                <div class="detail-value">{{ $task->updated_at->format('Y/m/d — H:i') }}</div>
            </div>
        </div>
        <div class="form-card-footer">
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="margin-left: auto" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" id="btn-delete-{{ $task->id }}">🗑 حذف المهمة</button>
            </form>
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning" id="btn-edit-{{ $task->id }}">✏️ تعديل</a>
        </div>
    </div>
</div>
@endsection
