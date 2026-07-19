@extends('layouts.app')
@section('title', 'إدارة المستخدمين')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">المستخدمون</h1>
        <p class="page-subtitle">إدارة مستخدمي النظام</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg" id="btn-add-user">
        <span>+</span> إضافة مستخدم
    </a>
</div>

{{-- Stats --}}
<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); margin-bottom: 1.75rem">
    <div class="stat-card">
        <div class="stat-icon stat-icon-total">👥</div>
        <div>
            <div class="stat-value">{{ $users->count() }}</div>
            <div class="stat-label">إجمالي المستخدمين</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-completed">📋</div>
        <div>
            <div class="stat-value" style="color: var(--accent-light)">{{ $users->sum('tasks_count') }}</div>
            <div class="stat-label">إجمالي المهام المسندة</div>
        </div>
    </div>
</div>

{{-- Users Table --}}
<div class="table-wrap">
    @if($users->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">👤</div>
            <p class="empty-text">لا يوجد مستخدمون حتى الآن</p>
            <p style="font-size:0.85rem; margin-bottom:1.25rem">أضف أول مستخدم للنظام</p>
            <a href="{{ route('users.create') }}" class="btn btn-primary" id="btn-empty-add">+ إضافة مستخدم</a>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>المستخدم</th>
                    <th>البريد الإلكتروني</th>
                    <th>عدد المهام</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr id="user-row-{{ $user->id }}">
                    <td style="color: var(--text-muted); font-size: 0.82rem;">#{{ $user->id }}</td>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar" style="width:36px; height:36px; font-size: 0.9rem">
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>
                            <span style="font-weight: 500">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td style="color: var(--text-secondary)">{{ $user->email }}</td>
                    <td>
                        @if($user->tasks_count > 0)
                            <span class="badge" style="background: rgba(99,102,241,0.15); color: var(--accent-light); border: 1px solid rgba(99,102,241,0.2)">
                                {{ $user->tasks_count }} مهمة
                            </span>
                        @else
                            <span style="color: var(--text-muted); font-size: 0.85rem">لا توجد مهام</span>
                        @endif
                    </td>
                    <td style="color: var(--text-muted); font-size: 0.83rem;">{{ $user->created_at->format('Y/m/d') }}</td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('tasks.index') }}?user={{ $user->id }}" class="btn btn-secondary btn-sm" id="btn-user-tasks-{{ $user->id }}" title="مهامه">📋</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟ سيتم حذف مهامه أيضاً!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" id="btn-delete-user-{{ $user->id }}" title="حذف">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
