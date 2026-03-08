<x-app-layout>
    @section('admin_title', 'Daftar Calon Anggota')

    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
            <div>
                <h3 class="font-bold text-lg text-slate-800">Data Pendaftar Terbaru</h3>
                <p class="text-slate-500 text-sm">Berikut adalah daftar mahasiswa yang mendaftar menjadi anggota KOMBO.</p>
            </div>
            <a href="{{ route('registrations.export') }}" class="px-6 py-3 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-700 transition shadow-lg shadow-emerald-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export Excel (.xlsx)
            </a>
        </div>

        <div class="p-4 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-50">
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Jurusan / Prodi</th>
                        <th class="px-6 py-4">Domisili</th>
                        <th class="px-6 py-4">Kampus</th>
                        <th class="px-6 py-4">Divisi Minat</th>
                        <th class="px-6 py-4">Waktu Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-700">{{ $reg->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-700">{{ $reg->jurusan }}</div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-tighter">{{ $reg->prodi }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $reg->domisili }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-bold uppercase">
                                {{ $reg->campus }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-bold uppercase">
                                {{ $reg->division->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-slate-500">
                            {{ $reg->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">Belum ada pendaftar masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($registrations->hasPages())
        <div class="p-8 border-t border-slate-50 bg-slate-50/10">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
