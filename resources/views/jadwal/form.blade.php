<x-app-layout>
    @section('admin_title', 'Buat Jadwal Baru')

    <div class="max-w-3xl mx-auto py-4">
        <div class="mb-6">
            <a href="{{ route('jadwal.index') }}" class="text-slate-400 font-bold text-sm flex items-center gap-2 hover:text-emerald-600 transition">
                ← Kembali ke List Jadwal
            </a>
        </div>

        <div class="bg-white rounded-[40px] border border-slate-100 shadow-2xl shadow-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ isset($jadwal) ? route('jadwal.update', $jadwal->id) : route('jadwal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @if(isset($jadwal)) @method('PUT') @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Nama Kegiatan</label>
                            <input type="text" name="title" value="{{ old('title', $jadwal->title ?? '') }}" placeholder="Contoh: Rapat Kerja" required
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-emerald-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Divisi Pelaksana</label>
                            <input type="text" name="division" value="{{ old('division', $jadwal->division ?? '') }}" list="division-list" placeholder="Pilih atau ketik..."
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-emerald-500 focus:bg-white transition-all font-bold text-slate-700">
                            <datalist id="division-list">
                                <option value="PSDM"><option value="Humas"><option value="Kominfo"><option value="KWU">
                            </datalist>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Tanggal</label>
                            <input type="date" name="date" value="{{ old('date', $jadwal->date ?? '') }}" required
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-emerald-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Waktu</label>
                            <input type="time" name="time" value="{{ old('time', isset($jadwal) ? \Carbon\Carbon::parse($jadwal->time)->format('H:i') : '') }}" required
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-emerald-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $jadwal->location ?? '') }}" placeholder="Contoh: Gedung PKM Polije" required
                               class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-emerald-500 focus:bg-white transition-all font-bold text-slate-700">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Deskripsi (Singkat)</label>
                        <textarea name="description" rows="3" class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-emerald-500 focus:bg-white transition-all font-bold text-slate-700">{{ old('description', $jadwal->description ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6">
                        <button type="submit" class="px-10 py-5 bg-emerald-600 text-white rounded-2xl font-extrabold shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all active:scale-95">
                            {{ isset($jadwal) ? 'Simpan Perubahan' : 'Publish Agenda' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
