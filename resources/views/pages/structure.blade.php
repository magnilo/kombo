@extends('layouts.frontend')

@section('title', 'Struktur Pengurus - KOMBO')

@section('styles')
<style>
    .structure-hero { 
        padding: 160px 5% 60px; 
        text-align: center;
        background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.05), transparent 40%);
    }
    .structure-hero h1 { font-size: 4rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 24px; color: var(--text-dark); }
    .structure-hero p { font-size: 1.25rem; color: var(--text-muted); max-width: 600px; margin: 0 auto; }

    /* Division Selector */
    .division-picker { 
        display: flex; 
        justify-content: center; 
        gap: 8px; 
        margin: 40px auto 80px; 
        padding: 8px; 
        background: white; 
        border-radius: 99px; 
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        width: fit-content;
        position: sticky;
        top: 100px;
        z-index: 100;
        backdrop-filter: blur(10px);
    }
    .div-btn { 
        padding: 12px 28px; 
        border-radius: 99px; 
        font-weight: 700; 
        font-size: 0.9rem; 
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        background: transparent;
        white-space: nowrap;
    }
    .div-btn.active { 
        background: #4f46e5; 
        color: white; 
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .leader-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
        gap: 32px; 
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 0 5% 100px;
    }

    /* Premium Card Design */
    .leader-card { 
        background: white; 
        padding: 40px 30px; 
        border-radius: 48px; 
        text-align: center; 
        border: 1px solid var(--border); 
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    }
    .leader-card:hover { transform: translateY(-12px); box-shadow: var(--shadow-xl); border-color: rgba(79, 70, 229, 0.2); }

    .leader-img-wrapper { 
        position: relative; 
        width: 160px; 
        height: 160px; 
        margin-bottom: 24px; 
        padding: 8px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .leader-photo { 
        width: 100%; 
        height: 100%; 
        border-radius: 50%; 
        object-fit: cover; 
    }

    .leader-pos-badge {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #4f46e5;
        background: rgba(79, 70, 229, 0.08);
        padding: 6px 16px;
        border-radius: 12px;
        margin-bottom: 16px;
    }
    .leader-name { font-size: 1.35rem; font-weight: 800; color: #1e293b; margin-bottom: 6px; letter-spacing: -0.5px; }
    .leader-division-label { font-size: 0.85rem; color: #64748b; font-weight: 600; }

    /* Highlights for Chiefs */
    .leader-card.is-chief { border-color: rgba(79, 70, 229, 0.1); background: linear-gradient(to bottom, #ffffff, #f9fafb); }
    .leader-card.is-chief .leader-pos-badge { background: #4f46e5; color: white; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2); }

    @media (max-width: 768px) {
        .structure-hero h1 { font-size: 2.75rem; }
        .division-picker { width: 95%; overflow-x: auto; justify-content: flex-start; border-radius: 24px; }
        .leader-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>
@endsection

@section('content')
    <section class="structure-hero">
        <div class="container">
            <span style="display:inline-block; padding: 10px 20px; background: rgba(79, 70, 229, 0.05); color: #4f46e5; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">The Organization</span>
            <h1>Struktur Kepengurusan</h1>
            <p>Sinergi bersama mahasiswa Bondowoso di Politeknik Negeri Jember untuk kemajuan daerah.</p>
        </div>
    </section>

    <section x-data="{ currentDiv: 'Semua' }">
        <!-- Division Navbar Selector -->
        <div class="division-picker">
            <button class="div-btn" :class="currentDiv === 'Semua' ? 'active' : ''" @click="currentDiv = 'Semua'">Semua</button>
            <button class="div-btn" :class="currentDiv === 'BPH' ? 'active' : ''" @click="currentDiv = 'BPH'">BPH</button>
            @php
                $divs = $leaders->whereNotNull('division')->where('division', '!=', '')->unique('division')->pluck('division');
            @endphp
            @foreach($divs as $div)
                <button class="div-btn" :class="currentDiv === '{{ $div }}' ? 'active' : ''" @click="currentDiv = '{{ $div }}'">
                    {{ $div }}
                </button>
            @endforeach
        </div>

        <!-- Leaders List -->
        <div class="leader-grid">
            @foreach($leaders as $leader)
                @php
                    $isChief = str_contains($leader->position, 'Ketua') || str_contains($leader->position, 'Koordinator');
                    $divCat = $leader->division ? $leader->division : 'BPH';
                @endphp
                <div 
                    class="leader-card {{ $isChief ? 'is-chief' : '' }}" 
                    x-show="currentDiv === 'Semua' || currentDiv === '{{ $divCat }}'"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                >
                    <div class="leader-img-wrapper">
                        <img src="{{ $leader->photo ? asset('storage/' . $leader->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($leader->name) . '&background=4f46e5&color=fff&size=200' }}" class="leader-photo" alt="{{ $leader->name }}">
                    </div>
                    
                    <span class="leader-pos-badge">{{ $leader->position }}</span>
                    <h3 class="leader-name">{{ $leader->name }}</h3>
                    <div class="leader-division-label">{{ $leader->division ? 'Divisi ' . $leader->division : 'Badan Pengurus Harian' }}</div>
                    
                    <div style="display: flex; gap: 8px; margin-top: 16px;">
                        @if($leader->period)
                            <span style="font-size: 0.65rem; font-weight: 800; color: #94a3b8; background: #f8fafc; padding: 4px 10px; border-radius: 6px; text-transform: uppercase;">{{ $leader->period }}</span>
                        @endif
                        @if($leader->batch)
                            <span style="font-size: 0.65rem; font-weight: 800; color: #4f46e5; background: rgba(79, 70, 229, 0.05); padding: 4px 10px; border-radius: 6px; text-transform: uppercase;">Agt {{ $leader->batch }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center; padding: 0 5% 100px;">
            <div style="max-width: 600px; margin: 0 auto; padding: 40px; background: #fbfcfe; border-radius: 40px; border: 1px solid #f1f5f9;">
                <h4 style="font-weight: 800; color: var(--text-dark); margin-bottom: 12px;">Ingin melihat kabinet sebelumnya?</h4>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 24px;">Telusuri sejarah kepengurusan KOMBO dari periode ke periode.</p>
                <a href="{{ route('pages.alumni') }}" class="btn btn-outline" style="font-size: 0.85rem; padding: 12px 24px;">Lihat Ruang Alumni & Sejarah</a>
            </div>
        </div>

        @if($leaders->isEmpty())
            <div style="text-align:center; padding: 100px 0; color: var(--text-muted);">
                <span style="font-size: 4rem;">👥</span>
                <p>Data pengurus belum ditambahkan.</p>
            </div>
        @endif
    </section>
@endsection
