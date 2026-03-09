<x-app-layout>
    @section('admin_title', 'Dashboard')

    <div class="space-y-8">
        <!-- Welcome Stats -->
        <div class="relative overflow-hidden" 
             style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); 
                    border-radius: 32px; 
                    padding: 48px; 
                    color: white; 
                    box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.1), 0 10px 10px -5px rgba(79, 70, 229, 0.04);">
            
            <div style="position: relative; z-index: 10;">
                <h2 style="font-size: 1.875rem; font-weight: 800; margin-bottom: 12px; color: white; letter-spacing: -0.5px;">
                    Selamat Datang, {{ Auth::user()->name }}
                </h2>
                <p style="font-size: 1.125rem; color: rgba(255, 255, 255, 0.9); max-width: 500px; line-height: 1.6; font-weight: 500;">
                    Panel kendali untuk mengelola seluruh ekosistem digital KOMBO. Pilih menu di samping untuk mulai beraksi.
                </p>
            </div>
            
            <!-- Decorative Elements -->
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; filter: blur(40px);"></div>
            <div style="position: absolute; bottom: -30px; left: 20%; width: 100px; height: 100px; background: rgba(255,255,255,0.05); border-radius: 50%; filter: blur(20px);"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zM7 8h10M7 12h6M7 16h10"/></svg></div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Berita</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $stats['berita'] }} Artikel</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Agenda Aktif</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $stats['jadwal'] }} Proker</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-4a4 4 0 11-8 0 4 4 0 018 0zm-10 0a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Pengurus</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $stats['leader'] }} Anggota</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.083 12.083 0 0119 17.764L12 21l-7-3.236a12.083 12.083 0 01.84-7.764L12 14z"/></svg></div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Alumni</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $stats['alumni'] }} Orang</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm ring-4 ring-blue-500/5">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m7 4H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2z"/></svg></div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Calon Anggota</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $stats['registration'] }} Daftar</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent News -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <h3 class="font-bold text-lg text-slate-800">Berita Terbaru</h3>
                    <a href="{{ route('berita.index') }}" class="text-blue-600 text-sm font-bold hover:underline">Lihat Semua</a>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-slate-50">
                            @forelse($recentBeritas as $berita)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-700 text-sm">{{ $berita->title }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{{ $berita->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr><td class="px-6 py-10 text-center text-slate-400 italic">Kosong</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Registrations -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <h3 class="font-bold text-lg text-slate-800">Pendaftar Baru</h3>
                    <a href="{{ route('registrations.index') }}" class="text-blue-600 text-sm font-bold hover:underline">Lihat Semua</a>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-slate-50">
                            @forelse($recentRegistrations as $reg)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-700 text-sm">{{ $reg->name }}</div>
                                    <div class="text-[10px] text-blue-500 uppercase font-bold tracking-widest">{{ $reg->division->name }} • {{ $reg->campus }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr><td class="px-6 py-10 text-center text-slate-400 italic">Belum ada pendaftar baru</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
