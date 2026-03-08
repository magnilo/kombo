@extends('layouts.frontend')

@section('title', 'Ruang Alumni - KOMBO')

@section('styles')
<style>
    .alumni-hero { 
        padding: 160px 10% 100px; 
        text-align: center;
        background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.05), transparent 40%);
    }
    .alumni-hero h1 { font-size: 4rem; font-weight: 800; letter-spacing: -2px; color: var(--text-dark); margin-bottom: 24px; }
    .alumni-hero h1 span { color: #4f46e5; }
    .alumni-hero p { font-size: 1.25rem; color: var(--text-muted); max-width: 600px; margin: 0 auto; line-height: 1.7; }

    .batch-container { max-width: 1200px; margin: 40px auto 100px; padding: 0 5%; }
    
    .batch-card { 
        background: white; 
        border-radius: 64px; 
        border: 1px solid var(--border); 
        overflow: hidden; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.03); 
        margin-bottom: 80px; 
        transition: transform 0.3s;
    }
    
    .batch-header { 
        padding: 60px; 
        display: grid; 
        grid-template-columns: 1.2fr 1fr; 
        gap: 60px; 
        align-items: center; 
        background: white;
    }
    .batch-image-box { border-radius: 40px; overflow: hidden; box-shadow: var(--shadow-xl); border: 1px solid #f1f5f9; aspect-ratio: 16/10; }
    .batch-image-box img { width: 100%; height: 100%; object-fit: cover; }
    
    .batch-info h2 { font-size: 3rem; font-weight: 800; color: var(--text-dark); margin-bottom: 20px; letter-spacing: -1.5px; }
    .batch-tag { font-weight: 800; color: #4f46e5; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 12px; }
    .batch-desc { font-size: 1.15rem; color: var(--text-muted); font-style: italic; line-height: 1.8; position: relative; padding-left: 30px; }
    .batch-desc::before { content: '“'; position: absolute; left: 0; top: -10px; font-size: 4rem; color: #4f46e5; opacity: 0.15; font-family: serif; }

    .members-section { padding: 60px; background: #fbfcfe; border-top: 1px solid #f1f5f9; }
    .members-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 30px; }
    
    .member-profile { text-align: center; padding: 24px; border-radius: 32px; transition: all 0.3s; background: transparent; }
    .member-profile:hover { background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.04); transform: translateY(-8px); }
    
    .avatar-wrapper { width: 110px; height: 110px; border-radius: 50%; margin: 0 auto 20px; border: 4px solid white; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden; background: white; }
    .avatar-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .member-name { font-weight: 800; color: var(--text-dark); font-size: 1rem; margin-bottom: 4px; letter-spacing: -0.2px; }
    .member-sub { font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }

    @media (max-width: 1024px) {
        .alumni-hero h1 { font-size: 3rem; }
        .batch-header { grid-template-columns: 1fr; padding: 40px; text-align: center; }
        .batch-desc { padding-left: 0; text-align: center; }
        .batch-desc::before { display: none; }
        .members-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .batch-card { border-radius: 40px; }
    }
</style>
@endsection

@section('content')
    <section class="alumni-hero">
        <div class="container">
            <span style="display:inline-block; padding: 10px 20px; background: rgba(79, 70, 229, 0.05); color: #4f46e5; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">The Legacy</span>
            <h1>Jejak <span>Langkah</span> Alumni</h1>
            <p>Ruang apresiasi bagi para pejuang yang pernah berproses dan memberikan kontribusi terbaiknya untuk Bondowoso.</p>
        </div>
    </section>

    <div class="batch-container">
        @forelse($batches as $batch)
        <div class="batch-card">
            <!-- Top Area -->
            <div class="batch-header">
                <div class="batch-image-box">
                    @if($batch->group_photo)
                        <img src="{{ asset('storage/' . $batch->group_photo) }}" alt="Foto Angkatan {{ $batch->year }}">
                    @else
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#f8fafc; color:#cbd5e1; font-size:3rem; font-weight:800;">📸</div>
                    @endif
                </div>
                <div class="batch-info">
                    <span class="batch-tag">Periode Lulusan</span>
                    <h2>Angkatan {{ $batch->year }}</h2>
                    <p class="batch-desc text-justify">
                        {{ $batch->description ?: 'Tetaplah menjadi cahaya bagi sekitar dan teruslah membawa harum nama Bondowoso di mana pun kalian melangkah.' }}
                    </p>
                </div>
            </div>

            <!-- Members List -->
            @if($batch->members->isNotEmpty())
            <div class="members-section">
                <div class="members-grid">
                    @foreach($batch->members as $member)
                    <div class="member-profile">
                        <div class="avatar-wrapper">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                            @else
                                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-weight:800; color:#4f46e5; font-size:2rem; background:#f0f4ff;">{{ substr($member->name, 0, 1) }}</div>
                            @endif
                        </div>
                        <div class="member-name">{{ $member->name }}</div>
                        <div class="member-sub">{{ $member->position ?: 'Alumni KOMBO' }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @empty
        <div style="text-align:center; padding: 100px 0; color: var(--text-muted); background: white; border-radius: 40px; border: 1px solid var(--border);">
            <span style="font-size: 4rem;">🎓</span>
            <p class="mt-4 font-bold text-lg">Belum ada data alumni yang dipublikasikan.</p>
        </div>
        @endforelse
    </div>
@endsection
