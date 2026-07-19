@extends('layouts.app')
@section('title', 'إضافة مستخدم جديد')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">إضافة مستخدم جديد</h1>
        <p class="page-subtitle">أنشئ حساب مستخدم جديد في النظام</p>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-secondary" id="btn-back">← رجوع للمستخدمين</a>
</div>

<div class="form-page-wrap">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">👤</div>
            <div class="form-card-title">بيانات المستخدم</div>
        </div>

        <form action="{{ route('users.store') }}" method="POST" id="form-create-user">
            @csrf
            <div class="form-card-body">

                {{-- Name --}}
                <div class="form-group">
                    <label class="form-label" for="name">الاسم <span>*</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="أدخل اسم المستخدم (3 أحرف على الأقل)"
                        value="{{ old('name') }}"
                        autocomplete="off"
                    >
                    @error('name')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">البريد الإلكتروني <span>*</span></label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="example@email.com"
                        value="{{ old('email') }}"
                        autocomplete="off"
                    >
                    @error('email')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">كلمة المرور <span>*</span></label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="8 أحرف على الأقل"
                    >
                    @error('password')
                        <div class="form-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Password Confirmation --}}
                <div class="form-group" style="margin-bottom: 0">
                    <label class="form-label" for="password_confirmation">تأكيد كلمة المرور <span>*</span></label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="أعد كتابة كلمة المرور"
                    >
                </div>

            </div>
            <div class="form-card-footer">
                <a href="{{ route('users.index') }}" class="btn btn-secondary" id="btn-cancel">إلغاء</a>
                <button type="submit" class="btn btn-primary" id="btn-submit-user">
                    <span>+</span> إضافة المستخدم
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
