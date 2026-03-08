@extends('layouts.frontend')

@section('title', 'Beranda - KOMBO')

@section('styles')
<style>
    /* Hero Section */
    .hero { 
        padding: 160px 10% 120px; 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 80px; 
        align-items: center; 
        background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.08), transparent 45%),
                    radial-gradient(circle at center left, rgba(79, 70, 229, 0.05), transparent 30%);
    }
    .hero-content { animation: fadeInUp 0.8s ease-out; }
    .hero-content h1 { font-size: 4.8rem; line-height: 1.05; font-weight: 800; letter-spacing: -3.5px; margin-bottom: 24px; color: var(--text-dark); }
    .hero-content h1 span { color: #4f46e5; position: relative; }
    .hero-content p { font-size: 1.25rem; color: var(--text-muted); margin-bottom: 48px; max-width: 540px; line-height: 1.7; font-weight: 500; }
    
    .hero-image { position: relative; animation: float 6s ease-in-out infinite; }
    .hero-image img { width: 100%; max-width: 500px; filter: drop-shadow(0 40px 80px rgba(79, 70, 229, 0.15)); }

    /* Modern Stats Section */
    .stats-section { padding: 0 10% 80px; margin-top: -60px; position: relative; z-index: 10; }
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .stat-card { background: white; padding: 48px 30px; border-radius: 48px; border: 1px solid rgba(0,0,0,0.03); text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.02); transition: all 0.3s; }
    .stat-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(79, 70, 229, 0.08); }
    .stat-card h3 { font-size: 3.5rem; font-weight: 800; color: #4f46e5; margin-bottom: 8px; letter-spacing: -2px; }
    .stat-card p { font-weight: 800; color: var(--text-muted); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 2px; }

    /* About Section UI Overhaul */
    .about-section { padding: 120px 10%; background: #ffffff; position: relative; }
    .about-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 100px; align-items: start; }
    
    .about-content h2 { font-size: 3.5rem; font-weight: 800; color: var(--text-dark); letter-spacing: -2.5px; line-height: 1.1; margin-bottom: 32px; }
    .about-content h2 span { color: #4f46e5; }
    .about-text { font-size: 1.2rem; color: var(--text-muted); line-height: 1.9; margin-bottom: 48px; text-align: justify; font-weight: 400; }
    
    .philo-box { display: grid; gap: 24px; }
    .philo-item { background: #fbfcfe; border-radius: 40px; padding: 40px; border: 1px solid #f1f5f9; transition: all 0.3s; }
    .philo-item:hover { background: white; border-color: #4f46e5; box-shadow: 0 15px 30px rgba(79, 70, 229, 0.05); transform: translateX(10px); }
    .philo-icon { font-size: 2.5rem; margin-bottom: 24px; display: block; }
    .philo-item h4 { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); margin-bottom: 12px; }
    .philo-item p { font-size: 1rem; color: var(--text-muted); line-height: 1.7; }

    /* Vision Mission Dark UI */
    .vm-section { padding: 40px 5% 120px; }
    .vm-card { background: #0f172a; border-radius: 80px; padding: 100px 8%; color: white; position: relative; overflow: hidden; box-shadow: 0 40px 80px rgba(15, 23, 42, 0.2); }
    .vm-card::before { content: ''; position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(79, 70, 229, 0.15); border-radius: 50%; filter: blur(100px); }
    .vm-inner { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 1fr; gap: 80px; }
    
    .vm-label { font-size: 0.8rem; font-weight: 800; color: #6366f1; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 24px; display: block; }
    .v-text { font-size: 2.5rem; font-weight: 800; line-height: 1.2; letter-spacing: -1.5px; margin-bottom: 40px; }
    .m-list { display: grid; gap: 32px; }
    .m-item { display: flex; gap: 24px; align-items: flex-start; }
    .m-num { width: 48px; height: 48px; background: rgba(99, 102, 241, 0.2); border-radius: 16px; border: 1px solid rgba(99, 102, 241, 0.3); display: flex; align-items: center; justify-content: center; font-weight: 800; color: #818cf8; flex-shrink: 0; }
    .m-item p { font-size: 1.15rem; color: #94a3b8; line-height: 1.6; }

    /* FAQ */
    .faq-section { padding: 120px 10%; background: #fbfcfe; }
    .faq-container { max-width: 900px; margin: 0 auto; }
    .faq-item { background: white; border-radius: 32px; border: 1px solid #f1f5f9; margin-bottom: 20px; overflow: hidden; transition: all 0.3s; }
    .faq-item:hover { border-color: #4f46e5; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .faq-trigger { width: 100%; padding: 32px 40px; text-align: left; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 800; font-size: 1.2rem; color: var(--text-dark); transition: all 0.2s; }
    .faq-content { padding: 0 40px 32px; color: var(--text-muted); line-height: 1.8; font-size: 1.1rem; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes float { 0% { transform: translateY(0); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0); } }

    @media (max-width: 1200px) {
        .hero { grid-template-columns: 1fr; text-align: center; padding: 140px 5% 80px; }
        .hero-content h1 { font-size: 3.5rem; letter-spacing: -2px; }
        .hero-content p { margin: 0 auto 40px; }
        .hero-btns { justify-content: center; }
        .hero-image { order: -1; margin-bottom: 40px; }
        .stats-grid { grid-template-columns: 1fr; }
        .about-grid { grid-template-columns: 1fr; gap: 60px; }
        .vm-inner { grid-template-columns: 1fr; gap: 60px; }
        .vm-card { border-radius: 40px; padding: 60px 8%; }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div style="display:inline-block; padding: 10px 20px; background: rgba(79, 70, 229, 0.05); color: #4f46e5; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2.5px; margin-bottom: 24px;">Bondowoso Synergy Platform</div>
            <h1>{!! str_replace('Bondowoso', '<span>Bondowoso</span>', $profile->slogan ?? 'Bersatu Untuk Bondowoso Bangkit') !!}</h1>
            <p>{{ $profile->vision ?? 'Menjadi wadah sinergi mahasiswa Bondowoso di Polije untuk membangun daerah melalui karya nyata dan intelektualitas.' }}</p>
            <div class="hero-btns" style="display: flex; gap: 20px;">
                <a href="#tentang" class="btn btn-primary" style="background: #4f46e5; box-shadow: 0 10px 30px rgba(79, 70, 229, 0.2);">Kenalan Lebih Dekat <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 13l-7 7-7-7"/></svg></a>
                <a href="{{ route('pages.structure') }}" class="btn btn-outline" style="border-radius: 99px; font-weight: 800;">Lihat Kabinet</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ $profile->hero_image ? asset('storage/' . $profile->hero_image) : asset('assets/img/logo-kombo.png') }}" alt="KOMBO Logo">
        </div>
    </section>

    <!-- Stats -->
    @php
        $countBerita = \App\Models\Berita::count();
        $countJadwal = \App\Models\Jadwal::count();
        $countLeader = \App\Models\Leader::count();
        $countDivisi = \App\Models\Leader::distinct('division')->count('division');
    @endphp
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>{{ $countLeader }}+</h3>
                <p>Anggota Aktif</p>
            </div>
            <div class="stat-card">
                <h3>{{ $countJadwal }}+</h3>
                <p>Program Kerja</p>
            </div>
            <div class="stat-card">
                <h3>{{ $countDivisi }}+</h3>
                <p>Divisi Sinergi</p>
            </div>
        </div>
    </section>

    <!-- UI Overhaul: About & Story -->
    <section id="tentang" class="about-section">
        <div class="about-grid">
            <div class="about-content">
                <span style="font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: 3px; font-size: 0.8rem; display: block; margin-bottom: 16px;">Since the Beginning</span>
                <h2>Eksistensi & <span>Jejak Sejarah</span> KOMBO</h2>
                <div class="about-text">
                    {!! nl2br(e($profile->history)) !!}
                </div>
                
                <div style="padding: 40px; background: #fbfcfe; border-radius: 40px; border: 2px solid #f1f5f9; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -10px; right: -10px; font-size: 8rem; opacity: 0.03; font-weight: 900; color: #4f46e5;">KOMBO</div>
                    <h5 style="font-size: 1.1rem; font-weight: 800; color: var(--text-dark); margin-bottom: 12px; position: relative;">Filosofi Kami</h5>
                    <p style="color: var(--text-muted); font-size: 1rem; line-height: 1.7; position: relative; font-style: italic;">"{{ $profile->philosophy ?? 'Sebuah wadah yang lahir dari kerinduan mahasiswa akan kampung halaman, untuk berkontribusi bagi Bondowoso.' }}"</p>
                </div>
            </div>

            <div class="philo-box">
                <div class="philo-item">
                    <span class="philo-icon">🤝</span>
                    <h4>Kekeluargaan</h4>
                    <p>Karena di tanah rantau, teman se-organisasi adalah keluarga kedua yang paling berharga.</p>
                </div>
                <div class="philo-item">
                    <span class="philo-icon">⚡</span>
                    <h4>Dinamis</h4>
                    <p>Merespon tantangan zaman dengan inovasi digital dan aksi kepemudaan yang progresif.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- UI Overhaul: Visi & Misi Dark Layout -->
    <section class="vm-section">
        <div class="vm-card">
            <div class="vm-inner">
                <div>
                    <span class="vm-label">Our Vision</span>
                    <div class="v-text">
                        "{{ $profile->vision ?? 'Menjadi wadah mahasiswa Bondowoso terbaik yang memberikan dampak nyata.' }}"
                    </div>
                    <div style="display: flex; gap: 20px; align-items: center; margin-top: 50px;">
                        <div style="width: 60px; height: 3px; background: #4f46e5;"></div>
                        <p style="font-weight: 800; color: #94a3b8; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 3px;">Periode 2024 - 2025</p>
                    </div>
                </div>
                <div>
                    <span class="vm-label">Our Mission</span>
                    <div class="m-list">
                        @php
                            $missions = explode("\n", $profile->mission);
                        @endphp
                        @foreach($missions as $index => $mission)
                            @if(trim($mission) != "")
                            <div class="m-item">
                                <div class="m-num">{{ $index + 1 }}</div>
                                <p>{{ trim($mission) }}</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- UI Overhaul: News Archive -->
    <section id="berita" class="section" style="background: white;">
        <div class="section-title">
            <span style="font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: 3px; font-size: 0.8rem;">Archive & Media</span>
            <h2 style="font-size: 3rem; font-weight: 800; letter-spacing: -2px;">Update <span>Aksi</span> Terbaru</h2>
            <p>Berita kegiatan terupdate sebagai bentuk transparansi aksi kami.</p>
        </div>
        
        <div style="display: flex; flex-wrap: wrap; gap: 32px; max-width: 1240px; margin: 0 auto; justify-content: center; padding: 0 20px;">
            @forelse($beritas as $berita)
                <div class="card" style="flex: 0 1 380px; width: 100%; border-radius: 40px; padding: 16px; background: white; border: 1px solid rgba(0,0,0,0.03);">
                    <div style="aspect-ratio: 16/10; overflow: hidden; border-radius: 30px;">
                        @if($berita->image)
                            <img src="{{ asset('storage/' . $berita->image) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $berita->title }}">
                        @else
                            <div style="width: 100%; height: 100%; background: #f8fafc; display: flex; align-items: center; justify-content: center; font-size: 3rem;">🗞️</div>
                        @endif
                    </div>
                    <div style="padding: 24px 10px 10px;">
                        <div style="display: flex; gap: 8px; margin-bottom: 12px;">
                            <span style="background: rgba(79, 70, 229, 0.08); color: #4f46e5; padding: 4px 12px; border-radius: 8px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Terbaru</span>
                            <span style="color: #94a3b8; font-size: 0.75rem; font-weight: 700;">• {{ $berita->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 20px; color: var(--text-dark); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 3.5rem;">
                            {{ $berita->title }}
                        </h4>
                        <a href="{{ route('berita.show', $berita->slug) }}" style="display: inline-flex; align-items: center; gap: 8px; color: #4f46e5; font-weight: 800; font-size: 0.9rem; transition: gap 0.3s;" onmouseenter="this.style.gap='14px'" onmouseleave="this.style.gap='8px'">
                            Baca Selengkapnya 
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 80px; background: #fbfcfe; border-radius: 40px; border: 2px dashed #f1f5f9;">
                    <div style="font-size: 3rem; margin-bottom: 20px;">🗞️</div>
                    <h5 style="font-weight: 800; color: var(--text-dark); font-size: 1.2rem;">Belum ada berita yang diterbitkan</h5>
                    <p>Nantikan update terbaru dari aksi-aksi kami di sini.</p>
                </div>
            @endforelse
        </div>

        @if($beritas->count() > 0)
        <div style="text-align: center; margin-top: 60px;">
            <a href="{{ route('pages.news') }}" class="btn btn-outline" style="padding: 18px 40px; border-radius: 20px; font-weight: 800; border-width: 2px;">
                Lihat Berita Lainnya
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-left: 8px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
            </a>
        </div>
        @endif
    </section>

    <!-- FAQ -->
    <section id="faqs" class="faq-section">
        <div class="section-title">
            <h2 style="font-size: 3rem; font-weight: 800; letter-spacing: -2px;">Paling <span>Sering</span> Ditanya</h2>
            <p>Penasaran dengan KOMBO? Simak rangkuman jawaban berikut.</p>
        </div>
        <div class="faq-container" x-data="{ active: null }">
            @foreach($faqs as $index => $faq)
                <div class="faq-item">
                    <button @click="active === {{ $index }} ? active = null : active = {{ $index }}" class="faq-trigger">
                        {{ $faq->question }}
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition: all 0.4s;" :style="active === {{ $index }} ? 'transform: rotate(45deg); color: #4f46e5;' : ''"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/></svg>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse x-cloak>
                        <div class="faq-content">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Map & Contact -->
    <section class="section" style="background: white;">
        <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1.12fr; gap: 100px; align-items: center; padding-bottom: 100px;">
            <div style="height: 520px; border-radius: 60px; overflow: hidden; border: 12px solid #f8fafc; box-shadow: 0 40px 80px rgba(0,0,0,0.06); transform: rotate(-1deg);">
                @if($profile && $profile->map_iframe)
                    {!! $profile->map_iframe !!}
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #94a3b8; font-weight: 800;">Google Maps tidak tersedia</div>
                @endif
            </div>
            <div>
                <span style="font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: 3px; font-size: 0.8rem; display: block; margin-bottom: 20px;">Support Hub</span>
                <h2 style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; line-height: 1.1; margin-bottom: 32px; color: var(--text-dark);">Rumah Kita <span>Bersama</span></h2>
                <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 48px; line-height: 1.8;">Sekretariat KOMBO adalah tempat di mana ide-ide besar mahasiswa Bondowoso digodok. Mari berkunjung!</p>
                
                <div style="display: grid; gap: 20px;">
                    <div style="display: flex; gap: 24px; align-items: center; background: #fbfcfe; padding: 28px; border-radius: 32px; border: 1px solid #f1f5f9;">
                        <div style="width: 56px; height: 56px; background: rgba(79, 70, 229, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #4f46e5; font-size: 1.5rem;">📞</div>
                        <div>
                            <div style="font-weight: 800; font-size: 0.7rem; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px;">Hotline Center</div>
                            <div style="font-weight: 800; font-size: 1.2rem; color: var(--text-dark);">{{ $profile->contact_phone ?? '-' }}</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 24px; align-items: center; background: #fbfcfe; padding: 28px; border-radius: 32px; border: 1px solid #f1f5f9;">
                        <div style="width: 56px; height: 56px; background: rgba(79, 70, 229, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #4f46e5; font-size: 1.5rem;">✉️</div>
                        <div>
                            <div style="font-weight: 800; font-size: 0.7rem; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px;">Official Email</div>
                            <div style="font-weight: 800; font-size: 1.2rem; color: var(--text-dark);">{{ $profile->contact_email ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
