<x-app-layout>
    @section('admin_title', isset($leader) ? 'Edit Pengurus' : 'Tambah Pengurus')

    <div class="max-w-3xl mx-auto py-4">
        <div class="mb-6">
            <a href="{{ route('leaders.index') }}" class="text-slate-400 font-bold text-sm flex items-center gap-2 hover:text-indigo-600 transition">
                ← Kembali ke List Pengurus
            </a>
        </div>

        <div class="bg-white rounded-[40px] border border-slate-100 shadow-2xl shadow-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ isset($leader) ? route('leaders.update', $leader->id) : route('leaders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @if(isset($leader)) @method('PUT') @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $leader->name ?? '') }}" placeholder="Ahmad ..." required
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Jabatan</label>
                            <input type="text" name="position" value="{{ old('position', $leader->position ?? '') }}" placeholder="Ketua ..." required
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Periode (Tahun)</label>
                            <input type="text" name="period" value="{{ old('period', $leader->period ?? '2024-2025') }}" placeholder="2024-2025"
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Angkatan</label>
                            <input type="text" name="batch" value="{{ old('batch', $leader->batch ?? '') }}" placeholder="2022"
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Divisi</label>
                            <input type="text" name="division" value="{{ old('division', $leader->division ?? '') }}" list="division-list"
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Urutan (Angka)</label>
                            <input type="number" name="order" value="{{ old('order', $leader->order ?? 0) }}" required
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="p-8 bg-slate-50 rounded-[32px] border-2 border-dashed border-slate-200">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Foto Profil</label>
                        @if(isset($leader) && $leader->photo)
                            <img src="{{ asset('storage/' . $leader->photo) }}" class="w-20 h-20 rounded-2xl object-cover mb-4">
                        @endif
                        <input type="file" name="photo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6">
                        <button type="submit" 
                                class="px-10 py-5 text-white rounded-2xl font-extrabold shadow-xl hover:-translate-y-1 transition-all active:scale-95"
                                style="background: #4f46e5;">
                            {{ isset($leader) ? 'Update Pengurus' : 'Simpan Pengurus' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
