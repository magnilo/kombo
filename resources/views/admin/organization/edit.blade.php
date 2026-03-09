<x-app-layout>
    @section('admin_title', 'Update Profil Web')

    <div class="max-w-4xl mx-auto py-8">
        @if(session('success'))
            <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-3xl flex items-center gap-4 animate-fadeIn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0"/></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-2xl shadow-slate-200/50 rounded-[40px] border border-slate-100 overflow-hidden">
            <div class="bg-slate-50/50 px-10 py-8 border-b border-slate-100">
                <h3 class="text-xl font-extrabold text-slate-800">Identitas Organisasi</h3>
                <p class="text-slate-500 text-sm font-medium mt-1">Data yang muncul di halaman Beranda dan Tentang Kami.</p>
            </div>

            <div class="p-10">
                <form action="{{ route('organization.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Nama Organisasi</label>
                            <input type="text" name="name" value="{{ old('name', $profile->name) }}"
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Slogan / Tagline</label>
                            <input type="text" name="slogan" value="{{ old('slogan', $profile->slogan) }}"
                                   class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Sejarah Singkat Organisasi</label>
                        <textarea name="history" rows="4" class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700 leading-relaxed">{{ old('history', $profile->history) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Filosofi Nama/Logo</label>
                        <textarea name="philosophy" rows="3" class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700 leading-relaxed">{{ old('philosophy', $profile->philosophy) }}</textarea>
                    </div>

                    <div class="p-8 bg-slate-50 rounded-[32px] border-2 border-dashed border-slate-200">
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Hero Image / Logo Besar</label>
                        @if($profile->hero_image)
                            <img src="{{ asset('storage/' . $profile->hero_image) }}" class="w-20 h-20 rounded-2xl object-cover mb-4">
                        @endif
                        <input type="file" name="hero_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Visi Utama</label>
                            <textarea name="vision" rows="3" class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">{{ old('vision', $profile->vision) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Misi (Satu baris per poin)</label>
                            <textarea name="mission" rows="3" class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700 leading-relaxed">{{ old('mission', $profile->mission) }}</textarea>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-slate-50">
                        <h4 class="text-sm font-black text-slate-800 mb-6 flex items-center gap-3 italic">
                            <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center not-italic"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656l-2 2a4 4 0 01-5.656-5.656l1-1m3-3l2-2a4 4 0 015.656 5.656l-1 1"/></svg></span>
                            Kontak & Media Sosial
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">WhatsApp / Telepon</label>
                                <input type="text" name="contact_phone" value="{{ old('contact_phone', $profile->contact_phone) }}" placeholder="0812..."
                                       class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Email Resmi</label>
                                <input type="email" name="contact_email" value="{{ old('contact_email', $profile->contact_email) }}" placeholder="email@kombo.org"
                                       class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Link Instagram (URL)</label>
                                <input type="url" name="instagram_url" value="{{ old('instagram_url', $profile->instagram_url) }}" placeholder="https://instagram.com/..."
                                       class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Link YouTube (URL)</label>
                                <input type="url" name="youtube_url" value="{{ old('youtube_url', $profile->youtube_url) }}" placeholder="https://youtube.com/..."
                                       class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-slate-50">
                        <h4 class="text-sm font-black text-slate-800 mb-6 flex items-center gap-3 italic">
                            <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center not-italic"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4z"/></svg></span>
                            Branding Footer
                        </h4>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Deskripsi Singkat di Footer</label>
                            <textarea name="footer_description" rows="3" placeholder="Platform kolaborasi digital mahasiswa Bondowoso..."
                                      class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700 leading-relaxed">{{ old('footer_description', $profile->footer_description) }}</textarea>
                            <p class="text-[10px] text-slate-400 mt-2 font-medium">Kalimat pendek yang muncul di bawah logo KOMBO pada bagian paling bawah web.</p>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-slate-50">
                        <h4 class="text-sm font-black text-slate-800 mb-6 flex items-center gap-3 italic">
                            <span class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center not-italic"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>
                            Lokasi (Maps)
                        </h4>
                        <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Embed Kode Google Maps (iFrame)</label>
                        <textarea name="map_iframe" rows="3" placeholder='<iframe src="..." ...></iframe>'
                                  class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-mono text-xs text-slate-600">{{ old('map_iframe', $profile->map_iframe) }}</textarea>
                        <p class="text-[10px] text-slate-400 mt-2 font-medium">Buka Google Maps > Share > Embed a map > Copy HTML.</p>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-10">
                        <button type="submit" class="px-10 py-4 bg-blue-600 text-white rounded-2xl font-extrabold shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all active:scale-95">
                            Update Identitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
