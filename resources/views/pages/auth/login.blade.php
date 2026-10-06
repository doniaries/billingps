<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — {{ config('app.name', 'StarterKit') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #04080f;
            color: #f1f5f9;
            position: relative;
            overflow: hidden;
        }

        .bg-orb {
            position: fixed; border-radius: 50%;
            filter: blur(130px); pointer-events: none; z-index: 0;
        }
        .orb-1 { width: 650px; height: 650px; background: rgba(37,99,235,0.18); top: -200px; left: -150px; animation: drift 10s ease-in-out infinite; }
        .orb-2 { width: 500px; height: 500px; background: rgba(14,165,233,0.13); bottom: -150px; right: -100px; animation: drift 14s ease-in-out infinite reverse; }

        .grid-bg {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(37,99,235,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37,99,235,0.05) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        @keyframes drift {
            0%, 100% { transform: translate(0,0) scale(1); }
            50% { transform: translate(25px,-25px) scale(1.05); }
        }

        /* ─── Card ─── */
        .card {
            position: relative; z-index: 10;
            width: 100%; max-width: 440px;
            margin: 1rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 24px;
            padding: 2.75rem 2.5rem;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 32px 64px rgba(0,0,0,0.55), inset 0 1px 0 rgba(255,255,255,0.07);
        }

        .card-header { text-align: center; margin-bottom: 2rem; }

        .icon-wrap {
            width: 58px; height: 58px; border-radius: 17px;
            background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
            box-shadow: 0 0 32px rgba(29,78,216,0.5);
        }

        .card-title { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.035em; color: #fff; margin-bottom: 0.35rem; }
        .card-subtitle { font-size: 0.875rem; color: #94a3b8; }

        /* ─── Form ─── */
        .form { display: flex; flex-direction: column; gap: 1.25rem; }
        .field { display: flex; flex-direction: column; gap: 0.4rem; }
        .field-header { display: flex; justify-content: space-between; align-items: center; }

        label { font-size: 0.85rem; font-weight: 500; color: #cbd5e1; }

        .forgot-link { font-size: 0.8rem; color: #60a5fa; text-decoration: none; transition: color 0.2s; }
        .forgot-link:hover { color: #93c5fd; }

        /* ─── Input ─── */
        .input-wrap { position: relative; }

        .input-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 18px; height: 18px; color: #64748b; pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 0.8rem 3rem 0.8rem 2.75rem;
            border-radius: 12px;
            background: rgba(0,0,0,0.4);
            border: 1px solid rgba(255,255,255,0.09);
            color: #f1f5f9;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .input-wrap input:focus {
            border-color: rgba(37,99,235,0.6);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.18);
            background: rgba(0,0,0,0.55);
        }

        /* input tanpa icon kanan (email) — reset padding kanan */
        .input-wrap.no-toggle input { padding-right: 1rem; }

        input::placeholder { color: #475569; }

        /* ─── Toggle eye button ─── */
        .toggle-eye {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: #64748b; padding: 4px; display: flex; align-items: center;
            transition: color 0.2s; border-radius: 6px;
        }
        .toggle-eye:hover { color: #60a5fa; }
        .toggle-eye svg { width: 18px; height: 18px; }

        .error-msg { font-size: 0.8rem; color: #f87171; margin-top: 0.2rem; }

        /* ─── Remember ─── */
        .remember { display: flex; align-items: center; gap: 0.6rem; margin-top: 0.25rem; }
        .remember input[type="checkbox"] {
            width: 16px; height: 16px; padding: 0;
            border-radius: 4px; accent-color: #2563eb; flex-shrink: 0;
        }
        .remember label { font-size: 0.85rem; color: #94a3b8; font-weight: 400; }

        /* ─── Submit ─── */
        .btn-submit {
            width: 100%; padding: 0.9rem;
            border-radius: 12px; border: none;
            background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
            color: #fff; font-size: 0.95rem; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            box-shadow: 0 8px 25px rgba(29,78,216,0.38), inset 0 1px 0 rgba(255,255,255,0.18);
            margin-top: 0.5rem;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 14px 35px rgba(29,78,216,0.55); }
        .btn-submit:active { transform: translateY(0); }
        .btn-arrow { transition: transform 0.2s; }
        .btn-submit:hover .btn-arrow { transform: translateX(5px); }

        /* ─── Footer ─── */
        .card-footer {
            margin-top: 1.75rem; padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.07);
            text-align: center; font-size: 0.875rem; color: #64748b;
        }
        .card-footer a { color: #60a5fa; text-decoration: none; font-weight: 600; transition: color 0.2s; }
        .card-footer a:hover { color: #fff; }

        .alert-success {
            background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.25);
            color: #6ee7b7; padding: 0.75rem 1rem; border-radius: 10px;
            font-size: 0.85rem; text-align: center; margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="card">
        <div class="card-header">
            <div class="icon-wrap" style="{{ \App\Models\Setting::first()?->logo ? 'background: transparent; box-shadow: none;' : '' }}">
                @if(\App\Models\Setting::first()?->logo)
                    <img src="{{ asset('storage/' . \App\Models\Setting::first()->logo) }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; border-radius: 17px;">
                @else
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                @endif
            </div>
            <h1 class="card-title">{{ \App\Models\Setting::first()?->rental_name ?? 'Welcome Back' }}</h1>
            <p class="card-subtitle">Masuk ke dashboard Anda</p>
        </div>

        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="form">
            @csrf

            {{-- Email --}}
            <div class="field">
                <label for="email">Email Address</label>
                <div class="input-wrap no-toggle">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@contoh.com" required autofocus autocomplete="username">
                </div>
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div class="field">
                <div class="field-header">
                    <label for="password">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                    @endif
                </div>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                    <button type="button" class="toggle-eye" onclick="togglePassword('password', this)" aria-label="Toggle password visibility">
                        <svg id="eye-icon-password" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Remember Me --}}
            <div class="remember">
                <input id="remember" name="remember" type="checkbox">
                <label for="remember">Ingat saya selama 30 hari</label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">
                Masuk
                <svg class="btn-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>

        @if (Route::has('register'))
            <div class="card-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        @endif
    </div>

    <script>
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            // Swap icon
            btn.innerHTML = isPassword
                ? `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                   </svg>`
                : `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                   </svg>`;
        }
    </script>
</body>
</html>
