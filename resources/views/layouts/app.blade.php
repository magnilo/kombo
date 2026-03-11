<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1e3a8a">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-kombo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f3f7ff; }
        html, body, * { -ms-overflow-style: none; scrollbar-width: none; }
        html::-webkit-scrollbar, body::-webkit-scrollbar, *::-webkit-scrollbar { width: 0; height: 0; display: none; }
        
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #f1f5f9;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            z-index: 50;
            transition: all 0.3s;
        }

        .main-content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 16px;
            color: #64748b;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .nav-item:hover {
            background: #f8fafc;
            color: #1e293b;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: #dbeafe;
            color: #1e3a8a;
        }

        .nav-item.active svg { color: #1e3a8a; }

        .nav-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 48px;
            padding-left: 12px;
        }

        .logo-small {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1e3a8a;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .sidebar.open { transform: translateX(0); }
        }

        /* Fallback for Tailwind grid/utility if it fails to load */
        .grid { display: grid; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        @media (min-width: 768px) {
            .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (min-width: 1024px) {
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
            .lg\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        .gap-6 { gap: 1.5rem; }
        .gap-8 { gap: 2rem; }
        .bg-white { background-color: #ffffff; }
        .p-6 { padding: 1.5rem; }
        .rounded-3xl { border-radius: 1.5rem; }
        .shadow-sm { box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05); }
        .border { border-width: 1px; }
        .border-slate-100 { border-color: #f1f5f9; }

        /* Typography & Grid backup */
        h1, h2, h3 { color: #1e293b; font-weight: 800; }
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }
        .text-slate-800 { color: #1e293b; }
        .text-slate-500 { color: #64748b; }
        .font-extrabold { font-weight: 800; }
        .font-bold { font-weight: 700; }
        .uppercase { text-transform: uppercase; }
        .tracking-wider { letter-spacing: 0.05em; }
        .mb-1 { margin-bottom: 0.25rem; }
        .mb-4 { margin-bottom: 1rem; }
        .space-y-8 > :not([hidden]) ~ :not([hidden]) { margin-top: 2rem; }
        .relative { position: relative; }
        .overflow-hidden { overflow: hidden; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .w-12 { width: 3rem; }
        .h-12 { height: 3rem; }
        .bg-blue-50 { background-color: #dbeafe; }
        .text-blue-600 { color: #1e3a8a; }
        .bg-emerald-50 { background-color: #ecfdf5; }
        .text-emerald-600 { color: #059669; }
        .bg-purple-50 { background-color: #f5f3ff; }
        .text-purple-600 { color: #7c3aed; }
        .bg-orange-50 { background-color: #fff7ed; }
        .text-orange-600 { color: #ea580c; }

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

        @media (max-width: 640px) {
            .splash-logo { width: 170px; height: 170px; }
            .splash-text { font-size: 0.95rem; letter-spacing: 5px; }
        }
    </style>
</head>
<body class="antialiased" x-data="{ sidebarOpen: false }">
    <div id="pageSplash" class="page-splash" aria-hidden="true">
        <div class="splash-inner">
            <img src="{{ asset('assets/img/logo-kombo.png') }}" alt="KOMBO" class="splash-logo">
            <div class="splash-text">KOMBO</div>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar" :class="sidebarOpen ? 'open' : ''">
        <div class="sidebar-logo">
            <img src="{{ asset('assets/img/logo-kombo.png') }}" class="logo-small" alt="">
            <span class="logo-text">KOMBO Admin</span>
        </div>

        <nav class="flex-1">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            
            <a href="{{ route('berita.index') }}" class="nav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v12a2 2 0 01-2 2zM7 8h4m-4 4h8m-8 4h8"/></svg>
                Berita Org
            </a>

            <a href="{{ route('jadwal.index') }}" class="nav-item {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Program Kerja
            </a>

            <a href="{{ route('leaders.index') }}" class="nav-item {{ request()->routeIs('leaders.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Struktur Org
            </a>

            <a href="{{ route('alumni.index') }}" class="nav-item {{ request()->routeIs('alumni.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                Alumni KOMBO
            </a>

            <a href="{{ route('organization.edit') }}" class="nav-item {{ request()->routeIs('organization.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Profil Web
            </a>

            <a href="{{ route('faqs.index') }}" class="nav-item {{ request()->routeIs('faqs.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Bantuan / FAQ
            </a>

            <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 10px 0;">

            <a href="{{ route('registrations.index') }}" class="nav-item {{ request()->routeIs('registrations.index') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Calon Anggota
            </a>

            <a href="{{ route('divisions.index') }}" class="nav-item {{ request()->routeIs('divisions.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                Info Divisi
            </a>

            <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Profil Admin
            </a>
        </nav>

        <div style="margin-top: auto; padding-top: 24px; border-top: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding-left: 12px;">
                <div style="width: 40px; height: 40px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #1e3a8a;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div style="font-size: 0.85rem; font-weight: 800; color: #1e293b;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ Auth::user()->role }}</div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item w-full" style="background: none; border: none; cursor: pointer;">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span class="text-red-500">Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="header-top">
            <div>
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 -ml-2 lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-2xl font-extrabold text-slate-800">
                    @yield('admin_title', 'Dashboard')
                </h1>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-white border border-slate-200 rounded-xl font-bold text-sm text-slate-600 flex items-center gap-2 hover:bg-slate-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Pratinjau Web
                </a>
                <a href="{{ url('/run-git-pull') }}" class="px-4 py-2 bg-slate-800 rounded-xl font-bold text-sm text-white flex items-center gap-2 hover:bg-slate-900 transition shadow-lg shadow-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Update System
                </a>
            </div>
        </header>

        <section>
            {{ $slot }}
        </section>
    </main>

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
</body>
</html>
