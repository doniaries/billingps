<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — {{ config('app.name', 'StarterKit') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: #04080f;
            color: #f1f5f9;
            position: relative;
            overflow: hidden;
            padding: 2rem 1rem;
        }

        .bg-orb { position: fixed; border-radius: 50%; filter: blur(130px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 600px; height: 600px; background: rgba(37,99,235,0.17); top: -200px; right: -150px; animation: drift 11s ease-in-out infinite; }
        .orb-2 { width: 500px; height: 500px; background: rgba(14,165,233,0.13); bottom: -150px; left: -100px; animation: drift 14s ease-in-out infinite reverse; }
        .grid-bg {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image: linear-gradient(rgba(37,99,235,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(37,99,235,0.05) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        @keyframes drift { 0%, 100% { transform: translate(0,0) scale(1); } 50% { transform: translate(25px,-25px) scale(1.05); } }

        /* ─── Card ─── */
        .card {
            position: relative; z-index: 10;
            width: 100%; max-width: 460px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 24px;
            padding: 2.5rem 2.25rem;
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 32px 64px rgba(0,0,0,0.55), inset 0 1px 0 rgba(255,255,255,0.07);
        }

        .card-header { text-align: center; margin-bottom: 1.75rem; }

        .icon-wrap {
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 0 30px rgba(29,78,216,0.5);
        }

        .card-title { font-size: 1.65rem; font-weight: 800; letter-spacing: -0.03em; color: #fff; margin-bottom: 0.3rem; }
        .card-subtitle { font-size: 0.875rem; color: #94a3b8; }

        /* ─── Form ─── */
        .form { display: flex; flex-direction: column; gap: 1.1rem; }
        .field { display: flex; flex-direction: column; gap: 0.35rem; }

        label { font-size: 0.83rem; font-weight: 500; color: #cbd5e1; }

        /* ─── Input Wrapper ─── */
        .input-wrap { position: relative; }

        .input-icon {
            position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
            width: 17px; height: 17px; color: #64748b; pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 0.78rem 3rem 0.78rem 2.6rem;
            border-radius: 11px;
            background: rgba(0,0,0,0.4);
            border: 1.5px solid rgba(255,255,255,0.09);
            color: #f1f5f9;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .input-wrap.no-toggle input { padding-right: 1rem; }

        .input-wrap input:focus {
            border-color: rgba(37,99,235,0.65);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.18);
            background: rgba(0,0,0,0.55);
        }

        /* Valid state */
        .input-wrap input.is-valid {
            border-color: rgba(16,185,129,0.6);
        }
        /* Invalid state */
        .input-wrap input.is-invalid {
            border-color: rgba(239,68,68,0.6);
            box-shadow: 0 0 0 3px rgba(239,68,68,0.12);
        }

        input::placeholder { color: #475569; }

        /* ─── Eye toggle ─── */
        .toggle-eye {
            position: absolute; right: 11px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: #64748b; padding: 4px;
            display: flex; align-items: center; justify-content: center;
            transition: color 0.2s; border-radius: 6px; line-height: 0;
        }
        .toggle-eye:hover { color: #60a5fa; }
        .toggle-eye svg { width: 17px; height: 17px; display: block; }

        /* ─── Validation messages ─── */
        .error-msg {
            font-size: 0.78rem; color: #f87171;
            display: flex; align-items: center; gap: 0.3rem;
            margin-top: 0.15rem;
        }
        .error-msg svg { width: 13px; height: 13px; flex-shrink: 0; }

        .success-msg {
            font-size: 0.78rem; color: #34d399;
            display: flex; align-items: center; gap: 0.3rem;
            margin-top: 0.15rem;
        }
        .success-msg svg { width: 13px; height: 13px; flex-shrink: 0; }

        /* Laravel server-side error */
        .server-error { font-size: 0.78rem; color: #f87171; margin-top: 0.15rem; }

        /* ─── Password Strength Bar ─── */
        .strength-wrap { margin-top: 0.5rem; }
        .strength-bar { display: flex; gap: 4px; margin-bottom: 0.3rem; }
        .strength-bar span {
            flex: 1; height: 3px; border-radius: 2px;
            background: rgba(255,255,255,0.1);
            transition: background 0.3s;
        }
        .strength-label { font-size: 0.75rem; color: #64748b; }

        /* ─── Password rules hint ─── */
        .pw-rules { margin-top: 0.4rem; display: flex; flex-direction: column; gap: 0.2rem; }
        .pw-rule {
            font-size: 0.76rem; color: #64748b;
            display: flex; align-items: center; gap: 0.35rem;
            transition: color 0.2s;
        }
        .pw-rule.ok { color: #34d399; }
        .pw-rule svg { width: 12px; height: 12px; flex-shrink: 0; }

        /* ─── Submit ─── */
        .btn-submit {
            width: 100%; padding: 0.88rem;
            border-radius: 12px; border: none;
            background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
            color: #fff; font-size: 0.95rem; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            box-shadow: 0 8px 25px rgba(29,78,216,0.38), inset 0 1px 0 rgba(255,255,255,0.18);
            margin-top: 0.75rem;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 14px 35px rgba(29,78,216,0.55); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
        .btn-arrow { transition: transform 0.2s; }
        .btn-submit:hover:not(:disabled) .btn-arrow { transform: translateX(5px); }

        /* ─── Footer ─── */
        .card-footer {
            margin-top: 1.5rem; padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.07);
            text-align: center; font-size: 0.875rem; color: #64748b;
        }
        .card-footer a { color: #60a5fa; text-decoration: none; font-weight: 600; transition: color 0.2s; }
        .card-footer a:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="card">
        <div class="card-header">
            <div class="icon-wrap">
                <svg width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <h1 class="card-title">Buat Akun Baru</h1>
            <p class="card-subtitle">Isi data di bawah untuk mendaftar</p>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="form" id="registerForm" novalidate>
            @csrf

            {{-- Name --}}
            <div class="field">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrap no-toggle">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        placeholder="Nama lengkap Anda" required autofocus autocomplete="name"
                        oninput="validateName(this)">
                </div>
                <span id="name-msg" class="error-msg" style="display:none"></span>
                @error('name') <span class="server-error">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div class="field">
                <label for="email">Email Address</label>
                <div class="input-wrap no-toggle">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="nama@contoh.com" required autocomplete="email"
                        oninput="validateEmail(this)">
                </div>
                <span id="email-msg" class="error-msg" style="display:none"></span>
                @error('email') <span class="server-error">{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div class="field">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input id="password" type="password" name="password"
                        placeholder="Min. 8 karakter" required autocomplete="new-password"
                        oninput="validatePassword(this); checkConfirm()">
                    <button type="button" class="toggle-eye" onclick="togglePassword('password', this)" aria-label="Tampilkan password">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>

                {{-- Strength bar --}}
                <div class="strength-wrap" id="strength-wrap" style="display:none">
                    <div class="strength-bar">
                        <span id="s1"></span><span id="s2"></span><span id="s3"></span><span id="s4"></span>
                    </div>
                    <div class="strength-label" id="strength-label"></div>
                </div>

                {{-- Rules checklist --}}
                <div class="pw-rules" id="pw-rules" style="display:none">
                    <div class="pw-rule" id="r-len">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                        Minimal 8 karakter
                    </div>
                    <div class="pw-rule" id="r-upper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                        Mengandung huruf kapital
                    </div>
                    <div class="pw-rule" id="r-num">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                        Mengandung angka
                    </div>
                    <div class="pw-rule" id="r-sym">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                        Mengandung simbol (!@#$...)
                    </div>
                </div>

                @error('password') <span class="server-error">{{ $message }}</span> @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="field">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Ulangi password" required autocomplete="new-password"
                        oninput="checkConfirm()">
                    <button type="button" class="toggle-eye" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan konfirmasi password">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
                <span id="confirm-msg" class="error-msg" style="display:none"></span>
                @error('password_confirmation') <span class="server-error">{{ $message }}</span> @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit" id="submitBtn">
                Buat Akun
                <svg class="btn-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>

        <div class="card-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

    <script>
        /* ─── Icons ─── */
        const EYE_OPEN = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
        const EYE_OFF  = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;

        const ICON_OK  = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
        const ICON_ERR = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;
        const ICON_CIR = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>`;

        /* ─── Toggle eye ─── */
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const hidden = input.type === 'password';
            input.type = hidden ? 'text' : 'password';
            btn.innerHTML = hidden ? EYE_OFF : EYE_OPEN;
            btn.setAttribute('aria-label', hidden ? 'Sembunyikan password' : 'Tampilkan password');
            input.focus();
        }

        /* ─── Show / hide message ─── */
        function showError(id, msg) {
            const el = document.getElementById(id);
            el.innerHTML = ICON_ERR + msg;
            el.className = 'error-msg';
            el.style.display = 'flex';
        }
        function showSuccess(id, msg) {
            const el = document.getElementById(id);
            el.innerHTML = ICON_OK + msg;
            el.className = 'success-msg';
            el.style.display = 'flex';
        }
        function clearMsg(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'none';
        }

        /* ─── Validate Name ─── */
        function validateName(input) {
            const v = input.value.trim();
            if (v.length === 0) { clearMsg('name-msg'); input.classList.remove('is-valid','is-invalid'); return false; }
            if (v.length < 2) {
                showError('name-msg', 'Nama minimal 2 karakter');
                input.classList.add('is-invalid'); input.classList.remove('is-valid'); return false;
            }
            if (!/^[a-zA-Z\s'.]+$/.test(v)) {
                showError('name-msg', 'Nama hanya boleh huruf dan spasi');
                input.classList.add('is-invalid'); input.classList.remove('is-valid'); return false;
            }
            clearMsg('name-msg');
            input.classList.add('is-valid'); input.classList.remove('is-invalid'); return true;
        }

        /* ─── Validate Email ─── */
        function validateEmail(input) {
            const v = input.value.trim();
            if (v.length === 0) { clearMsg('email-msg'); input.classList.remove('is-valid','is-invalid'); return false; }
            const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
            if (!ok) {
                showError('email-msg', 'Format email tidak valid');
                input.classList.add('is-invalid'); input.classList.remove('is-valid'); return false;
            }
            clearMsg('email-msg');
            input.classList.add('is-valid'); input.classList.remove('is-invalid'); return true;
        }

        /* ─── Password strength ─── */
        const rules = {
            len:   v => v.length >= 8,
            upper: v => /[A-Z]/.test(v),
            num:   v => /[0-9]/.test(v),
            sym:   v => /[^a-zA-Z0-9]/.test(v),
        };

        const strengthColors = ['#ef4444','#f97316','#eab308','#22c55e'];
        const strengthLabels = ['Sangat lemah','Lemah','Sedang','Kuat'];

        function validatePassword(input) {
            const v = input.value;

            // Show / hide helper sections
            const showHelpers = v.length > 0;
            document.getElementById('strength-wrap').style.display = showHelpers ? 'block' : 'none';
            document.getElementById('pw-rules').style.display = showHelpers ? 'flex' : 'none';

            if (!showHelpers) { input.classList.remove('is-valid','is-invalid'); return false; }

            // Update rules UI
            const checks = { len: rules.len(v), upper: rules.upper(v), num: rules.num(v), sym: rules.sym(v) };
            ['len','upper','num','sym'].forEach(k => {
                const el = document.getElementById('r-' + k);
                el.classList.toggle('ok', checks[k]);
                el.innerHTML = (checks[k] ? ICON_OK : ICON_CIR) + ' ' + el.textContent.trim();
            });

            // Strength score
            const score = Object.values(checks).filter(Boolean).length;
            ['s1','s2','s3','s4'].forEach((id, i) => {
                document.getElementById(id).style.background = i < score ? strengthColors[score - 1] : 'rgba(255,255,255,0.1)';
            });
            document.getElementById('strength-label').textContent = 'Kekuatan: ' + strengthLabels[score - 1];

            const allOk = Object.values(checks).every(Boolean);
            input.classList.toggle('is-valid', allOk);
            input.classList.toggle('is-invalid', !allOk);
            return allOk;
        }

        /* ─── Confirm match ─── */
        function checkConfirm() {
            const pw  = document.getElementById('password').value;
            const cpw = document.getElementById('password_confirmation');
            const v   = cpw.value;
            if (v.length === 0) { clearMsg('confirm-msg'); cpw.classList.remove('is-valid','is-invalid'); return false; }
            if (pw !== v) {
                showError('confirm-msg', 'Password tidak cocok');
                cpw.classList.add('is-invalid'); cpw.classList.remove('is-valid'); return false;
            }
            showSuccess('confirm-msg', 'Password cocok');
            cpw.classList.add('is-valid'); cpw.classList.remove('is-invalid'); return true;
        }

        /* ─── Pre-submit full validation ─── */
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const n  = validateName(document.getElementById('name'));
            const em = validateEmail(document.getElementById('email'));
            const pw = validatePassword(document.getElementById('password'));
            const cp = checkConfirm();

            if (!n || !em || !pw || !cp) {
                e.preventDefault();
                // Scroll to first error
                document.querySelector('.is-invalid')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>
