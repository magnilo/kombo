@extends('layouts.frontend')

@section('title', $berita->title . ' - KOMBO')

@section('styles')
<style>
    .article-container { max-width: 900px; margin: 0 auto; padding: 60px 5%; }
    .article-card { background: white; border-radius: 40px; overflow: hidden; border: 1px solid var(--border); box-shadow: var(--shadow-xl); }
    .article-hero { width: 100%; height: 500px; object-fit: cover; }
    .article-content { padding: 60px; }
    .article-meta { margin-bottom: 24px; color: var(--primary); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.875rem; display: flex; align-items: center; gap: 8px; }
    .article-title { font-size: 3rem; font-weight: 800; color: var(--text-dark); line-height: 1.1; margin-bottom: 32px; }
    .prose { color: #334155; font-size: 1.125rem; line-height: 1.8; }
    .prose p { margin-bottom: 1.5em; }
    .prose h2, .prose h3 { margin-top: 2em; margin-bottom: 1em; color: var(--text-dark); font-weight: 800; }
    
    @media (max-width: 768px) {
        .article-title { font-size: 2rem; }
        .article-content { padding: 32px 20px; }
        .article-hero { height: 300px; }
    }
</style>
@endsection

@section('content')
    <div class="article-container">
        <a href="{{ route('pages.news') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); font-weight: 700; margin-bottom: 40px; transition: color 0.3s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Berita
        </a>

        <div class="article-card">
            @if($berita->image)
                <img src="{{ asset('storage/' . $berita->image) }}" class="article-hero" alt="{{ $berita->title }}">
            @else
                <div style="width: 100%; height: 300px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #cbd5e1;">📰</div>
            @endif
            
            <div class="article-content">
                <div class="article-meta">
                    <span>{{ $berita->created_at->format('d F Y') }}</span>
                    <span style="opacity: 0.3; font-weight: 400;">/</span>
                    <span>Admin Organisasi</span>
                </div>
                
                <h1 class="article-title">{{ $berita->title }}</h1>
                
                <div class="prose">
                    {!! nl2br($berita->content) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
