<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | College Management Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            position: relative;
            z-index: 1;
        }

        .brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            border-radius: 12px;
            background: #6366f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .brand h2 {
            font-size: 20px;
            font-weight: 800;
            color: #1e293b;
        }

        .brand p {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .role-row {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .role-btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            text-align: center;
            background: #fff;
            transition: all 0.2s;
        }

        .role-btn i {
            display: block;
            font-size: 18px;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .role-btn span {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
        }

        .role-btn.active {
            border-color: #6366f1;
            background: #f5f3ff;
        }

        .role-btn.active i,
        .role-btn.active span {
            color: #6366f1;
        }

        .field {
            margin-bottom: 16px;
            position: relative;
        }

        .field i.icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .field input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            color: #1e293b;
            background: #ffffff;
            outline: none;
            transition: all 0.2s;
        }

        .field input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
        }

        .row-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .row-between label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            cursor: pointer;
        }

        .row-between label input {
            width: 15px;
            height: 15px;
            accent-color: #6366f1;
        }

        .row-between a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #6366f1;
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: #4f46e5;
        }

        .footer-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #64748b;
        }

        .footer-link a {
            color: #6366f1;
            font-weight: 700;
            text-decoration: none;
        }

        .error-msg {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
        }

        .copyright {
            text-align: center;
            margin-top: 32px;
            font-size: 12px;
            color: #94a3b8;
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
            padding: 0.35rem 0.75rem;
            font-size: 0.65rem;
            font-weight: 800;
            cursor: pointer;
            letter-spacing: 0.05em;
            transition: background 0.15s;
            flex-shrink: 0;
        }
        .cred-copy-btn:hover { background: #4338ca; }
    </style>
</head>

<body>
    <div>
        <div class="login-card">
            <div class="brand">
                <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <h2>College Management Portal</h2>
                <p> </p>
            </div>

            @if (session('status'))
                <div
                    style="padding: 12px 16px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; color: #059669; font-size: 13px; font-weight: 500; margin-bottom: 20px;">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <p
                    style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                    Sign in as</p>
                <div class="role-row">
                    <div class="role-btn active" onclick="selectRole('teacher')"><i
                            class="bi bi-person-badge"></i><span>Teacher</span></div>
                    <div class="role-btn" onclick="selectRole('student')"><i
                            class="bi bi-person-video3"></i><span>Student</span></div>
                </div>
                <input type="hidden" name="role" id="roleInput" value="teacher">

                <div class="field">
                    <i class="bi bi-envelope icon"></i>
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required
                        autofocus>
                </div>
                @error('email') <p class="error-msg">{{ $message }}</p>
                @enderror

                <div class="field">
                    <i class="bi bi-shield-lock icon"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                @error('password') <p class="error-msg">{{ $message }}</p>
                @enderror

                <div class="row-between">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">Log In</button>

                <div class="footer-link">
                    Don't have an account? <a href="{{ route('register') }}">Create Account</a>
                </div>
            </form>
        </div>
        <div class="copyright">&copy; 2026 College Management Portal. All rights reserved.</div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('roleInput').value = role;
            document.querySelectorAll('.role-btn').forEach(c => c.classList.remove('active'));
            Array.from(document.querySelectorAll('.role-btn')).find(c => c.innerText.toLowerCase().includes(role))?.classList.add('active');
        }
        function useCreds(email, role) {
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="password"]').value = 'password123';
            selectRole(role);
            document.getElementById('credModal').classList.remove('open');
        }
    </script>

    <!-- ================================================================
         DEMO CREDENTIALS — Floating Badge (always visible)
         ================================================================ -->
    <button class="demo-badge" onclick="document.getElementById('credModal').classList.add('open')" aria-label="View demo login credentials">
        <div style="display:flex;align-items:center;gap:12px;">
            <div style="width:36px;height:36px;background:rgba(255,255,255,0.15);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-key-fill" style="font-size:18px;"></i>
            </div>
            <div style="text-align:left;">
                <div style="font-size:9px;font-weight:900;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.65)">Quick Access</div>
                <div style="font-size:13px;font-weight:800;line-height:1.1">Demo Credentials</div>
            </div>
            <i class="bi bi-arrow-right-circle-fill" style="color:#a5b4fc;font-size:18px;margin-left:4px;"></i>
        </div>
    </button>

    <!-- ================================================================
         DEMO CREDENTIALS MODAL
         ================================================================ -->
    <div id="credModal" class="cred-modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
        <div class="cred-modal">
            <!-- Header -->
            <div style="display:flex;align-items:center;justify-content:between;margin-bottom:24px;width:100%;">
                <div style="flex-1:1 0 auto;">
                    <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 12px;background:#f5f3ff;color:#6366f1;border-radius:100px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:1px;border:1px solid #e0e7ff;margin-bottom:8px;">
                        <span style="width:6px;height:6px;background:#6366f1;border-radius:100px;" class="animate-pulse"></span> Auto-Fill Enabled
                    </div>
                    <h2 style="font-size:24px;font-weight:900;color:#1e293b;letter-spacing:-0.5px;">Select an Account</h2>
                    <p style="color:#94a3b8;font-size:12px;font-weight:600;margin-top:2px;">Click any account to automatically fill in details</p>
                </div>
                <button onclick="document.getElementById('credModal').classList.remove('open')" style="width:40px;height:40px;border-radius:100px;background:#f1f5f9;border:none;cursor:pointer;color:#64748b;display:flex;align-items:center;justify-content:center;margin-left:auto;">
                    <i class="bi bi-x-lg" style="font-size:16px;"></i>
                </button>
            </div>

            <!-- Password Info -->
            <div style="display:flex;align-items:center;gap:12px;background:#ecfdf5;border:1px solid #a7f3d0;border-radius:12px;padding:12px 16px;margin-bottom:20px;">
                <i class="bi bi-lock-fill" style="color:#059669;font-size:18px;"></i>
                <div>
                    <div style="font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#059669;">Universal Password</div>
                    <div style="font-size:16px;font-weight:900;color:#1f2937;">password123</div>
                </div>
            </div>

            <!-- Credentials List -->
            <div style="display:flex;flex-direction:column;gap:8px;max-height:360px;overflow-y:auto;padding-right:4px;">
                @php
                $creds = [
                    ['admin',       'bi-shield-fill',          '#4f46e5', '#ede9fe', 'Admin',        'admin@demo.com'],
                    ['hod',         'bi-person-badge-fill',    '#0891b2', '#e0f7fa', 'HOD',          'hod@demo.com'],
                    ['teacher',     'bi-mortarboard-fill',     '#d97706', '#fffbeb', 'Teacher',      'teacher1@demo.com'],
                    ['student',     'bi-person-fill',          '#059669', '#ecfdf5', 'Student',      'student1@demo.com'],
                    ['accountant',  'bi-calculator-fill',      '#7c3aed', '#f5f3ff', 'Accountant',   'accountant@demo.com'],
                ];
                @endphp
                @foreach($creds as [$role, $icon, $color, $bg, $label, $email])
                <div class="cred-row" onclick="useCreds('{{ $email }}', '{{ $role }}')" style="cursor:pointer;">
                    <div style="display:flex;align-items:center;gap:12px;min-width:0;">
                        <div style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:{{ $bg }};flex-shrink:0;">
                            <i class="bi {{ $icon }}" style="color:{{ $color }};font-size:16px;"></i>
                        </div>
                        <div style="min-width:0;text-align:left;">
                            <div class="cred-role" style="color:{{ $color }}">{{ $label }}</div>
                            <div style="font-size:13px;font-weight:700;color:#334155;" class="truncate">{{ $email }}</div>
                        </div>
                    </div>
                    <button class="cred-copy-btn" style="pointer-events:none;">Use Account</button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>