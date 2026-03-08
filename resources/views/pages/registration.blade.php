@extends('layouts.frontend')

@section('title', 'Pendaftaran Anggota Baru - KOMBO')

@section('styles')
<style>
    .reg-hero {
        padding: 120px 5% 60px;
        background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.08), transparent 45%);
        text-align: center;
    }
    .reg-form-container {
        max-width: 800px;
        margin: -40px auto 100px;
        background: white;
        padding: 60px;
        border-radius: 40px;
        box-shadow: 0 40px 80px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.02);
    }
    .form-group { margin-bottom: 24px; }
    .form-group label {
        display: block;
        font-weight: 800;
        margin-bottom: 10px;
        color: var(--text-dark);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .form-control {
        width: 100%;
        padding: 18px 24px;
        border-radius: 16px;
        border: 2px solid #f1f5f9;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s;
        background: #fbfcfe;
    }
    .form-control:focus {
        outline: none;
        border-color: #4f46e5;
        background: white;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.05);
    }
    .btn-submit {
        width: 100%;
        padding: 20px;
        border-radius: 20px;
        background: #4f46e5;
        color: white;
        border: none;
        font-weight: 800;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3);
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }
    .btn-submit:hover {
        background: #4338ca;
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(79, 70, 229, 0.4);
    }
</style>
@endsection

@section('content')
<section class="reg-hero">
    <span style="font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: 3px; font-size: 0.8rem;">Join Our Movement</span>
    <h1 style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 20px;">Formulir Pendaftaran <span>Anggota</span></h1>
    <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">Mari berproses bersama di KOMBO untuk Bondowoso yang lebih baik.</p>
</section>

<div class="reg-form-container">
    @if(session('success'))
        <div style="background: #ecfdf5; border-left: 6px solid #10b981; padding: 24px; border-radius: 24px; margin-bottom: 32px; color: #065f46; font-weight: 700;">
            <div style="font-size: 1.25rem; margin-bottom: 4px;">Pendaftaran Terkirim! ✨</div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('registration.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" class="form-control" placeholder="Contoh: Teknologi Informasi" required>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi</label>
                <input type="text" name="prodi" id="prodi" class="form-control" placeholder="Contoh: Manajemen Informatika" required>
            </div>
        </div>

        <div class="form-group">
            <label for="domisili">Domisili / Alamat di Bondowoso</label>
            <input type="text" name="domisili" id="domisili" class="form-control" placeholder="Contoh: Kec. Tapen, Bondowoso" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="campus">Penempatan Kampus</label>
                <select name="campus" id="campus" class="form-control" required style="appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%234f46e5%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.4-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 20px top 50%; background-size: 12px auto;">
                    <option value="">Pilih Kampus</option>
                    <option value="Kampus Pusat">Kampus Pusat (Jember)</option>
                    <option value="Kampus 2 Bondowoso">Kampus 2 Bondowoso</option>
                </select>
            </div>
            <div class="form-group">
                <label for="division_id">Divisi Minat</label>
                <select name="division_id" id="division_id" class="form-control" required style="appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%234f46e5%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.4-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 20px top 50%; background-size: 12px auto;">
                    <option value="">Pilih Divisi</option>
                    @foreach($divisions as $div)
                        <option value="{{ $div->id }}">{{ $div->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            Kirim Pendaftaran
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </form>
</div>
@endsection
