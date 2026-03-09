@extends('layouts.frontend')

@section('title', 'Beranda - KOMBO')

@section('styles')
<style>
    /* Hero Section */
    .hero { 
        padding: 120px 5% 80px; 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 40px; 
        align-items: center; 
        background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.08), transparent 45%);
    }
    .hero-content { animation: fadeInUp 0.8s ease-out; }
    .hero-content h1 { font-size: clamp(2.5rem, 8vw, 4.8rem); line-height: 1.1; font-weight: 800; letter-spacing: -2px; margin-bottom: 24px; color: var(--text-dark); }
    .hero-content h1 span { color: #4f46e5; }
    .hero-content p { font-size: clamp(1rem, 2vw, 1.25rem); color: var(--text-muted); margin-bottom: 40px; max-width: 540px; line-height: 1.7; }
    
    .hero-image { position: relative; animation: float 6s ease-in-out infinite; }
    .hero-image img { width: 100%; max-width: 500px; height: auto; filter: drop-shadow(0 40px 80px rgba(79, 70, 229, 0.15)); }

    /* Stats Section */
    .stats-section { padding: 0 5% 60px; margin-top: -40px; position: relative; z-index: 10; }
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
    .stat-card { background: white; padding: 30px 20px; border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.02); transition: all 0.3s; }
    .stat-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(79, 70, 229, 0.08); }
    .stat-card h3 { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; color: #4f46e5; margin-bottom: 4px; letter-spacing: -1px; }
    .stat-card p { font-weight: 700; color: var(--text-muted); text-transform: uppercase; font-size: 0.65rem; letter-spacing: 1px; }

    /* About Section */
    .about-section { padding: 80px 5%; background: #ffffff; }
    .about-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 60px; align-items: start; }
    .about-content h2 { font-size: clamp(2rem, 6vw, 3.5rem); font-weight: 800; letter-spacing: -1.5px; line-height: 1.2; margin-bottom: 24px; }
    .about-text { font-size: 1.1rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 40px; text-align: justify; }
    
    .philo-box { display: grid; gap: 20px; }
    .philo-item { background: #fbfcfe; border-radius: 32px; padding: 30px; border: 1px solid #f1f5f9; }
    .philo-item:hover { background: white; border-color: #4f46e5; box-shadow: 0 15px 30px rgba(79, 70, 229, 0.05); transform: translateX(10px); }
    .philo-icon { width: 52px; height: 52px; border-radius: 16px; background: #eef2ff; color: #4f46e5; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px; }
    .philo-icon svg { width: 26px; height: 26px; }
    .philo-item h4 { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); margin-bottom: 12px; }
    .philo-item p { font-size: 1rem; color: var(--text-muted); line-height: 1.7; }

    /* Vision Mission Dark UI */
    /* Vision Mission */
    .vm-section { padding: 40px 5% 80px; }
    .vm-card { background: #0f172a; border-radius: 40px; padding: 60px 5%; color: white; position: relative; overflow: hidden; }
    .vm-inner { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
    .vm-label { display: inline-block; font-weight: 800; font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; color: #94a3b8; margin-bottom: 16px; }
    
    .v-text { font-size: clamp(1.5rem, 5vw, 2.5rem); font-weight: 800; line-height: 1.2; margin-bottom: 30px; }
    .m-list { display: grid; gap: 16px; margin-top: 10px; }
    .m-item { display: grid; grid-template-columns: 46px 1fr; gap: 14px; align-items: start; background: rgba(148, 163, 184, 0.08); border: 1px solid rgba(148, 163, 184, 0.18); border-radius: 18px; padding: 14px; }
    .m-num { width: 34px; height: 34px; border-radius: 10px; background: #4f46e5; color: white; font-weight: 800; font-size: 0.9rem; display: inline-flex; align-items: center; justify-content: center; margin-top: 2px; }
    .m-item p { margin: 0; font-size: 0.98rem; color: #cbd5e1; line-height: 1.65; }

    /* FAQ */
    .faq-section { padding: 120px 10%; background: #fbfcfe; }
    .faq-container { max-width: 900px; margin: 0 auto; }
    .faq-item { background: white; border-radius: 32px; border: 1px solid #f1f5f9; margin-bottom: 20px; overflow: hidden; transition: all 0.3s; }
    .faq-item:hover { border-color: #4f46e5; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .faq-trigger { width: 100%; padding: 32px 40px; text-align: left; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 800; font-size: 1.2rem; color: var(--text-dark); transition: all 0.2s; }
    .faq-content { padding: 0 40px 32px; color: var(--text-muted); line-height: 1.8; font-size: 1.1rem; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes float { 0% { transform: translateY(0); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0); } }

    /* Global Responsiveness Fix */
    * { box-sizing: border-box; }
    html, body { overflow-x: hidden; width: 100%; position: relative; }

    /* Media Queries */
    @media (max-width: 1024px) {
        .hero { grid-template-columns: 1fr; text-align: center; padding: 120px 5% 60px; }
        .hero-btns { justify-content: center; flex-direction: column; width: 100%; max-width: 400px; margin: 0 auto; }
        .hero-image { order: -1; }
        .hero-image img { max-width: 250px; }
        
        .stats-grid { grid-template-columns: 1fr; }
        .about-grid { grid-template-columns: 1fr; gap: 40px; }
        .philo-box { grid-template-columns: 1fr; }
        .vm-inner { grid-template-columns: 1fr; gap: 40px; }
        .m-item { grid-template-columns: 40px 1fr; }
        
        .contact-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
        .contact-map { height: 350px !important; order: 1; transform: rotate(0deg) !important; border-radius: 30px !important; width: 100% !important; }
    }

    @media (max-width: 768px) {
        .section { padding: 60px 20px; }
        .hero { padding: 100px 20px 40px !important; }
        .hero-content h1 { font-size: 2.2rem !important; }
        .hero-content p { font-size: 1rem !important; }
        
        .stats-grid, .about-grid, .vm-inner, .news-grid, .contact-grid {
            display: flex !important;
            flex-direction: column !important;
            gap: 24px !important;
            width: 100% !important;
        }
        
        .stat-card, .card, .philo-item { width: 100% !important; flex: 0 1 auto !important; }
        .section-title h2 { font-size: 2rem !important; }
        .section-title p { font-size: 1rem !important; }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div style="display:inline-block; padding: 10px 20px; background: rgba(79, 70, 229, 0.05); color: #4f46e5; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2.5px; margin-bottom: 24px;">Bendebhesah Jaya</div>
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
                    <span class="philo-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l3 3 5-5m-9 7h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></span>
                    <h4>Kekeluargaan</h4>
                    <p>Karena di tanah rantau, teman se-organisasi adalah keluarga kedua yang paling berharga.</p>
                </div>
                <div class="philo-item">
                    <span class="philo-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></span>
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
        
        <div class="news-grid" style="display: flex; flex-wrap: wrap; gap: 32px; max-width: 1240px; margin: 0 auto; justify-content: center; padding: 0 20px;">
            @forelse($beritas as $berita)
                <div class="card" style="flex: 0 1 380px; width: 100%; border-radius: 40px; padding: 16px; background: white; border: 1px solid rgba(0,0,0,0.03);">
                    <div style="aspect-ratio: 16/10; overflow: hidden; border-radius: 30px;">
                        @if($berita->image)
                            <img src="{{ asset('storage/' . $berita->image) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $berita->title }}">
                        @else
                            <div style="width: 100%; height: 100%; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #94a3b8;"><svg style="width: 52px; height: 52px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zM7 8h10M7 12h6M7 16h10"/></svg></div>
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
                    <div style="margin-bottom: 20px; color: #94a3b8;"><svg style="width: 52px; height: 52px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zM7 8h10M7 12h6M7 16h10"/></svg></div>
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

    <section class="section" style="background: white;">
        <div class="contact-grid" style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1.12fr; align-items: center;">
            <div class="contact-map" style="height: 520px; border-radius: 60px; overflow: hidden; border: 12px solid #f8fafc; box-shadow: 0 40px 80px rgba(0,0,0,0.06); transform: rotate(-1deg);">
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
                        <div style="width: 56px; height: 56px; background: rgba(79, 70, 229, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #4f46e5;"><svg style="width: 26px; height: 26px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a2 2 0 011.94 1.515l.57 2.28a2 2 0 01-.54 1.94L9.2 9.8a16 16 0 006 6l1.065-1.05a2 2 0 011.94-.54l2.28.57A2 2 0 0122 16.72V20a2 2 0 01-2 2h-1C10.163 22 2 13.837 2 3V2a1 1 0 011-1z"/></svg></div>
                        <div>
                            <div style="font-weight: 800; font-size: 0.7rem; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px;">Hotline Center</div>
                            <div style="font-weight: 800; font-size: 1.2rem; color: var(--text-dark);">{{ $profile->contact_phone ?? '-' }}</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 24px; align-items: center; background: #fbfcfe; padding: 28px; border-radius: 32px; border: 1px solid #f1f5f9;">
                        <div style="width: 56px; height: 56px; background: rgba(79, 70, 229, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #4f46e5;"><svg style="width: 26px; height: 26px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6m0 8H3a2 2 0 01-2-2V8a2 2 0 012-2h18a2 2 0 012 2v6a2 2 0 01-2 2z"/></svg></div>
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
