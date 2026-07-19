@extends('layouts.app')
@section('title', 'إدارة المهام')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">إدارة المهام</h1>
        <p class="page-subtitle">عرض وإدارة جميع مهامك من مكان واحد</p>
    </div>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg" id="btn-create-task">
        <span>+</span> إنشاء مهمة جديدة
    </a>
</div>


{{-- Stats --}}
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon stat-icon-total">📋</div>
        <div>
            <div class="stat-value">{{ $pendingCount + $completedCount }}</div>
            <div class="stat-label">إجمالي المهام</div>
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-icon stat-icon-pending">⏳</div>
        <div>
            <div class="stat-value" style="color: var(--warning)">
                {{ $pendingCount }}
            </div>
            <div class="stat-label">معلقة</div>
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-icon stat-icon-completed">✅</div>
        <div>
            <div class="stat-value" style="color: var(--success)">
                {{ $completedCount }}
            </div>
            <div class="stat-label">مكتملة</div>
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-icon stat-icon-total">👥</div>
        <div>
            <div class="stat-value">{{ $userCount }}</div>
            <div class="stat-label">المستخدمون</div>
        </div>
    </div>

</div>




{{-- Filter Tabs --}}
<div class="filter-tabs">

    <a href="{{ route('tasks.index') }}"
       class="filter-tab {{ $filter === 'all' ? 'active' : '' }}"
       id="filter-all">
        الكل
    </a>


    <a href="{{ route('tasks.index', ['filter' => 'pending']) }}"
       class="filter-tab {{ $filter === 'pending' ? 'active' : '' }}"
       id="filter-pending">
        معلقة
    </a>


    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}"
       class="filter-tab {{ $filter === 'completed' ? 'active' : '' }}"
       id="filter-completed">
        مكتملة
    </a>

</div>




{{-- Tasks Table --}}
<div class="table-wrap">

    @if($tasks->count() == 0)

        <div class="empty-state">

            <div class="empty-icon">📭</div>

            <p class="empty-text">
                لا توجد مهام حالياً
            </p>

            <p style="font-size:0.85rem; margin-bottom:1.25rem">
                ابدأ بإنشاء أول مهمة لك
            </p>

            <a href="{{ route('tasks.create') }}"
               class="btn btn-primary"
               id="btn-empty-create">
                + إنشاء مهمة
            </a>

        </div>


    @else


        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>المسؤول</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>

            </thead>



            <tbody>

            @foreach($tasks as $task)

                <tr id="task-row-{{ $task->id }}">

                    <td style="color: var(--text-muted); font-size: 0.82rem;">
                        #{{ $task->id }}
                    </td>


                    <td>

                        <div class="task-title">
                            {{ $task->title }}
                        </div>


                        @if($task->description)

                            <div class="task-desc">
                                {{ $task->description }}
                            </div>

                        @endif

                    </td>



                    <td>

                        @if($task->status === 'pending')

                            <span class="badge badge-pending">
                                <span class="badge-dot"></span>
                                Pending
                            </span>

                        @else

                            <span class="badge badge-completed">
                                <span class="badge-dot"></span>
                                Completed
                            </span>

                        @endif

                    </td>




                    <td>

                        <div class="user-cell">

                            <div class="user-avatar">
                                {{ mb_substr($task->user->name ?? '?', 0, 1) }}
                            </div>


                            <span>
                                {{ $task->user->name ?? 'غير محدد' }}
                            </span>

                        </div>

                    </td>



                    <td style="color: var(--text-muted); font-size: 0.83rem;">

                        {{ $task->created_at->format('Y/m/d') }}

                    </td>



                    <td>

                        <div class="actions-cell">


                            <a href="{{ route('tasks.show', $task) }}"
                               class="btn btn-secondary btn-sm"
                               id="btn-show-{{ $task->id }}"
                               title="عرض">
                                👁
                            </a>



                            <a href="{{ route('tasks.edit', $task) }}"
                               class="btn btn-warning btn-sm"
                               id="btn-edit-{{ $task->id }}"
                               title="تعديل">
                                ✏️
                            </a>




                            <form action="{{ route('tasks.destroy', $task) }}"
                                  method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">

                                @csrf
                                @method('DELETE')


                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        id="btn-delete-{{ $task->id }}"
                                        title="حذف">
                                    🗑
                                </button>


                            </form>


                        </div>

                    </td>


                </tr>


            @endforeach


            </tbody>

        </table>


    @endif


</div>



{{-- Pagination --}}
@if($tasks->hasPages())

    <div class="mt-4">

        {{ $tasks->links() }}

    </div>

@endif


@endsection