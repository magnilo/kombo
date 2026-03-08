<x-app-layout>
    @section('admin_title', 'Program Kerja')

    <div class="space-y-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Agenda Mendatang</h3>
            <a href="{{ route('jadwal.create') }}" class="px-6 py-3 bg-emerald-600 text-white rounded-2xl font-extrabold flex items-center gap-2 hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Tambah Jadwal
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50 border-b border-slate-50">
                        <tr class="text-[10px] uppercase font-extrabold text-slate-400 tracking-widest">
                            <th class="px-8 py-5">Event</th>
                            <th class="px-8 py-5">Waktu & Lokasi</th>
                            <th class="px-8 py-5 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($jadwals as $jadwal)
                            <tr class="hover:bg-slate-50/30 transition group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-extrabold text-sm flex-col leading-none">
                                            <span>{{ \Carbon\Carbon::parse($jadwal->date)->format('d') }}</span>
                                            <span class="text-[9px] uppercase mt-1">{{ \Carbon\Carbon::parse($jadwal->date)->format('M') }}</span>
                                        </div>
                                        <div>
                                            <div class="font-extrabold text-slate-800">{{ $jadwal->title }}</div>
                                            @if($jadwal->division)
                                                <span class="inline-block mt-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-700 rounded-lg font-bold uppercase">{{ $jadwal->division }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-slate-600">📍 {{ $jadwal->location }}</div>
                                    <div class="text-xs text-slate-400 font-medium mt-1">⏰ {{ \Carbon\Carbon::parse($jadwal->time)->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="p-3 bg-slate-50 text-slate-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
