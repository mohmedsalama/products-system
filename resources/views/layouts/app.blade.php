<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="نظام إدارة المهام - تنظيم وتتبع مهامك بكفاءة">
    <title>@yield('title', 'نظام إدارة المهام')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0a0e1a;
            --bg-card: #111827;
            --bg-hover: #1a2235;
            --border: #1e2d45;
            --accent: #6366f1;
            --accent-light: #818cf8;
            --accent-glow: rgba(99,102,241,0.25);
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #475569;
            --success: #10b981;
            --success-bg: rgba(16,185,129,0.1);
            --warning: #f59e0b;
            --warning-bg: rgba(245,158,11,0.1);
            --danger: #ef4444;
            --danger-bg: rgba(239,68,68,0.1);
            --pending-color: #f59e0b;
            --completed-color: #10b981;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow: 0 4px 24px rgba(0,0,0,0.4);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse at 20% 10%, rgba(99,102,241,0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(16,185,129,0.05) 0%, transparent 50%);
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(17,24,39,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-primary);
        }
        .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ===== CONTAINER ===== */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), #7c3aed);
            color: white;
            box-shadow: 0 4px 15px var(--accent-glow);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99,102,241,0.4);
        }
        .btn-success {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16,185,129,0.25);
        }
        .btn-success:hover { transform: translateY(-1px); }
        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid rgba(239,68,68,0.25);
        }
        .btn-danger:hover { background: var(--danger); color: white; }
        .btn-secondary {
            background: var(--bg-hover);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover { color: var(--text-primary); border-color: var(--accent); }
        .btn-warning {
            background: var(--warning-bg);
            color: var(--warning);
            border: 1px solid rgba(245,158,11,0.25);
        }
        .btn-warning:hover { background: var(--warning); color: #111; }
        .btn-sm { padding: 6px 12px; font-size: 0.8rem; }
        .btn-lg { padding: 12px 28px; font-size: 1rem; }

        /* ===== CARDS ===== */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success { background: var(--success-bg); color: var(--success); border: 1px solid rgba(16,185,129,0.2); }
        .alert-danger { background: var(--danger-bg); color: var(--danger); border: 1px solid rgba(239,68,68,0.2); }

        /* ===== BADGES ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
        }
        .badge-pending {
            background: var(--warning-bg);
            color: var(--warning);
            border: 1px solid rgba(245,158,11,0.2);
        }
        .badge-completed {
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid rgba(16,185,129,0.2);
        }
        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            animation: pulse 2s infinite;
        }
        .badge-completed .badge-dot { animation: none; }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        /* ===== FORMS ===== */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }
        .form-label span { color: var(--danger); }
        .form-control {
            width: 100%;
            background: var(--bg-dark);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 11px 14px;
            color: var(--text-primary);
            font-family: inherit;
            font-size: 0.92rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .form-control::placeholder { color: var(--text-muted); }
        select.form-control { cursor: pointer; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-error {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .is-invalid { border-color: var(--danger) !important; }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .page-title {
            font-size: 1.6rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-primary), var(--accent-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .page-subtitle { color: var(--text-muted); font-size: 0.88rem; margin-top: 3px; }

        /* ===== STATS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: transform 0.2s, border-color 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); border-color: var(--accent); }
        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .stat-icon-total { background: rgba(99,102,241,0.15); }
        .stat-icon-pending { background: var(--warning-bg); }
        .stat-icon-completed { background: var(--success-bg); }
        .stat-value { font-size: 1.6rem; font-weight: 700; line-height: 1; }
        .stat-label { font-size: 0.8rem; color: var(--text-muted); margin-top: 3px; }

        /* ===== FILTER TABS ===== */
        .filter-tabs {
            display: flex;
            gap: 6px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 5px;
            margin-bottom: 1.25rem;
            width: fit-content;
        }
        .filter-tab {
            padding: 7px 16px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-secondary);
            transition: all 0.2s;
        }
        .filter-tab:hover { color: var(--text-primary); }
        .filter-tab.active {
            background: var(--accent);
            color: white;
            box-shadow: 0 3px 10px var(--accent-glow);
        }

        /* ===== TASK TABLE ===== */
        .table-wrap {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 13px 18px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            background: var(--bg-dark);
            white-space: nowrap;
        }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--bg-hover); }
        tbody td { padding: 14px 18px; font-size: 0.9rem; vertical-align: middle; }
        .task-title { font-weight: 500; color: var(--text-primary); }
        .task-desc { color: var(--text-muted); font-size: 0.82rem; margin-top: 3px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 280px; }
        .user-cell { display: flex; align-items: center; gap: 8px; }
        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }
        .actions-cell { display: flex; gap: 6px; }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }
        .empty-icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.5; }
        .empty-text { font-size: 1rem; margin-bottom: 0.5rem; color: var(--text-secondary); }

        /* ===== FORM PAGE ===== */
        .form-page-wrap {
            max-width: 680px;
            margin: 0 auto;
        }
        .form-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .form-card-header {
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--border);
            background: var(--bg-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-card-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: var(--accent-glow);
            border: 1px solid rgba(99,102,241,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .form-card-title { font-size: 1rem; font-weight: 600; }
        .form-card-body { padding: 1.75rem; }
        .form-card-footer {
            padding: 1rem 1.75rem;
            border-top: 1px solid var(--border);
            background: var(--bg-dark);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* ===== SHOW PAGE ===== */
        .detail-row {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; }
        .detail-value { font-size: 0.95rem; color: var(--text-primary); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container { padding: 1rem; }
            .page-header { flex-direction: column; align-items: flex-start; }
            table { font-size: 0.82rem; }
            tbody td { padding: 10px 12px; }
            thead th { padding: 10px 12px; }
            .task-desc { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('tasks.index') }}" class="navbar-brand" id="nav-brand">
                <div class="brand-icon">✓</div>
                <span class="brand-name">Task Manager</span>
            </a>
            <div class="navbar-actions">
                <a href="{{ route('users.index') }}" class="btn btn-secondary" id="btn-nav-users"
                   style="{{ request()->is('users*') ? 'border-color: var(--accent); color: var(--accent-light)' : '' }}">
                    👥 المستخدمون
                </a>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary" id="btn-new-task">
                    <span>+</span> مهمة جديدة
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success" id="alert-success">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" id="alert-error">
                <span>✕</span> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        // Auto dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.style.transition = 'opacity 0.4s, transform 0.4s';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-8px)';
                setTimeout(() => el.remove(), 400);
            });
        }, 3500);
    </script>
    @stack('scripts')
</body>
</html>
