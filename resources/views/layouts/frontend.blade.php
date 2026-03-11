<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#1e3a8a" />
    <title>@yield('title', 'KOMBO - Komunitas Mahasiswa Bondowoso')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-kombo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        (function () {
            var savedTheme = localStorage.getItem('theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            var theme = savedTheme || (prefersDark ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    <style>
        :root {
            --primary: #1e3a8a;
            --primary-hover: #1d4ed8;
            --secondary: #10b981;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-light: #f3f7ff;
            --bg-card: #ffffff;
            --glass: rgba(255, 255, 255, 0.9);
            --border: rgba(30, 58, 138, 0.12);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }

        [data-theme='dark'] {
            --primary: #60a5fa;
            --primary-hover: #93c5fd;
            --secondary: #34d399;
            --text-dark: #e2e8f0;
            --text-muted: #94a3b8;
            --bg-light: #020617;
            --bg-card: #0f172a;
            --glass: rgba(15, 23, 42, 0.86);
            --border: rgba(148, 163, 184, 0.16);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; overflow-x: hidden; padding-top: 80px; transition: background-color 0.25s ease, color 0.25s ease; }
        html, body, * { -ms-overflow-style: none; scrollbar-width: none; }
        html::-webkit-scrollbar, body::-webkit-scrollbar, *::-webkit-scrollbar { width: 0; height: 0; display: none; }
        h1, h2, h3, h4, .logo-text { font-family: 'Outfit', sans-serif; }
        a { text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

        /* Navbar Custom Dropdown */
        header {
            position: fixed;
            top: 20px; left: 50%;
            transform: translateX(-50%);
            width: 92%;
            max-width: 1250px;
            height: 85px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 99px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 1000;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .logo { display: flex; align-items: center; gap: 14px; }
        .logo img { height: 55px; width: auto; transition: transform 0.3s; }
        .logo:hover img { transform: scale(1.05); }
        .logo span { font-weight: 800; color: var(--primary); font-size: 1.6rem; letter-spacing: -1px; }

        .nav-links { display: flex; align-items: center; gap: 4px; background: color-mix(in srgb, var(--primary) 7%, transparent); padding: 4px; border-radius: 99px; }
        .nav-pill { 
            padding: 8px 20px; 
            border-radius: 99px; 
            font-size: 0.9rem; 
            font-weight: 600; 
            color: var(--text-dark);
            transition: all 0.2s ease;
        }
        .nav-pill:hover { background: color-mix(in srgb, var(--primary) 14%, transparent); }
        .nav-pill.active { 
            background: var(--primary); 
            color: white; 
            box-shadow: 0 4px 10px color-mix(in srgb, var(--primary) 35%, transparent);
        }

        .nav-btn { background: var(--primary); color: white !important; padding: 12px 24px; border-radius: 99px; font-weight: 700; box-shadow: 0 4px 12px color-mix(in srgb, var(--primary) 40%, transparent); }
        .nav-btn:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 8px 16px color-mix(in srgb, var(--primary) 55%, transparent); }

        .theme-toggle {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: var(--bg-card);
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .theme-toggle:hover { transform: translateY(-1px); background: color-mix(in srgb, var(--primary) 10%, var(--bg-card)); }

        /* General Section Styling */
        .section { padding: 100px 5%; }
        .section-title { text-align: center; margin-bottom: 72px; max-width: 800px; margin-left: auto; margin-right: auto; }
        .section-title h2 { font-size: 3rem; font-weight: 800; color: var(--text-dark); margin-bottom: 16px; letter-spacing: -2px; }
        .section-title p { color: var(--text-muted); font-size: 1.15rem; }

        .grid-3 { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; }
        .card { background: var(--bg-card); border-radius: 40px; border: 1px solid var(--border); transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1); overflow: hidden; display: flex; flex-direction: column; }
        .card:hover { transform: translateY(-12px); box-shadow: var(--shadow-xl); border-color: rgba(59, 130, 246, 0.2); }

        /* Shared Components */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 16px 32px; border-radius: 99px; font-weight: 700; font-size: 1rem; cursor: pointer; gap: 8px; transition: all 0.3s; }
        .btn-primary { background: var(--primary); color: white; box-shadow: 0 10px 20px color-mix(in srgb, var(--primary) 35%, transparent); }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 15px 30px color-mix(in srgb, var(--primary) 45%, transparent); }
        .btn-outline { background: var(--bg-card); color: var(--primary); border: 2px solid color-mix(in srgb, var(--primary) 25%, transparent); }
        .btn-outline:hover { background: color-mix(in srgb, var(--primary) 8%, var(--bg-card)); border-color: var(--primary); }

        footer { background: #0f172a; color: white; padding: 120px 5% 40px; margin-top: 120px; position: relative; overflow: hidden; }
        footer::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 1px; background: linear-gradient(to right, transparent, rgba(99, 102, 241, 0.3), transparent); }
        .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1.2fr; gap: 60px; margin-bottom: 80px; position: relative; z-index: 2; }
        .footer-brand p { color: #94a3b8; max-width: 320px; margin-top: 24px; font-size: 0.95rem; line-height: 1.8; }
        .footer-h { font-size: 0.75rem; font-weight: 800; margin-bottom: 32px; color: #6366f1; text-transform: uppercase; letter-spacing: 3px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 18px; }
        .footer-links a { color: #94a3b8; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 10px; }
        .footer-links a:hover { color: white; transform: translateX(8px); }
        .footer-social { display: flex; gap: 16px; margin-top: 32px; }
        .social-btn { width: 44px; height: 44px; background: rgba(255,255,255,0.05); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.05); }
        .social-btn:hover { background: #4f46e5; transform: translateY(-5px); border-color: #4f46e5; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2); }


        /* Mobile Menu Drawer Styles */
        .mobile-menu {
            position: fixed;
            top: 100px; left: 5%; right: 5%;
            background: var(--bg-card);
            border-radius: 30px;
            padding: 24px;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border);
            z-index: 999;
        }
        .mobile-menu-content { display: flex; flex-direction: column; gap: 10px; }
        .mobile-link { 
            padding: 12px 20px; 
            border-radius: 12px; 
            color: var(--text-dark); 
            font-weight: 700; 
            font-size: 1rem;
        }
        .mobile-link.active { background: color-mix(in srgb, var(--primary) 14%, transparent); color: var(--primary); }
        [x-cloak] { display: none !important; }

        .page-splash {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 30% 20%, rgba(59, 130, 246, 0.18), transparent 45%), #f8fbff;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            z-index: 99999;
            transition: opacity 0.28s ease, visibility 0.28s ease;
        }
        .page-splash.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
        .splash-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }
        .splash-logo {
            width: 220px;
            height: 220px;
            object-fit: contain;
            animation: splash-pulse 1.15s ease-in-out infinite;
            filter: drop-shadow(0 16px 30px rgba(30, 58, 138, 0.35));
        }
        .splash-text {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 7px;
            color: #1e3a8a;
            text-transform: uppercase;
            text-shadow: 0 8px 24px rgba(30, 58, 138, 0.2);
        }
        @keyframes splash-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.12); }
        }

        .auth-btns { display: flex; align-items: center; gap: 15px; }
        .login-link { color: var(--text-dark); font-weight: 700; font-size: 0.9rem; }
        .mobile-toggle { display: none; color: var(--text-dark); background: none; border: none; cursor: pointer; padding: 10px; border-radius: 12px; transition: all 0.2s; }
        .mobile-toggle:hover { background: color-mix(in srgb, var(--primary) 12%, transparent); }

        @media (max-width: 1024px) {
            body { padding-top: 100px; }
            .nav-links, .auth-btns { display: none !important; }
            .mobile-toggle { display: flex; align-items: center; justify-content: center; }
            header { 
                width: 92% !important; 
                padding: 0 20px !important; 
                height: 65px !important; 
                top: 15px !important;
            }
            header .logo img { height: 35px !important; }
            header .logo span { font-size: 1.1rem !important; }
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
            .section { padding: 60px 20px 40px; }
            .section-title h2 { font-size: 2rem; letter-spacing: -1px; }
            .mobile-menu { top: 90px; width: 92%; left: 4%; }
        }

        @media (max-width: 640px) {
            .splash-logo { width: 170px; height: 170px; }
            .splash-text { font-size: 0.95rem; letter-spacing: 5px; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="pageSplash" class="page-splash" aria-hidden="true">
        <div class="splash-inner">
            <img src="{{ asset('assets/img/logo-kombo.png') }}" alt="KOMBO" class="splash-logo">
            <div class="splash-text">KOMBO</div>
        </div>
    </div>

    <header x-data="{ mobileMenuOpen: false, darkMode: document.documentElement.getAttribute('data-theme') === 'dark', toggleTheme() { this.darkMode = !this.darkMode; const next = this.darkMode ? 'dark' : 'light'; document.documentElement.setAttribute('data-theme', next); localStorage.setItem('theme', next); } }">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('assets/img/logo-kombo.png') }}" alt="Logo">
            <span>KOMBO</span>
        </a>
        
        <!-- Desktop Nav -->
        <nav class="nav-links">
            <a href="{{ route('home') }}" class="nav-pill {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('registration.create') }}" class="nav-pill {{ Request::is('pendaftaran') ? 'active' : '' }}">Pendaftaran</a>
            <a href="{{ route('pages.divisions') }}" class="nav-pill {{ Request::is('divisi') ? 'active' : '' }}">Kenali Divisi</a>
            <a href="{{ route('pages.structure') }}" class="nav-pill {{ Request::is('struktur-organisasi') ? 'active' : '' }}">Pengurus</a>
            <a href="{{ route('pages.schedule') }}" class="nav-pill {{ Request::is('jadwal-kegiatan') ? 'active' : '' }}">Proker</a>
            <a href="{{ route('pages.news') }}" class="nav-pill {{ Request::is('berita-kegiatan') ? 'active' : '' }}">News</a>
            <a href="{{ route('pages.alumni') }}" class="nav-pill {{ Request::is('alumni-kombo') ? 'active' : '' }}">Alumni</a>
        </nav>

        <div class="auth-btns">
            <button type="button" class="theme-toggle" @click="toggleTheme" aria-label="Toggle dark mode">
                <svg x-show="!darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364 6.364l-1.414-1.414M7.05 7.05L5.636 5.636m12.728 0L16.95 7.05M7.05 16.95l-1.414 1.414M12 16a4 4 0 100-8 4 4 0 000 8z"/></svg>
                <svg x-show="darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 118.646 3.646 7 7 0 0020.354 15.354z"/></svg>
            </button>
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-btn">Panel Admin</a>
            @else
                <a href="{{ route('login') }}" class="login-link">Masuk</a>
                <a href="{{ route('register') }}" class="nav-btn">Daftar</a>
            @endauth
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-toggle" @click="mobileMenuOpen = !mobileMenuOpen">
            <svg x-show="!mobileMenuOpen" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            <svg x-show="mobileMenuOpen" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Mobile Menu Drawer -->
        <div class="mobile-menu" x-show="mobileMenuOpen" x-transition.opacity @click.away="mobileMenuOpen = false" x-cloak>
            <div class="mobile-menu-content">
                <button type="button" class="theme-toggle" @click="toggleTheme" style="margin-bottom: 8px;">
                    <svg x-show="!darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364 6.364l-1.414-1.414M7.05 7.05L5.636 5.636m12.728 0L16.95 7.05M7.05 16.95l-1.414 1.414M12 16a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    <svg x-show="darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 118.646 3.646 7 7 0 0020.354 15.354z"/></svg>
                </button>
                <a href="{{ route('home') }}" class="mobile-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('registration.create') }}" class="mobile-link {{ Request::is('pendaftaran') ? 'active' : '' }}">Pendaftaran</a>
                <a href="{{ route('pages.divisions') }}" class="mobile-link {{ Request::is('divisi') ? 'active' : '' }}">Kenali Divisi</a>
                <a href="{{ route('pages.structure') }}" class="mobile-link {{ Request::is('struktur-organisasi') ? 'active' : '' }}">Pengurus</a>
                <a href="{{ route('pages.schedule') }}" class="mobile-link {{ Request::is('jadwal-kegiatan') ? 'active' : '' }}">Program Kerja</a>
                <a href="{{ route('pages.alumni') }}" class="mobile-link {{ Request::is('alumni-kombo') ? 'active' : '' }}">Ruang Alumni</a>
                <hr style="border: 0; border-top: 1px solid rgba(0,0,0,0.05); margin: 15px 0;">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-btn" style="width: 100%; text-align: center;">Panel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="mobile-link">Masuk</a>
                    <a href="{{ route('register') }}" class="nav-btn" style="width: 100%; text-align: center;">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo" style="margin-bottom: 24px; display: flex; align-items: center; gap: 16px; text-decoration: none;">
                    <img src="{{ asset('assets/img/logo-kombo.png') }}" alt="KOMBO Logo" style="height: 80px; width: auto;">
                    <span style="font-weight: 800; color: white; font-size: 2rem; letter-spacing: -1.5px; font-family: 'Outfit', sans-serif;">KOMBO</span>
                </a>
                <p>{{ $profile->footer_description ?? 'Platform kolaborasi digital mahasiswa Bondowoso untuk membangun daerah melalui karya nyata dan intelektualitas tinggi.' }}</p>
                <div class="footer-social">
                    @if($profile->instagram_url)
                        <a href="{{ $profile->instagram_url }}" target="_blank" class="social-btn">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.947.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.44-.645-1.44-1.44s.645-1.44 1.44-1.44z"/></svg>
                        </a>
                    @endif
                    @if($profile->youtube_url)
                        <a href="{{ $profile->youtube_url }}" target="_blank" class="social-btn">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
            <div>
                <h4 class="footer-h">Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Beranda Utama</a></li>
                    <li><a href="{{ route('pages.structure') }}">Struktur Organisasi</a></li>
                    <li><a href="{{ route('pages.news') }}">Arsip Berita</a></li>
                    <li><a href="{{ route('pages.alumni') }}">Ruang Alumni</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-h">Layanan</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('pages.schedule') }}">Jadwal Kegiatan</a></li>
                    <li><a href="{{ url('/#faqs') }}">Pusat Bantuan</a></li>
                    <li><a href="{{ route('login') }}">Akses Admin</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-h">Hubungi Kami</h4>
                <ul class="footer-links">
                    @if($profile->instagram_url)
                    <li>
                        <a href="{{ $profile->instagram_url }}" target="_blank">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.947.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.44-.645-1.44-1.44s.645-1.44 1.44-1.44z"/></svg>
                            Instagram
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="tel:{{ $profile->contact_phone ?? '#' }}">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $profile->contact_phone ?? '-' }}
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $profile->contact_email ?? '#' }}">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $profile->contact_email ?? '-' }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div style="display:flex; justify-content:space-between; align-items:center; padding-top:40px; border-top:1px solid rgba(255,255,255,0.05); color:#64748b; font-size:0.85rem; font-weight:600;">
            <p>© 2024-2026 {{ $profile->name ?? 'KOMBO' }}. Hak Cipta Dilindungi.</p>
            <p>Made with 💙 by Bondowoso Students</p>
        </div>
    </footer>

    <script>
        (function () {
            var splash = document.getElementById('pageSplash');
            if (!splash) return;

            function showSplash() {
                splash.classList.add('show');
            }

            function shouldHandleLink(link) {
                if (!link || !link.href) return false;
                if (link.target === '_blank' || link.hasAttribute('download')) return false;
                if (link.href.startsWith('mailto:') || link.href.startsWith('tel:')) return false;
                var url = new URL(link.href, window.location.origin);
                if (url.origin !== window.location.origin) return false;
                if (url.pathname === window.location.pathname && url.search === window.location.search && (url.hash || '').length > 0) return false;
                return true;
            }

            document.addEventListener('click', function (event) {
                var link = event.target.closest('a[href]');
                if (!shouldHandleLink(link)) return;
                showSplash();
            }, true);

            document.addEventListener('submit', function () {
                showSplash();
            }, true);

            window.addEventListener('pageshow', function () {
                splash.classList.remove('show');
            });
        })();
    </script>

    @yield('scripts')
</body>
</html>
