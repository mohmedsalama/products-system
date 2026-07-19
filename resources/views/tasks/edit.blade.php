@extends('layouts.app')
@section('title', 'تعديل المهمة')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">تعديل المهمة</h1>
        <p class="page-subtitle">#{{ $task->id }} — {{ Str::limit($task->title, 40) }}</p>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary" id="btn-back">← رجوع للقائمة</a>
</div>

<div class="form-page-wrap">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">✏️</div>
            <div class="form-card-title">تعديل بيانات المهمة</div>
        </div>

        <form action="{{ route('tasks.update', $task) }}" method="POST" id="form-edit-task">
            @csrf
            @method('PUT')
            <div class="form-card-body">

                {{-- Title --}}
                <div class="form-group">
                    <label class="form-label" for="title">العنوان <span>*</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="أدخل عنوان المهمة (10 أحرف على الأقل)"
                        value="{{ old('title', $task->title) }}"
                        autocomplete="off"
                    >
                    @error('title')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label class="form-label" for="description">الوصف</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="وصف تفصيلي للمهمة (اختياري)"
                        rows="4"
                    >{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label class="form-label" for="status">الحالة <span>*</span></label>
                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                    </select>
                    @error('status')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- User --}}
                <div class="form-group" style="margin-bottom: 0">
                    <label class="form-label" for="user_id">المسؤول عن المهمة <span>*</span></label>
                    <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="form-card-footer">
                <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary" id="btn-cancel">إلغاء</a>
                <button type="submit" class="btn btn-success" id="btn-submit-edit">
                    ✓ حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
