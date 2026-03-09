<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1e3a8a">
    <title>Login - KOMBO Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-kombo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }
        .login-container {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            width: 1000px;
            max-width: 95%;
            height: 650px;
            background: white;
            border-radius: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .login-sidebar {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .login-sidebar::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .login-sidebar h2 { font-size: 2.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px; }
        .login-sidebar p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 40px; }
        .logo-box { width: 80px; height: 80px; background: white; border-radius: 24px; padding: 15px; margin-bottom: 30px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .logo-box img { width: 100%; height: 100%; object-fit: contain; }

        .login-form-side { padding: 80px; display: flex; flex-direction: column; justify-content: center; }
        .login-form-side h3 { font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-bottom: 8px; }
        .login-form-side p { color: #64748b; margin-bottom: 40px; font-weight: 500; }

        .form-group { margin-bottom: 24px; }
        .form-group label { display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: #64748b; margin-bottom: 8px; letter-spacing: 1px; }
        .form-input { 
            width: 100%; 
            padding: 14px 20px; 
            border-radius: 16px; 
            border: 2px solid #f1f5f9; 
            background: #f8fafc; 
            font-size: 1rem; 
            font-weight: 600; 
            color: #1e293b; 
            transition: all 0.3s;
        }
        .form-input:focus { outline: none; border-color: #3b82f6; background: white; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
            margin-top: 10px;
        }
        .btn-login:hover { background: #2563eb; transform: translateY(-2px); box-shadow: 0 15px 25px -5px rgba(59, 130, 246, 0.5); }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 900px) {
            .login-container { grid-template-columns: 1fr; height: auto; }
            .login-sidebar { display: none; }
            .login-form-side { padding: 40px 30px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Sidebar -->
        <div class="login-sidebar">
            <div class="logo-box">
                <img src="{{ asset('assets/img/logo-kombo.png') }}" alt="KOMBO Logo">
            </div>
            <h2>Selamat Datang Kembali di Panel Admin</h2>
            <p>Kelola inspirasi, berita, dan program kerja KOMBO dengan mudah dari satu dashboard terintegrasi.</p>
            <div style="margin-top: auto;">
                <span style="font-size: 0.8rem; font-weight: 700; opacity: 0.7; text-transform: uppercase; letter-spacing: 2px;">Powered by KOMBO Tech Team</span>
            </div>
        </div>

        <!-- Form -->
        <div class="login-form-side">
            <div style="display: none;" class="mobile-logo">
                <img src="{{ asset('assets/img/logo-kombo.png') }}" style="width: 50px; margin-bottom: 20px;" alt="">
            </div>
            <h3>Masuk Akun</h3>
            <p>Silakan masukkan email dan password admin Anda.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Session Status -->
                @if(session('status'))
                    <div style="padding: 15px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 700;">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="admin@kombo.com" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 6px; font-weight: 700;">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label style="margin-bottom: 0;">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 0.75rem; font-weight: 700; color: #3b82f6; text-decoration: none;">Forgot?</a>
                        @endif
                    </div>
                    <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
                    @error('password') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 6px; font-weight: 700;">{{ $message }}</p> @enderror
                </div>

                <div style="display: flex; align-items: center; margin-bottom: 30px;">
                    <input type="checkbox" id="remember_me" name="remember" style="width: 18px; height: 18px; border-radius: 4px; border: 2px solid #f1f5f9; cursor: pointer;">
                    <label for="remember_me" style="margin-bottom: 0; margin-left: 10px; font-size: 0.85rem; font-weight: 600; color: #64748b; cursor: pointer;">Ingat saya</label>
                </div>

                <button type="submit" class="btn-login">Masuk Sekarang</button>
            </form>

            <div style="margin-top: 40px; text-align: center;">
                <p style="margin-bottom: 0; font-size: 0.85rem;">Belum punya akun? <a href="{{ route('register') }}" style="color: #3b82f6; text-decoration: none; font-weight: 800;">Daftar Anggota</a></p>
                <a href="/" style="display: inline-block; margin-top: 15px; font-size: 0.8rem; font-weight: 700; color: #64748b; text-decoration: none;">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
