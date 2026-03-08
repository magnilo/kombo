<x-app-layout>
    @section('admin_title', isset($faq) ? 'Edit FAQ' : 'Tambah FAQ')

    <div class="max-w-2xl mx-auto py-4">
        <div class="mb-6">
            <a href="{{ route('faqs.index') }}" class="text-slate-400 font-bold text-sm flex items-center gap-2 hover:text-cyan-600 transition">
                ← Kembali ke List FAQ
            </a>
        </div>

        <div class="bg-white rounded-[40px] border border-slate-100 shadow-2xl shadow-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ isset($faq) ? route('faqs.update', $faq->id) : route('faqs.store') }}" method="POST" class="space-y-8">
                    @csrf
                    @if(isset($faq)) @method('PUT') @endif
                    
                    <div class="space-y-2">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Pertanyaan</label>
                        <input type="text" name="question" value="{{ old('question', $faq->question ?? '') }}" placeholder="Apa itu KOMBO?" required
                               class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-cyan-500 focus:bg-white transition-all font-bold text-slate-700">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Jawaban</label>
                        <textarea name="answer" rows="5" placeholder="KOMBO adalah..." required
                               class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-cyan-500 focus:bg-white transition-all font-bold text-slate-700">{{ old('answer', $faq->answer ?? '') }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Urutan Tampilan</label>
                        <input type="number" name="order" value="{{ old('order', $faq->order ?? 0) }}" required
                               class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-cyan-500 focus:bg-white transition-all font-bold text-slate-700">
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6">
                        <button type="submit" class="px-10 py-5 bg-cyan-600 text-white rounded-2xl font-extrabold shadow-xl shadow-cyan-200 hover:bg-cyan-700 hover:-translate-y-1 transition-all active:scale-95">
                            {{ isset($faq) ? 'Simpan Perubahan' : 'Buat FAQ' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
