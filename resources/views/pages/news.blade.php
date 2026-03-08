@extends('layouts.frontend')

@section('title', 'Berita & Kegiatan - KOMBO')

@section('styles')
<style>
    .news-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 32px; }
    .news-img { width: 100%; height: 260px; object-fit: cover; transition: transform 0.6s ease; }
    .card:hover .news-img { transform: scale(1.05); }
    .news-body { padding: 32px; flex-grow: 1; display: flex; flex-direction: column; }
    .news-date { font-size: 0.75rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
    .news-title { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); margin-bottom: 12px; line-height: 1.25; }
    .news-text { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 24px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .news-link { margin-top: auto; font-weight: 800; color: var(--primary); display: flex; align-items: center; gap: 4px; }
</style>
@endsection

@section('content')
    <!-- News Hero -->
    <section class="section" style="background: white; border-bottom: 1px solid #f1f5f9; text-align: center; padding: 140px 5% 100px;">
        <h1 style="font-size: 3.5rem; font-weight: 800; margin-bottom: 16px;">Cerita & Kabar Terbaru</h1>
        <p style="font-size: 1.125rem; color: var(--text-muted); max-width: 600px; margin: 0 auto;">Update terkini mengenai kegiatan dan berita dari keluarga besar KOMBO.</p>
    </section>

    <section class="section">
        <div class="news-grid">
            @forelse($beritas as $berita)
                <div class="card">
                    <div style="width: 100%; height: 260px; overflow: hidden; background: #f1f5f9;">
                        @if($berita->image)
                            <img src="{{ asset('storage/' . $berita->image) }}" class="news-img" alt="{{ $berita->title }}">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1;">
                                <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="1.5"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="news-body">
                        <span class="news-date">{{ $berita->created_at->format('d M Y') }}</span>
                        <h4 class="news-title">{{ $berita->title }}</h4>
                        <p class="news-text">{!! Str::limit(strip_tags($berita->content), 120) !!}</p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="news-link">Baca Selengkapnya <span>→</span></a>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 80px;">Belum ada berita yang diterbitkan.</p>
            @endforelse
        </div>

        <div style="margin-top: 64px;">
            {{ $beritas->links() }}
        </div>
    </section>
@endsection
