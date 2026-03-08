<x-app-layout>
    @section('admin_title', 'Manajemen Divisi')

    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
            <div>
                <h3 class="font-bold text-lg text-slate-800">Daftar Divisi</h3>
                <p class="text-slate-500 text-sm">Kelola informasi mengenai divisi-divisi yang ada di KOMBO.</p>
            </div>
            <a href="{{ route('divisions.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v12m6-6H6"/></svg>
                Tambah Divisi
            </a>
        </div>

        <div class="p-6 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-50">
                        <th class="px-6 py-4">Nama Divisi</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($divisions as $div)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg">{!! $div->icon ?? '💠' !!}</div>
                                <div class="font-bold text-slate-700">{{ $div->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500 max-w-md truncate">{{ $div->description }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-slate-600">{{ $div->order }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('divisions.edit', $div) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('divisions.destroy', $div) }}" method="POST" onsubmit="return confirm('Hapus divisi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">Belum ada divisi yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
