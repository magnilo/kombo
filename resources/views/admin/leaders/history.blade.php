<x-app-layout>
    @section('admin_title', 'Sejarah Kepengurusan')

    <div class="space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('leaders.index') }}" class="p-4 bg-white rounded-2xl border border-slate-100 shadow-sm text-slate-400 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h3 class="text-xl font-extrabold text-slate-800">Arsip Sejarah Kabinet</h3>
                <p class="text-slate-500 text-sm font-medium mt-1">Daftar pengurus dari periode-periode sebelumnya.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold">
                {{ session('success') }}
            </div>
        @endif

        @forelse($pastLeaders as $period => $members)
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <h4 class="px-6 py-2 bg-slate-800 text-white rounded-full font-black text-xs tracking-widest uppercase">
                        Periode {{ $period }}
                    </h4>
                    <div class="h-px bg-slate-200 flex-1"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($members as $leader)
                        <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm opacity-75 hover:opacity-100 transition-all group relative">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                    @if($leader->photo)
                                        <img src="{{ asset('storage/' . $leader->photo) }}" class="w-full h-full object-cover grayscale">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 font-bold">{{ substr($leader->name, 0, 1) }}</div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-800 truncate text-sm">{{ $leader->name }}</div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $leader->position }}</div>
                                    @if($leader->batch)
                                        <div class="text-[9px] text-indigo-400 font-black mt-1">ANGKATAN {{ $leader->batch }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="absolute top-4 right-4 flex gap-1">
                                <form action="{{ route('leaders.restore', $leader->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-indigo-100" title="Aktifkan Kembali">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m0 0H15"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white p-20 rounded-[40px] border border-slate-100 text-center">
                <div class="text-6xl mb-6">📂</div>
                <h4 class="font-extrabold text-slate-400 text-xl">Arsip sejarah masih kosong</h4>
            </div>
        @endforelse
    </div>
</x-app-layout>
