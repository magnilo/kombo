<x-app-layout>
    @section('admin_title', 'Manajemen Alumni')

    <div class="space-y-10" x-data="{ addBatchModal: false }">
        <!-- Header & Add Batch -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm gap-6">
            <div>
                <h3 class="text-xl font-extrabold text-slate-800">Alumni Per Angkatan</h3>
                <p class="text-slate-500 text-sm font-medium mt-1">Kelola data lulusan dan foto kenangan angkatan.</p>
            </div>
            <button @click="addBatchModal = true" 
                    class="px-8 py-4 text-white rounded-2xl font-extrabold flex items-center gap-2 hover:-translate-y-1 transition-all shadow-xl shadow-indigo-100 whitespace-nowrap"
                    style="background: #4f46e5;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Tambah Angkatan
            </button>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- List of Batches -->
        <div class="grid grid-cols-1 gap-12">
            @foreach($batches as $batch)
            <div class="bg-white rounded-[48px] border border-slate-100 shadow-sm overflow-hidden" x-data="{ expanded: false }">
                <!-- Batch Header -->
                <div class="p-10 flex flex-col md:flex-row gap-8 items-start">
                    <div class="w-full md:w-80 h-48 bg-slate-50 rounded-[32px] overflow-hidden border-2 border-dashed border-slate-100 flex-shrink-0 flex items-center justify-center relative group">
                        @if($batch->group_photo)
                            <img src="{{ asset('storage/' . $batch->group_photo) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white font-bold text-xs">Foto Angkatan</div>
                        @else
                            <div class="text-slate-300 font-bold text-sm">Belum ada foto angkatan</div>
                        @endif
                    </div>
                    
                    <div class="flex-1 space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="px-5 py-2 bg-indigo-50 text-indigo-700 rounded-full font-black text-xs uppercase tracking-widest">Angkatan {{ $batch->year }}</span>
                            <div class="flex gap-2">
                                <form action="{{ route('alumni.batch.destroy', $batch->id) }}" method="POST" onsubmit="return confirm('Hapus angkatan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 hover:text-red-600 font-bold text-xs">Hapus Angkatan</button>
                                </form>
                            </div>
                        </div>
                        <h4 class="text-2xl font-black text-slate-800">Alumni Tahun {{ $batch->year }}</h4>
                        <p class="text-slate-500 font-medium leading-relaxed italic border-l-4 border-slate-100 pl-4">"{{ $batch->description ?: 'Belum ada deskripsi untuk angkatan ini.' }}"</p>
                        
                        <div class="flex gap-4 pt-4">
                            <button @click="expanded = !expanded" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-xs shadow-lg">
                                <span x-show="!expanded">Kelola {{ $batch->members->count() }} Anggota</span>
                                <span x-show="expanded">Tutup Panel Anggota</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Members Panel -->
                <div x-show="expanded" x-collapse class="bg-slate-50/50 border-t border-slate-100 p-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                        <!-- Add Member Form -->
                        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm">
                            <h5 class="font-black text-slate-800 mb-6">Tambah Nama Alumni</h5>
                            <form action="{{ route('alumni.member.store', $batch->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <input type="text" name="name" placeholder="Nama Alumni" required class="w-full px-5 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 transition-all font-bold text-sm">
                                <input type="text" name="position" placeholder="Keterangan (misal: S1 Sistem Informasi)" class="w-full px-5 py-3 rounded-xl border-2 border-slate-50 bg-slate-50 focus:border-indigo-500 transition-all font-bold text-sm">
                                <div class="flex items-center gap-4">
                                    <label class="text-xs font-bold text-slate-400 uppercase">Foto (Opsional):</label>
                                    <input type="file" name="photo" class="text-xs">
                                </div>
                                <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-100">Simpan Anggota</button>
                            </form>
                        </div>

                        <!-- Members List -->
                        <div class="space-y-4">
                            <h5 class="font-black text-slate-800 mb-4">Daftar Anggota ({{ $batch->members->count() }})</h5>
                            <div class="max-h-[300px] overflow-y-auto pr-4 space-y-3">
                                @foreach($batch->members as $member)
                                <div class="bg-white p-4 rounded-2xl border border-slate-100 flex items-center gap-4 hover:shadow-md transition">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 overflow-hidden flex-shrink-0">
                                        @if($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center font-bold text-slate-300">{{ substr($member->name, 0, 1) }}</div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-bold text-slate-800 truncate text-sm">{{ $member->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-medium">{{ $member->position ?: 'Alumni' }}</div>
                                    </div>
                                    <form action="{{ route('alumni.member.destroy', $member->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-300 hover:text-red-500 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div x-show="addBatchModal" 
             class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto bg-slate-900/80 backdrop-blur-md p-4 sm:p-10" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            <div class="bg-white w-full max-w-xl rounded-[48px] shadow-2xl relative animate-modalIn" 
                 @click.away="addBatchModal = false">
                <div class="p-8 sm:p-12">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-black text-slate-800">Tambah Angkatan Alumni</h3>
                            <p class="text-slate-500 text-sm font-medium mt-1">Buat folder baru untuk mengelompokkan alumni.</p>
                        </div>
                        <button @click="addBatchModal = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('alumni.batch.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Tahun Lulus (Batch)</label>
                            <input type="text" name="year" placeholder="Contoh: 2023" required class="w-full px-6 py-4 rounded-2xl border-2 border-slate-100 focus:border-indigo-500 bg-slate-50 focus:bg-white transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto 1 Angkatan (Landscape)</label>
                            <div class="p-6 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl">
                                <input type="file" name="group_photo" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-extrabold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Pesan / Kesan Singkat</label>
                            <textarea name="description" rows="3" placeholder="Satu hati untuk Bondowoso..." class="w-full px-6 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 focus:bg-white focus:border-indigo-500 transition-all font-medium text-slate-700"></textarea>
                        </div>
                        
                        <div class="flex gap-4 pt-4">
                            <button type="button" @click="addBatchModal = false" class="flex-1 py-4 bg-slate-100 text-slate-600 rounded-2xl font-black transition hover:bg-slate-200">Batal</button>
                            <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-black shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition">Buat Angkatan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-modalIn { animation: modalIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes modalIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    </style>
</x-app-layout>
