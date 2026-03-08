@extends('layouts.frontend')

@section('title', 'Tentang Kami - KOMBO')

@section('styles')
<style>
    .about-hero { 
        padding: 160px 5% 120px; 
        background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.08), transparent 40%),
                    radial-gradient(circle at center left, rgba(79, 70, 229, 0.05), transparent 30%);
        text-align: center;
    }
    .about-hero h1 { font-size: 4.5rem; font-weight: 800; letter-spacing: -3px; margin-bottom: 24px; color: var(--text-dark); }
    .about-hero h1 span { color: #3b82f6; }
    .about-hero p { font-size: 1.25rem; color: var(--text-muted); max-width: 700px; margin: 0 auto; line-height: 1.7; }

    .story-section { padding: 100px 10% 120px; display: grid; grid-template-columns: 1.2fr 1fr; gap: 80px; align-items: flex-start; }
    .story-content h2 { font-size: 3rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 32px; color: var(--text-dark); position: relative; }
    .story-content h2::after { content: ''; position: absolute; bottom: -12px; left: 0; width: 60px; height: 6px; background: #3b82f6; border-radius: 10px; }
    .story-text { font-size: 1.15rem; color: var(--text-muted); line-height: 2; text-align: justify; }

    .philosophies { display: grid; gap: 24px; }
    .philo-card { background: white; border-radius: 30px; padding: 40px; border: 1px solid var(--border); transition: all 0.3s; }
    .philo-card:hover { transform: scale(1.02); box-shadow: var(--shadow-lg); border-color: #3b82f6; }
    .philo-icon { font-size: 2.5rem; margin-bottom: 24px; display: block; }
    .philo-card h3 { font-size: 1.5rem; font-weight: 800; margin-bottom: 12px; color: var(--text-dark); }
    .philo-card p { font-size: 1rem; color: var(--text-muted); line-height: 1.7; }

    .vision-mission-box { background: #0f172a; border-radius: 80px; padding: 100px 10%; color: white; margin: 0 5% 100px; position: relative; overflow: hidden; }
    .vision-mission-box::after { content: ''; position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(59, 130, 246, 0.1); border-radius: 50%; filter: blur(80px); }
    .vm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; }
    .vm-title { font-size: 0.9rem; font-weight: 800; text-transform: uppercase; letter-spacing: 3px; color: #3b82f6; margin-bottom: 24px; }
    .vision-text { font-size: 2.25rem; font-weight: 800; line-height: 1.2; letter-spacing: -1px; }
    .mision-list { margin-top: 32px; display: grid; gap: 24px; }
    .mision-item { display: flex; gap: 20px; align-items: flex-start; font-size: 1.1rem; opacity: 0.9; }
    .mision-num { min-width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #3b82f6; }

    @media (max-width: 1024px) {
        .about-hero h1 { font-size: 3rem; }
        .story-section { grid-template-columns: 1fr; text-align: center; }
        .story-content h2::after { left: 50%; transform: translateX(-50%); }
        .vm-grid { grid-template-columns: 1fr; gap: 60px; }
        .vision-mission-box { border-radius: 40px; padding: 60px 8%; }
    }
</style>
@endsection

@section('content')
    <!-- Hero -->
    <section class="about-hero">
        <div class="container">
            <span style="display:inline-block; padding: 8px 16px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 24px;">Who We Are</span>
            <h1>Intelektualitas & <span>Dedikasi</span></h1>
            <p>Mengenal lebih jauh tentang sejarah pergerakan dan nilai-nilai fundamental yang kami junjung tinggi dalam setiap langkah organisasi.</p>
        </div>
    </section>

    <!-- History & Vision -->
    <section class="story-section">
        <div class="story-content">
            <h2>Perjalanan <span>Sejarah</span> Kami</h2>
            <div class="story-text">
                {!! nl2br(e($profile->history)) !!}
            </div>
            <div style="margin-top: 48px; padding: 40px; background: white; border-radius: 40px; border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
                <h3 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 16px; color: var(--text-dark);">Filosofi Nama <span>KOMBO</span></h3>
                <p style="color: var(--text-muted); line-height: 1.8;">{{ $profile->philosophy ?? 'Filosofi yang menggabungkan semangat kebersamaan mahasiswa Bondowoso di Politeknik Negeri Jember.' }}</p>
            </div>
        </div>
        <div class="philosophies">
            <div class="philo-card">
                <span class="philo-icon">🤝</span>
                <h3>Solidaritas Tinggi</h3>
                <p>Mengedepankan kekeluargaan sebagai fondasi utama dalam berorganisasi dan berkolaborasi.</p>
            </div>
            <div class="philo-card">
                <span class="philo-icon">📚</span>
                <h3>Intelektual Progresif</h3>
                <p>Terus belajar dan berinovasi untuk memberikan solusi nyata bagi tantangan mahasiswa dan daerah.</p>
            </div>
            <div class="philo-card">
                <span class="philo-icon">🏗️</span>
                <h3>Pengabdian Daerah</h3>
                <p>Setiap program dirancang untuk memberikan dampak positif bagi Bondowoso tercinta.</p>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Dark Box -->
    <section id="visi-misi" class="vision-mission-box">
        <div class="vm-grid">
            <div>
                <div class="vm-title">Visi Organisasi</div>
                <div class="vision-text">
                    "{{ $profile->vision ?? 'Menjadi wadah kolaborasi mahasiswa terbaik dan paling berdampak.' }}"
                </div>
                <div style="margin-top: 40px; display: flex; gap: 20px;">
                    <div style="padding: 20px; background: rgba(59, 130, 246, 0.1); border-radius: 24px; text-align: center; flex: 1;">
                        <h4 style="font-size: 1.75rem; font-weight: 800; color: #3b82f6;">2024</h4>
                        <p style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; opacity: 0.6;">Tahun Periode</p>
                    </div>
                    <div style="padding: 20px; background: rgba(255,255,255,0.05); border-radius: 24px; text-align: center; flex: 1;">
                        <h4 style="font-size: 1.75rem; font-weight: 800; color: white;">PRO</h4>
                        <p style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; opacity: 0.6;">Aksi nyata</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="vm-title">Misi Strategis</div>
                <div class="mision-list">
                    @php
                        $missions = explode("\n", $profile->mission);
                    @endphp
                    @foreach($missions as $index => $mission)
                        @if(trim($mission) != "")
                        <div class="mision-item">
                            <div class="mision-num">{{ $index + 1 }}</div>
                            <p>{{ trim($mission) }}</p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faqs" class="section">
        <div class="section-title">
            <h2>Pertanyaan <span>Umum</span></h2>
            <p>Informasi tambahan yang sering ditanyakan mengenai keanggotaan dan kegiatan.</p>
        </div>
        <div style="max-width: 900px; margin: 0 auto;" x-data="{ active: null }">
            @foreach($faqs as $index => $faq)
                <div style="background: white; border-radius: 24px; border: 1px solid var(--border); margin-bottom: 16px; overflow: hidden;">
                    <button @click="active === {{ $index }} ? active = null : active = {{ $index }}" style="width: 100%; text-align: left; padding: 24px 32px; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 800; font-size: 1.1rem; color: var(--text-dark);">
                        {{ $faq->question }}
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition: transform 0.3s;" :style="active === {{ $index }} ? 'transform: rotate(45deg)' : ''"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v12m6-6H6"/></svg>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse x-cloak style="padding: 0 32px 32px; color: var(--text-muted); line-height: 1.7; font-size: 1.1rem;">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
