<x-app-layout>
    @section('admin_title', 'Struktur Organisasi')

    <div class="space-y-8">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm gap-6">
            <div>
                <h3 class="text-xl font-extrabold text-slate-800">Kabinet Kombo</h3>
                <p class="text-slate-500 text-sm font-medium mt-1">Kelola anggota per divisi dengan lebih teratur.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('leaders.history') }}" class="px-6 py-3 bg-slate-50 text-slate-500 rounded-2xl font-extrabold text-xs flex items-center gap-2 hover:bg-slate-100 transition shadow-sm border border-slate-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Lihat Sejarah
                </a>
                <a href="{{ route('leaders.bulk.create') }}" class="px-6 py-3 bg-white border-2 border-slate-100 text-slate-600 rounded-2xl font-extrabold text-xs flex items-center gap-2 hover:bg-slate-50 hover:border-indigo-100 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    Input Massal
                </a>
                <a href="{{ route('leaders.create') }}" 
                   class="px-6 py-3 text-white rounded-2xl font-extrabold text-xs flex items-center gap-2 hover:-translate-y-1 transition-all shadow-lg shadow-indigo-100"
                   style="background: #4f46e5;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    Tambah Satu
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        @forelse($groupedLeaders as $division => $members)
            <div class="space-y-4">
                <div class="flex items-center gap-4 ml-4">
                    <div class="h-px bg-slate-100 flex-1"></div>
                    <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-widest bg-white px-4 py-1 rounded-full border border-slate-50 shadow-sm">
                        {{ $division ?: 'Tanpa Divisi' }}
                    </h4>
                    <div class="h-px bg-slate-100 flex-1"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($members as $leader)
                        <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-50/50 transition-all group flex items-start gap-4 h-full relative">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-sm flex-shrink-0 border border-slate-50">
                                @if($leader->photo)
                                    <img src="{{ asset('storage/' . $leader->photo) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center font-bold text-slate-300">{{ substr($leader->name, 0, 1) }}</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0 pr-10">
                                <div class="font-extrabold text-slate-800 truncate">{{ $leader->name }}</div>
                                <div class="text-xs font-bold text-indigo-600 mt-0.5">{{ $leader->position }}</div>
                                <div class="flex gap-2 mt-2">
                                    @if($leader->period)
                                        <span class="text-[9px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-black uppercase">{{ $leader->period }}</span>
                                    @endif
                                    @if($leader->batch)
                                        <span class="text-[9px] bg-indigo-50 text-indigo-400 px-2 py-0.5 rounded-full font-black uppercase">Angkatan {{ $leader->batch }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="absolute top-6 right-6 flex flex-col gap-2">
                                <a href="{{ route('leaders.edit', $leader->id) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-indigo-100" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('leaders.archive', $leader->id) }}" method="POST" onsubmit="return confirm('Pindahkan ke Sejarah?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="p-2 bg-amber-50 text-amber-600 rounded-lg opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-amber-100" title="Arsip ke Sejarah">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                    </button>
                                </form>
                                <form action="{{ route('leaders.destroy', $leader->id) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-400 rounded-lg opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-red-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white p-20 rounded-[40px] border border-slate-100 text-center border-dashed">
                <div class="text-6xl mb-6">👥</div>
                <h4 class="font-extrabold text-slate-800 text-xl">Belum ada pengurus terdaftar</h4>
                <p class="text-slate-400 font-medium mt-2 mb-10">Mulai bangun struktur organisasi Anda sekarang.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('leaders.bulk.create') }}" class="px-8 py-4 bg-white border-2 border-slate-100 text-slate-600 rounded-2xl font-extrabold hover:bg-slate-50 transition shadow-sm">
                        Input Massal
                    </a>
                    <a href="{{ route('leaders.create') }}" 
                       class="px-8 py-4 text-white rounded-2xl font-extrabold shadow-xl shadow-indigo-100 hover:-translate-y-1 transition-all"
                       style="background: #4f46e5;">
                        Tambah Satu
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</x-app-layout>
