<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Livewire Starter') }} — Modern Laravel Starter Kit</title>
    <meta name="description" content="Premium Laravel Livewire Starter Kit with Roles, Permissions, Activity Log, and more.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --indigo: #6366f1;
            --indigo-dark: #4f46e5;
            --purple: #a855f7;
            --pink: #ec4899;
            --bg: #020207;
            --surface: rgba(255,255,255,0.04);
            --border: rgba(255,255,255,0.08);
            --text: #f1f5f9;
            --muted: #94a3b8;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ─── Background ─── */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(99,102,241,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.06) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        .glow {
            position: fixed; border-radius: 50%; filter: blur(140px);
            pointer-events: none; z-index: 0;
        }
        .glow-1 { width: 700px; height: 700px; background: rgba(99,102,241,0.15); top: -200px; left: -200px; animation: float 8s ease-in-out infinite; }
        .glow-2 { width: 600px; height: 600px; background: rgba(168,85,247,0.12); bottom: -150px; right: -150px; animation: float 10s ease-in-out infinite reverse; }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        /* ─── Navbar ─── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 1.25rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(2,2,7,0.6);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        .logo {
            display: flex; align-items: center; gap: 0.75rem;
            text-decoration: none; color: var(--text);
        }

        .logo-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--indigo), var(--purple));
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 20px rgba(99,102,241,0.4);
        }

        .logo-text { font-size: 1.1rem; font-weight: 700; letter-spacing: -0.02em; }

        .nav-links { display: flex; align-items: center; gap: 0.75rem; }

        .btn-ghost {
            padding: 0.5rem 1.25rem; border-radius: 8px;
            font-size: 0.875rem; font-weight: 500; color: var(--muted);
            text-decoration: none; background: transparent;
            border: 1px solid transparent;
            transition: all 0.2s;
        }
        .btn-ghost:hover { color: var(--text); background: var(--surface); border-color: var(--border); }

        .btn-primary {
            padding: 0.5rem 1.25rem; border-radius: 8px;
            font-size: 0.875rem; font-weight: 600; color: #fff;
            text-decoration: none;
            background: linear-gradient(135deg, var(--indigo), var(--purple));
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(99,102,241,0.3);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 25px rgba(99,102,241,0.45); }

        /* ─── Hero ─── */
        .hero {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 8rem 2rem 4rem;
        }

        .badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.35rem 1rem; border-radius: 100px;
            background: rgba(99,102,241,0.1);
            border: 1px solid rgba(99,102,241,0.3);
            font-size: 0.78rem; font-weight: 500; color: #a5b4fc;
            margin-bottom: 2rem;
            animation: fadeInDown 0.6s ease-out;
        }

        .badge-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: #818cf8;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .hero-title {
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.05;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.7s ease-out 0.1s both;
        }

        .gradient-text {
            background: linear-gradient(135deg, #818cf8 0%, #c084fc 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            max-width: 580px;
            font-size: 1.15rem;
            color: var(--muted);
            margin-bottom: 3rem;
            line-height: 1.7;
            animation: fadeInUp 0.7s ease-out 0.2s both;
        }

        .hero-actions {
            display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;
            animation: fadeInUp 0.7s ease-out 0.3s both;
        }

        .btn-hero-primary {
            padding: 0.9rem 2.5rem; border-radius: 12px;
            font-size: 1rem; font-weight: 700; color: #fff;
            text-decoration: none;
            background: linear-gradient(135deg, var(--indigo), var(--purple));
            border: 1px solid rgba(255,255,255,0.15);
            transition: all 0.25s;
            box-shadow: 0 8px 32px rgba(99,102,241,0.35), inset 0 1px 0 rgba(255,255,255,0.2);
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(99,102,241,0.5); }

        .btn-hero-secondary {
            padding: 0.9rem 2.5rem; border-radius: 12px;
            font-size: 1rem; font-weight: 600; color: var(--text);
            text-decoration: none;
            background: var(--surface);
            border: 1px solid var(--border);
            backdrop-filter: blur(10px);
            transition: all 0.25s;
        }
        .btn-hero-secondary:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.15); transform: translateY(-1px); }

        /* ─── Stats ─── */
        .stats-bar {
            position: relative; z-index: 1;
            display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap;
            padding: 2.5rem 2rem;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            background: rgba(255,255,255,0.02);
        }

        .stat-item { text-align: center; }
        .stat-value { font-size: 2rem; font-weight: 800; letter-spacing: -0.03em; color: var(--text); }
        .stat-label { font-size: 0.82rem; color: var(--muted); margin-top: 0.15rem; }

        /* ─── Features ─── */
        .section { position: relative; z-index: 1; padding: 6rem 2rem; }
        .section-inner { max-width: 1100px; margin: 0 auto; }

        .section-label {
            font-size: 0.8rem; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: #818cf8;
            margin-bottom: 1rem; text-align: center;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.75rem);
            font-weight: 800; letter-spacing: -0.03em;
            text-align: center; margin-bottom: 1rem;
        }

        .section-sub {
            text-align: center; color: var(--muted);
            max-width: 520px; margin: 0 auto 4rem;
            font-size: 1.05rem; line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            padding: 2rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            transition: all 0.3s;
            position: relative; overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute; inset: 0; border-radius: 20px;
            background: linear-gradient(135deg, transparent, rgba(255,255,255,0.02));
            opacity: 0; transition: opacity 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(99,102,241,0.3);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .feature-card:hover::before { opacity: 1; }

        .feature-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
            font-size: 1.4rem;
        }

        .icon-indigo { background: rgba(99,102,241,0.15); }
        .icon-purple { background: rgba(168,85,247,0.15); }
        .icon-pink { background: rgba(236,72,153,0.15); }
        .icon-emerald { background: rgba(16,185,129,0.15); }
        .icon-amber { background: rgba(245,158,11,0.15); }
        .icon-sky { background: rgba(14,165,233,0.15); }

        .feature-title {
            font-size: 1.1rem; font-weight: 700;
            margin-bottom: 0.6rem; letter-spacing: -0.01em;
        }

        .feature-desc { color: var(--muted); font-size: 0.9rem; line-height: 1.65; }

        /* ─── Tech Stack ─── */
        .tech-section {
            position: relative; z-index: 1;
            padding: 4rem 2rem;
            text-align: center;
            border-top: 1px solid var(--border);
        }

        .tech-label { font-size: 0.8rem; color: var(--muted); letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 2rem; }

        .tech-list { display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap; }

        .tech-item {
            display: flex; align-items: center; gap: 0.6rem;
            color: var(--muted); font-size: 0.9rem; font-weight: 500;
            padding: 0.5rem 1.25rem; border-radius: 100px;
            background: var(--surface); border: 1px solid var(--border);
            transition: all 0.2s;
        }
        .tech-item:hover { color: var(--text); border-color: rgba(99,102,241,0.4); background: rgba(99,102,241,0.08); }

        /* ─── CTA ─── */
        .cta-section {
            position: relative; z-index: 1;
            padding: 6rem 2rem;
            text-align: center;
        }

        .cta-card {
            max-width: 680px; margin: 0 auto;
            padding: 4rem 3rem;
            background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(168,85,247,0.08));
            border: 1px solid rgba(99,102,241,0.25);
            border-radius: 28px;
            position: relative; overflow: hidden;
        }

        .cta-card::before {
            content: '';
            position: absolute; top: -60px; left: 50%; transform: translateX(-50%);
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(99,102,241,0.15), transparent 70%);
            pointer-events: none;
        }

        .cta-title { font-size: 2.25rem; font-weight: 800; letter-spacing: -0.03em; margin-bottom: 1rem; }
        .cta-sub { color: var(--muted); margin-bottom: 2.5rem; font-size: 1rem; }

        /* ─── Footer ─── */
        .footer {
            position: relative; z-index: 1;
            padding: 2rem;
            text-align: center;
            color: var(--muted);
            font-size: 0.85rem;
            border-top: 1px solid var(--border);
        }

        /* ─── Animations ─── */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: none; } }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-16px); } to { opacity: 1; transform: none; } }

        /* ─── Responsive ─── */
        @media (max-width: 640px) {
            .navbar { padding: 1rem; }
            .hero { padding: 7rem 1.25rem 3rem; }
            .stats-bar { gap: 2rem; }
            .cta-card { padding: 2.5rem 1.5rem; }
        }
    </style>
</head>
<body>

{{-- Background --}}
<div class="bg-grid"></div>
<div class="glow glow-1"></div>
<div class="glow glow-2"></div>

{{-- Navbar --}}
<nav class="navbar">
    <a href="/" class="logo">
        <div class="logo-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <span class="logo-text">{{ config('app.name', 'StarterKit') }}</span>
    </a>

    @if (Route::has('login'))
        <div class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard &rarr;</a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                @endif
            @endauth
        </div>
    @endif
</nav>

{{-- Hero --}}
<section class="hero">
    <div class="badge">
        <div class="badge-dot"></div>
        Laravel 12 · Livewire 4 · Ready to Deploy
    </div>

    <h1 class="hero-title">
        Build faster with<br>
        <span class="gradient-text">Premium Starter</span>
    </h1>

    <p class="hero-sub">
        Sebuah fondasi modern yang lengkap — authentication, roles, permissions, activity log, dan lebih banyak lagi. Langsung siap digunakan.
    </p>

    <div class="hero-actions">
        @auth
            <a href="{{ route('dashboard') }}" class="btn-hero-primary">Go to Dashboard &rarr;</a>
        @else
            <a href="{{ route('login') }}" class="btn-hero-primary">Mulai Sekarang &rarr;</a>
            <a href="#features" class="btn-hero-secondary">Lihat Fitur</a>
        @endauth
    </div>
</section>

{{-- Stats --}}
<div class="stats-bar">
    <div class="stat-item">
        <div class="stat-value" style="background: linear-gradient(135deg, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">6+</div>
        <div class="stat-label">Built-in Features</div>
    </div>
    <div class="stat-item">
        <div class="stat-value" style="background: linear-gradient(135deg, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">100%</div>
        <div class="stat-label">Livewire Powered</div>
    </div>
    <div class="stat-item">
        <div class="stat-value" style="background: linear-gradient(135deg, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">0</div>
        <div class="stat-label">Setup Headaches</div>
    </div>
    <div class="stat-item">
        <div class="stat-value" style="background: linear-gradient(135deg, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">∞</div>
        <div class="stat-label">Scalability</div>
    </div>
</div>

{{-- Features --}}
<section class="section" id="features">
    <div class="section-inner">
        <div class="section-label">Fitur Unggulan</div>
        <h2 class="section-title">Semua yang kamu butuhkan</h2>
        <p class="section-sub">Dari autentikasi hingga manajemen hak akses — semuanya sudah tersedia dan siap dikustomisasi.</p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon icon-indigo">🛡️</div>
                <h3 class="feature-title">Roles & Permissions</h3>
                <p class="feature-desc">Manajemen peran dan hak akses menggunakan Spatie Laravel Permission dengan UI Livewire yang intuitif.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-purple">👤</div>
                <h3 class="feature-title">Manajemen Profil</h3>
                <p class="feature-desc">Halaman profil interaktif dengan upload foto, update data diri, dan form ganti password.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-pink">📋</div>
                <h3 class="feature-title">Activity Log</h3>
                <p class="feature-desc">Catat setiap perubahan secara otomatis menggunakan Spatie Activity Log dengan tampilan tabel yang bersih.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-emerald">⚙️</div>
                <h3 class="feature-title">Global Settings</h3>
                <p class="feature-desc">Tabel pengaturan aplikasi yang bisa diubah secara dinamis melalui komponen Livewire.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-amber">🌙</div>
                <h3 class="feature-title">Dark / Light Mode</h3>
                <p class="feature-desc">Toggle tema gelap/terang menggunakan Alpine.js dengan preferensi tersimpan di localStorage.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-sky">📊</div>
                <h3 class="feature-title">Dashboard Statistik</h3>
                <p class="feature-desc">Komponen Livewire untuk menampilkan total user, aktivitas terbaru, dan KPI penting lainnya.</p>
            </div>
        </div>
    </div>
</section>

{{-- Tech Stack --}}
<div class="tech-section">
    <p class="tech-label">Tech Stack</p>
    <div class="tech-list">
        <div class="tech-item">⚡ Laravel 12</div>
        <div class="tech-item">🔴 Livewire 4</div>
        <div class="tech-item">🎨 Tailwind CSS</div>
        <div class="tech-item">🏔️ Alpine.js</div>
        <div class="tech-item">🛡️ Spatie Permission</div>
        <div class="tech-item">📝 Spatie Activity Log</div>
    </div>
</div>

{{-- CTA --}}
<section class="cta-section">
    <div class="cta-card">
        <h2 class="cta-title">Siap untuk memulai?</h2>
        <p class="cta-sub">Login dan mulai membangun aplikasimu dengan fondasi yang solid.</p>
        <div class="hero-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-hero-primary">Buka Dashboard &rarr;</a>
            @else
                <a href="{{ route('login') }}" class="btn-hero-primary">Login Sekarang &rarr;</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-hero-secondary">Daftar Akun</a>
                @endif
            @endauth
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Livewire Starter Kit') }}. Dibangun dengan ❤️ menggunakan Laravel & Livewire.</p>
</footer>

</body>
</html>
