@extends('layouts.frontend')

@section('title', 'Kenali Divisi Kami - KOMBO')

@section('styles')
<style>
    .div-hero {
        padding: 120px 5% 60px;
        background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.08), transparent 45%);
        text-align: center;
    }
    .div-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        padding: 0 5% 100px;
        max-width: 1300px;
        margin: 0 auto;
    }
    .div-card {
        background: white;
        padding: 50px 40px;
        border-radius: 40px;
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
    }
    .div-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 40px 80px rgba(79, 70, 229, 0.1);
        border-color: rgba(79, 70, 229, 0.2);
    }
    .div-icon {
        width: 70px;
        height: 70px;
        background: rgba(79, 70, 229, 0.05);
        color: #4f46e5;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 30px;
        transition: all 0.3s;
    }
    .div-card:hover .div-icon {
        background: #4f46e5;
        color: white;
        transform: scale(1.1) rotate(5deg);
    }
    .div-card h3 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--text-dark);
    }
    .div-card p {
        color: var(--text-muted);
        line-height: 1.8;
        font-size: 1.05rem;
    }
    .empty-div {
        grid-column: 1/-1;
        text-align: center;
        padding: 100px 20px;
        background: white;
        border-radius:40px;
        color: var(--text-muted);
    }
</style>
@endsection

@section('content')
<section class="div-hero">
    <span style="font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: 3px; font-size: 0.8rem;">Departments & Specialties</span>
    <h1 style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 20px;">Divisi di <span>KOMBO</span></h1>
    <p style="color: var(--text-muted); max-width: 650px; margin: 0 auto;">Pilih wadah yang paling sesuai dengan passion dan keahlianmu.</p>
</section>

<div class="div-grid">
    @forelse($divisions as $div)
        <div class="div-card">
            <div class="div-icon">
                {!! $div->icon ?? '💠' !!}
            </div>
            <h3>{{ $div->name }}</h3>
            <p>{!! nl2br(e($div->description)) !!}</p>
        </div>
    @empty
        <div class="empty-div">
            <h3 style="color: var(--text-dark);">Belum ada divisi yang terdaftar.</h3>
            <p>Admin sedang menyiapkan informasi divisi untuk Anda.</p>
        </div>
    @endforelse
</div>

<section style="padding: 100px 5%; background: white; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto; background: #0f172a; padding: 60px; border-radius: 50px; color: white;">
        <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 24px;">Sudah Menentukan Pilihan?</h2>
        <p style="color: #94a3b8; margin-bottom: 40px;">Jangan ragu untuk memulai langkahmu bersama kami.</p>
        <a href="{{ route('registration.create') }}" class="btn btn-primary" style="background: #4f46e5; padding: 20px 40px; box-shadow: 0 10px 30px rgba(79, 70, 229, 0.4);">Daftar Sekarang Juga <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
    </div>
</section>
@endsection
