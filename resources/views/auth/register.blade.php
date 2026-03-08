<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - KOMBO Membership</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 0;
        }
        .login-container {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            width: 1000px;
            max-width: 95%;
            min-height: 750px;
            background: white;
            border-radius: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .login-sidebar {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .login-sidebar h2 { font-size: 2.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px; }
        .login-sidebar p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 40px; }
        .logo-box { width: 80px; height: 80px; background: white; border-radius: 24px; padding: 15px; margin-bottom: 30px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .logo-box img { width: 100%; height: 100%; object-fit: contain; }

        .login-form-side { padding: 60px 80px; display: flex; flex-direction: column; justify-content: center; }
        .login-form-side h3 { font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-bottom: 8px; }
        .login-form-side p { color: #64748b; margin-bottom: 30px; font-weight: 500; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: #64748b; margin-bottom: 8px; letter-spacing: 1px; }
        .form-input { 
            width: 100%; 
            padding: 12px 20px; 
            border-radius: 16px; 
            border: 2px solid #f1f5f9; 
            background: #f8fafc; 
            font-size: 1rem; 
            font-weight: 600; 
            color: #1e293b; 
            transition: all 0.3s;
        }
        .form-input:focus { outline: none; border-color: #10b981; background: white; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
            margin-top: 10px;
        }
        .btn-login:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 15px 25px -5px rgba(16, 185, 129, 0.5); }

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
            <h2>Mulai Kontribusi Anda Hari Ini</h2>
            <p>Daftarkan diri Anda sebagai bagian dari keluarga besar KOMBO dan ikut serta membangun Bondowoso lebih baik.</p>
            <div style="margin-top: auto;">
                <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                    <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">✨</div>
                    <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">🚀</div>
                    <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">💎</div>
                </div>
                <span style="font-size: 0.8rem; font-weight: 700; opacity: 0.7; text-transform: uppercase; letter-spacing: 2px;">Join the Movement</span>
            </div>
        </div>

        <!-- Form -->
        <div class="login-form-side">
            <h3>Daftar Anggota</h3>
            <p>Lengkapi data diri Anda untuk membuat akun baru.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="Nama Lengkap Anda..." value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 6px; font-weight: 700;">{{ $message }}</p> @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="bondowoso@example.com" value="{{ old('email') }}" required autocomplete="username">
                    @error('email') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 6px; font-weight: 700;">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                    @error('password') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 6px; font-weight: 700;">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ketik ulang password" required autocomplete="new-password">
                    @error('password_confirmation') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 6px; font-weight: 700;">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-login">Daftar Sekarang</button>
            </form>

            <div style="margin-top: 40px; text-align: center;">
                <p style="margin-bottom: 0; font-size: 0.85rem;">Sudah punya akun? <a href="{{ route('login') }}" style="color: #10b981; text-decoration: none; font-weight: 800;">Masuk di sini</a></p>
                <a href="/" style="display: inline-block; margin-top: 15px; font-size: 0.8rem; font-weight: 700; color: #64748b; text-decoration: none;">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
