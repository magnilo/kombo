<x-app-layout>
    @section('admin_title', 'Input Massal Pengurus')

    <div class="max-w-6xl mx-auto py-4">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('leaders.index') }}" class="text-slate-400 font-bold text-sm flex items-center gap-2 hover:text-indigo-600 transition">
                ← Kembali ke List Pengurus
            </a>
            <div class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl text-xs font-bold">
                💡 Masukkan banyak data sekaligus tanpa upload foto (Foto bisa diupdate nanti)
            </div>
        </div>

        <form action="{{ route('leaders.bulk.store') }}" method="POST" enctype="multipart/form-data" x-data="{ rows: 10 }">
            @csrf
            <div class="bg-white rounded-[40px] border border-slate-100 shadow-2xl shadow-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr class="text-[10px] uppercase font-extrabold text-slate-400 tracking-widest">
                                <th class="px-8 py-5">Nama Lengkap</th>
                                <th class="px-8 py-5">Jabatan</th>
                                <th class="px-8 py-5">Divisi</th>
                                <th class="px-8 py-5">Foto</th>
                                <th class="px-8 py-5">Periode</th>
                                <th class="px-8 py-5">Angkatan</th>
                                <th class="px-8 py-5">Urutan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <template x-for="i in rows" :key="i">
                                <tr class="hover:bg-slate-50/30 transition">
                                    <td class="px-6 py-4">
                                        <input type="text" :name="'members[' + (i-1) + '][name]'" placeholder="Nama..."
                                               class="w-full px-4 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700 text-sm">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" :name="'members[' + (i-1) + '][position]'" placeholder="Jabatan..."
                                               class="w-full px-4 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700 text-sm">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" :name="'members[' + (i-1) + '][division]'" list="division-list" placeholder="Divisi..."
                                               class="w-full px-4 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700 text-sm">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="file" :name="'members[' + (i-1) + '][photo]'" class="text-[10px] text-slate-400">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" :name="'members[' + (i-1) + '][period]'" value="2024-2025"
                                               class="w-full px-4 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700 text-sm">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" :name="'members[' + (i-1) + '][batch]'" placeholder="2022"
                                               class="w-full px-4 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700 text-sm">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="number" :name="'members[' + (i-1) + '][order]'" :value="i-1"
                                               class="w-20 px-4 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700 text-sm text-center">
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="p-8 bg-slate-50 flex justify-between items-center border-t border-slate-100">
                    <button type="button" @click="rows++" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-xs hover:bg-slate-50 transition">
                        + Tambah Baris
                    </button>
                    <button type="submit" 
                            class="px-10 py-5 text-white rounded-2xl font-extrabold shadow-xl hover:-translate-y-1 transition-all active:scale-95"
                            style="background: #4f46e5;">
                        Simpan Semua Pengurus
                    </button>
                </div>
            </div>
        </form>
    </div>

    <datalist id="division-list">
        <option value="PSDM">
        <option value="Humas">
        <option value="Kominfo">
        <option value="KWU">
        <option value="BPH (Inti)">
    </datalist>
</x-app-layout>
