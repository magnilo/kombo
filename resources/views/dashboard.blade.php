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
                    Selamat Datang, {{ Auth::user()->name }}! 👋
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
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl mb-4">📰</div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Berita</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $countBerita }} Artikel</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl mb-4">📅</div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Agenda Aktif</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $countJadwal }} Proker</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl mb-4">👥</div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Pengurus</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $countLeader }} Anggota</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl mb-4">🎓</div>
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Alumni</div>
                <div class="text-2xl font-extrabold text-slate-800">{{ $countAlumni }} Orang</div>
            </div>
        </div>

        <!-- Quick Access Table -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <h3 class="font-bold text-lg text-slate-800">Aktivitas Terkini</h3>
                <a href="{{ route('berita.index') }}" class="text-blue-600 text-sm font-bold hover:underline">Lihat Semua Berita</a>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-50">
                            <th class="px-6 py-4">Informasi</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentBeritas as $berita)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-700 text-sm">{{ $berita->title }}</div>
                                <div class="text-xs text-slate-400">Postingan berita terbaru organisasi.</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-bold uppercase">Berita</span>
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-slate-500">{{ $berita->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-slate-400 font-medium italic">Belum ada aktivitas terbaru...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
