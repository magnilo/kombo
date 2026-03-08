<x-app-layout>
    @section('admin_title', 'Edit Divisi')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                <h3 class="font-bold text-lg text-slate-800">Edit Informasi Divisi</h3>
                <p class="text-slate-500 text-sm">Perbarui informasi mengenai divisi {{ $division->name }}.</p>
            </div>

            <form action="{{ route('divisions.update', $division) }}" method="POST" class="p-8 space-y-6">
                @csrf @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 ml-1">Nama Divisi</label>
                        <input type="text" name="name" value="{{ $division->name }}" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition outline-none font-medium" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 ml-1">Icon (Emoji/HTML)</label>
                        <input type="text" name="icon" value="{{ $division->icon }}" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition outline-none font-medium">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Deskripsi Divisi</label>
                    <textarea name="description" rows="5" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition outline-none font-medium" required>{{ $division->description }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Urutan Tampil (Order)</label>
                    <input type="number" name="order" value="{{ $division->order }}" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition outline-none font-medium" required>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Perbarui Divisi
                    </button>
                    <a href="{{ route('divisions.index') }}" class="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
