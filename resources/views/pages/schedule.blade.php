@extends('layouts.frontend')

@section('title', 'Jadwal Kegiatan - KOMBO')

@section('styles')
<style>
    .schedule-hero { 
        padding: 160px 5% 80px; 
        text-align: center;
        background: radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.05), transparent 40%);
    }
    .schedule-hero h1 { font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 24px; color: var(--text-dark); }
    
    .division-nav { 
        display: flex; 
        justify-content: center; 
        gap: 8px; 
        margin-bottom: 60px; 
        padding: 8px; 
        background: white; 
        border-radius: 99px; 
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
        flex-wrap: wrap;
    }
    .div-btn { 
        padding: 10px 24px; 
        border-radius: 99px; 
        font-weight: 700; 
        font-size: 0.9rem; 
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        background: transparent;
    }
    .div-btn.active { background: #3b82f6; color: white; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2); }

    .schedule-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 32px; max-width: 1200px; margin: 0 auto; }
    .schedule-card { 
        background: white; 
        border-radius: 32px; 
        padding: 32px; 
        border: 1px solid var(--border); 
        transition: all 0.4s;
        display: flex;
        gap: 24px;
    }
    .schedule-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-xl); border-color: rgba(59, 130, 246, 0.2); }
    
    .date-box { 
        min-width: 80px; 
        height: 100px; 
        background: var(--bg-light); 
        border-radius: 20px; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        border: 1px solid var(--border);
    }
    .date-box .day { font-size: 1.75rem; font-weight: 800; color: #3b82f6; line-height: 1; }
    .date-box .month { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); margin-top: 4px; }

    .event-info h3 { font-size: 1.25rem; font-weight: 800; color: var(--text-dark); margin-bottom: 8px; line-height: 1.3; }
    .event-meta { font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
    .event-meta span { display: flex; align-items: center; gap: 4px; }
    
    .div-badge { 
        display: inline-block; 
        padding: 4px 12px; 
        background: rgba(59, 130, 246, 0.1); 
        color: #3b82f6; 
        border-radius: 8px; 
        font-size: 0.75rem; 
        font-weight: 800; 
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    @media (max-width: 600px) {
        .schedule-card { flex-direction: column; padding: 24px; }
        .date-box { width: 100%; height: 60px; flex-direction: row; gap: 10px; }
    }
</style>
@endsection

@section('content')
    <section class="schedule-hero">
        <div class="container">
            <span style="display:inline-block; padding: 8px 16px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">Agenda & Events</span>
            <h1>Program Kerja <span>KOMBO</span></h1>
            <p>Jadwal kegiatan rutin dan acara besar yang akan dilaksanakan ke depan.</p>
        </div>
    </section>

    <section class="section" x-data="{ activeDiv: 'Semua' }" style="padding-top: 20px;">
        <div class="division-nav">
            <button class="div-btn" :class="activeDiv === 'Semua' ? 'active' : ''" @click="activeDiv = 'Semua'">Semua Proker</button>
            @php
                $divs = $jadwals->whereNotNull('division')->unique('division')->pluck('division');
            @endphp
            @foreach($divs as $div)
                <button class="div-btn" :class="activeDiv === '{{ $div }}' ? 'active' : ''" @click="activeDiv = '{{ $div }}'">
                    {{ $div }}
                </button>
            @endforeach
        </div>

        <div class="schedule-grid">
            @forelse($jadwals as $jadwal)
                <div class="schedule-card" x-show="activeDiv === 'Semua' || activeDiv === '{{ $jadwal->division }}'" x-transition:enter.scale.95>
                    <div class="date-box">
                        <span class="day">{{ $jadwal->date->format('d') }}</span>
                        <span class="month">{{ $jadwal->date->format('M') }}</span>
                    </div>
                    <div class="event-info">
                        <div class="div-badge">{{ $jadwal->division ?? 'Umum' }}</div>
                        <h3>{{ $jadwal->title }}</h3>
                        <div class="event-meta">
                            <span style="display: inline-flex; align-items: center; gap: 6px;"><svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $jadwal->location }}</span>
                            <span style="display: inline-flex; align-items: center; gap: 6px;"><svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ \Carbon\Carbon::parse($jadwal->time)->format('H:i') }} WIB</span>
                        </div>
                        <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                            {{ Str::limit($jadwal->description, 100) }}
                        </p>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
                    <span style="display: inline-flex; color: #94a3b8;"><svg style="width: 64px; height: 64px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
                    <p style="color: var(--text-muted); margin-top: 20px;">Belum ada jadwal kegiatan terdekat.</p>
                </div>
            @endforelse
        </div>
        
        <div style="margin-top: 60px;">
            {{ $jadwals->links() }}
        </div>
    </section>
@endsection
