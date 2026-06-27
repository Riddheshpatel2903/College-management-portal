<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'College Management Portal') }} | Institutional Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --slate-bg: #f8fafc;
            --indigo-primary: #4f46e5;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--slate-bg);
            background-image:
                radial-gradient(at 100% 0%, rgba(79, 70, 229, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(79, 70, 229, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
        }

        .hero-title {
            font-size: 5rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.04em;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }
        }

        .action-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 2.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .action-card:hover {
            transform: translateY(-8px);
            border-color: #c7d2fe;
            box-shadow: 0 25px 50px -12px rgba(79, 70, 229, 0.1);
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }
        /* ---- Demo Credentials Card & Modal ---- */
        .demo-badge {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            color: white;
            border-radius: 1.5rem;
            padding: 1rem 1.5rem;
            cursor: pointer;
            box-shadow: 0 20px 60px rgba(79,70,229,0.45);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            animation: pulse-ring 3s ease infinite;
        }
        .demo-badge:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 28px 70px rgba(79,70,229,0.55);
        }
        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 20px 60px rgba(79,70,229,0.45); }
            50%       { box-shadow: 0 20px 70px rgba(99,102,241,0.65); }
        }
        .cred-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(15,10,40,0.75);
            backdrop-filter: blur(8px);
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .cred-modal-overlay.open { display: flex; }
        .cred-modal {
            background: white;
            border-radius: 2rem;
            padding: 2.5rem;
            max-width: 520px;
            width: 100%;
            box-shadow: 0 40px 100px rgba(0,0,0,0.25);
            animation: slideUp 0.35s cubic-bezier(0.34,1.56,0.64,1);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0)   scale(1); }
        }
        .cred-role { font-size: 0.6rem; font-weight: 900; letter-spacing: 0.15em; text-transform: uppercase; }
        .cred-row {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 0.9rem 1.1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            transition: background 0.15s;
        }
        .cred-row:hover { background: #eff6ff; border-color: #c7d2fe; }
        .cred-copy-btn {
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.3rem 0.65rem;
            font-size: 0.65rem;
            font-weight: 800;
            cursor: pointer;
            letter-spacing: 0.05em;
            transition: background 0.15s;
            flex-shrink: 0;
        }
        .cred-copy-btn:hover { background: #4338ca; }
        .cred-copy-btn.copied { background: #059669; }
    </style>
</head>

<body class="antialiased min-h-screen">
    <!-- Navigation -->
    <nav
        class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-100 px-8 py-5 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div
                class="w-11 h-11 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-slate-200">
                <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <span class="text-xl font-black tracking-tighter text-slate-800 uppercase">College Management Portal<span
                    class="text-indigo-600">Core</span></span>
        </div>

        <div class="flex items-center gap-8">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 hover:text-indigo-600 transition-colors">Personal
                        Workspace</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 hover:text-slate-900 transition-colors">Portal
                        Access</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Main Entry Context -->
    <main class="relative px-8 pt-24 pb-48 overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-24">
            <div class="lg:w-1/2 space-y-12">
                <div
                    class="inline-flex items-center gap-3 px-5 py-2.5 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-black uppercase tracking-[0.2em] border border-indigo-100">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                    </span>
                    Institutional Infrastructure v2.0
                </div>

                <h1 class="hero-title text-slate-900">
                    Elevating <br>
                    <span class="text-indigo-600">Academic</span> <br>
                    Governance.
                </h1>

                <p class="text-xl text-slate-500 font-medium max-w-lg leading-relaxed">
                    A streamlined management architecture designed for modern departments. Unify your instructional
                    faculty, students, and curriculum records.
                </p>

                <div class="flex flex-wrap items-center gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="h-16 px-12 bg-slate-900 text-white rounded-[1.25rem] text-xs font-black uppercase tracking-[0.2em] shadow-2xl shadow-slate-200 flex items-center transition-all hover:bg-black active:scale-95">
                            Enter Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="h-16 px-12 bg-indigo-600 text-white rounded-[1.25rem] text-xs font-black uppercase tracking-[0.2em] shadow-2xl shadow-indigo-200 flex items-center transition-all hover:bg-indigo-700 active:scale-95">
                            Institutional Login
                        </a>
                    @endauth
                    <div class="flex items-center gap-3 text-slate-400">
                        <span class="h-1 w-8 bg-slate-200"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest">Digital Registry Active</span>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 relative">
                <div class="action-card p-12 floating relative z-10 shadow-2xl shadow-slate-200">
                    <div class="grid grid-cols-2 gap-8">
                        <div
                            class="aspect-square rounded-[2rem] bg-indigo-50 flex flex-col items-center justify-center gap-4 text-indigo-600 p-8 border border-indigo-100">
                            <i class="bi bi-people-fill text-4xl"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Enrolled Users</span>
                            <span class="text-4xl font-black tracking-tighter">12.5k</span>
                        </div>
                        <div
                            class="aspect-square rounded-[2rem] bg-slate-900 flex flex-col items-center justify-center gap-4 text-white p-8">
                            <i class="bi bi-journal-check text-4xl text-indigo-400"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Active Modules</span>
                            <span class="text-4xl font-black tracking-tighter">482</span>
                        </div>
                        <div
                            class="aspect-square rounded-[2rem] bg-slate-50 flex flex-col items-center justify-center gap-4 text-slate-800 p-8 border border-slate-100">
                            <i class="bi bi-mortarboard-fill text-4xl text-indigo-600"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Faculty Staff</span>
                            <span class="text-4xl font-black tracking-tighter">1.2k</span>
                        </div>
                        <div
                            class="aspect-square rounded-[2rem] bg-indigo-600 flex flex-col items-center justify-center gap-4 text-white p-8">
                            <i class="bi bi-calendar-event text-4xl"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Live Sessions</span>
                            <span class="text-4xl font-black tracking-tighter">24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Operational Highlighting -->
    <section class="max-w-7xl mx-auto px-8 pb-48">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @foreach([
                    ['icon' => 'bi-diagram-3', 'title' => 'Structural Clarity', 'desc' => 'Organize departments, courses, and semesters with absolute instructional precision.'],
                    ['icon' => 'bi-calendar-range', 'title' => 'Dynamic Scheduling', 'desc' => 'Automated timetable generation optimized for faculty availability and room constraints.'],
                    ['icon' => 'bi-shield-check', 'title' => 'Secure Governance', 'desc' => 'Strict role-based access control protecting academic records across the entire institution.']
                ] as $feature)
                <div class="action-card p-12 space-y-8 flex flex-col">
                    <div class="w-16 h-16 bg-slate-50 text-indigo-600 rounded-3xl flex items-center justify-cente
                            r border border-slate-100 shadow-sm">
                        <i class="bi {{ $feature['icon'] }} text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none mb-4 uppercase">{{ $feature['title'] }}</h3>
                        <p class="text-slate-500 font-medium leading-relaxed italic text-sm">"{{ $feature['desc'] }}"</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Global Footer -->
    <footer class="max-w-7xl mx-auto px-8 py-20 border-t border-slate-100 text-center">
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-400">
            &copy; {{ date('Y') }} College Management Portal Core Systems. Operational Excellence Guaranteed.
        </p>
    </footer>
    <!-- ================================================================
         DEMO CREDENTIALS — Floating Badge (always visible)
         ================================================================ -->
    @guest
    <button class="demo-badge" onclick="document.getElementById('credModal').classList.add('open')" aria-label="View demo login credentials">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/15 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="bi bi-key-fill text-lg"></i>
            </div>
            <div>
                <div style="font-size:0.6rem;font-weight:900;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.65)">Demo Access</div>
                <div style="font-size:0.85rem;font-weight:800;line-height:1.1">View Login Credentials</div>
            </div>
            <i class="bi bi-arrow-right-circle-fill text-indigo-300 text-lg"></i>
        </div>
    </button>

    <!-- ================================================================
         DEMO CREDENTIALS MODAL
         ================================================================ -->
    <div id="credModal" class="cred-modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
        <div class="cred-modal">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-indigo-100 mb-2">
                        <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span> Live Demo
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Demo Credentials</h2>
                    <p class="text-slate-400 text-xs font-semibold mt-0.5">All accounts use the same password</p>
                </div>
                <button onclick="document.getElementById('credModal').classList.remove('open')" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-colors">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- Password badge -->
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 mb-5">
                <i class="bi bi-lock-fill text-emerald-600"></i>
                <div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Password for ALL accounts</div>
                    <div class="text-lg font-black text-slate-800 tracking-tight">password123</div>
                </div>
                <button class="cred-copy-btn ml-auto" onclick="copyText('password123', this)">Copy</button>
            </div>

            <!-- Credentials list -->
            <div class="space-y-2">
                @php
                $creds = [
                    ['admin',       'bi-shield-fill',          '#4f46e5', '#ede9fe', 'Admin',        'admin@demo.com'],
                    ['hod',         'bi-person-badge-fill',    '#0891b2', '#e0f7fa', 'HOD',          'hod@demo.com'],
                    ['teacher',     'bi-mortarboard-fill',     '#d97706', '#fffbeb', 'Teacher',      'teacher1@demo.com'],
                    ['teacher',     'bi-mortarboard-fill',     '#d97706', '#fffbeb', 'Teacher 2',    'teacher2@demo.com'],
                    ['student',     'bi-person-fill',          '#059669', '#ecfdf5', 'Student',      'student1@demo.com'],
                    ['student',     'bi-person-fill',          '#059669', '#ecfdf5', 'Student 2',    'student2@demo.com'],
                    ['accountant',  'bi-calculator-fill',      '#7c3aed', '#f5f3ff', 'Accountant',   'accountant@demo.com'],
                ];
                @endphp
                @foreach($creds as [$role, $icon, $color, $bg, $label, $email])
                <div class="cred-row">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background:{{ $bg }}">
                            <i class="bi {{ $icon }}" style="color:{{ $color }}"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="cred-role" style="color:{{ $color }}">{{ $label }}</div>
                            <div class="text-sm font-bold text-slate-700 truncate">{{ $email }}</div>
                        </div>
                    </div>
                    <button class="cred-copy-btn" onclick="copyText('{{ $email }}', this)">Copy</button>
                </div>
                @endforeach
            </div>

            <!-- Login button -->
            <a href="{{ route('login') }}" class="mt-6 flex items-center justify-center gap-2 h-12 w-full bg-slate-900 hover:bg-black text-white rounded-xl text-xs font-black uppercase tracking-[0.15em] transition-colors">
                <i class="bi bi-box-arrow-in-right"></i> Go to Login
            </a>
        </div>
    </div>

    <script>
    function copyText(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const original = btn.textContent;
            btn.textContent = '✓ Copied';
            btn.classList.add('copied');
            setTimeout(() => {
                btn.textContent = original;
                btn.classList.remove('copied');
            }, 1800);
        });
    }
    </script>
    @endguest

</body>

</html>