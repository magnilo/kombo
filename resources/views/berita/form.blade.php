<x-app-layout>
    @section('admin_title', 'Tulis Artikel Baru')

    <div class="max-w-3xl mx-auto py-4">
        <div class="mb-6">
            <a href="{{ route('berita.index') }}" class="text-slate-400 font-bold text-sm flex items-center gap-2 hover:text-blue-600 transition">
                ← Kembali ke Manajemen Berita
            </a>
        </div>

        <div class="bg-white rounded-[40px] border border-slate-100 shadow-2xl shadow-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Judul Headline</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: KOMBO Gelar Aksi Sosial..." required
                               class="w-full px-8 py-5 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700 text-lg">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Konten Berita</label>
                        <textarea name="content" id="content" rows="12" class="w-full px-8 py-5 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white transition-all font-medium text-slate-600 leading-relaxed">{{ old('content') }}</textarea>
                    </div>

                    <div class="p-8 bg-slate-50 rounded-[32px] border-2 border-dashed border-slate-200">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Gambar Unggulan</label>
                        <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6">
                        <button type="submit" class="px-10 py-5 bg-blue-600 text-white rounded-2xl font-extrabold shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all active:scale-95">
                            Publikasikan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
    <script src="https://cdn.tiny.cloud/1/83zkd265oyxun0axxtcp2f83bmd08ma3vyu3asc4mlfhggpo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            menubar: false,
            plugins: 'link lists',
            toolbar: 'undo redo | formatselect | bold italic underline | bullist numlist | link',
            branding: false,
            height: 400,
            setup: function (editor) { editor.on('change', function () { editor.save(); }); }
        });
    </script>
    @endsection
</x-app-layout>
