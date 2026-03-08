<x-app-layout>
    @section('admin_title', 'Manajemen Alumni')

    <div class="p-6 space-y-6" x-data="{ addBatchModal: false }">
        <!-- Header -->
        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="text-2xl font-black text-slate-800">Alumni KOMBO</h3>
                <p class="text-slate-500 font-medium">Kelola data per angkatan.</p>
            </div>
            <button type="button" @click="addBatchModal = true" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black shadow-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Tambah Angkatan Baru
            </button>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold flex justify-between items-center">
                <span>✅ {{ session('success') }}</span>
                <button @click="show = false">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 bg-red-50 text-red-700 rounded-2xl font-bold">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Daftar Angkatan -->
        <div class="space-y-4">
            @forelse($batches as $batch)
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden" x-data="{ open: false }">
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-12 bg-slate-100 rounded-xl overflow-hidden">
                            @if($batch->group_photo)
                                <img src="{{ asset('storage/' . $batch->group_photo) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <h4 class="text-lg font-black text-slate-800">Angkatan {{ $batch->year }}</h4>
                    </div>
                    <div class="flex gap-2">
                        <button @click="open = !open" class="px-4 py-2 bg-slate-100 rounded-xl font-bold text-xs uppercase">
                            <span x-show="!open">Kelola Data</span>
                            <span x-show="open">Tutup</span>
                        </button>
                        <form action="{{ route('alumni.batch.destroy', $batch->id) }}" method="POST" onsubmit="return confirm('Hapus angkatan ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 text-red-400">Hapus</button>
                        </form>
                    </div>
                </div>

                <div x-show="open" class="p-8 bg-slate-50 border-t border-slate-100 flex flex-col md:flex-row gap-8">
                    <!-- Form Input Member -->
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-2xl shadow-sm">
                        <h5 class="font-black text-sm mb-4">Input Alumni Baru</h5>
                        <form action="{{ route('alumni.member.store', $batch->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full p-3 rounded-xl border bg-slate-50 font-bold text-sm">
                            <input type="text" name="position" placeholder="Jabatan/Ket" class="w-full p-3 rounded-xl border bg-slate-50 font-bold text-sm">
                            <input type="file" name="photo" class="text-xs">
                            <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-xl font-black text-sm">SIMPAN ANGGOTA</button>
                        </form>
                    </div>

                    <!-- List Members -->
                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($batch->members as $member)
                        <div class="bg-white p-3 rounded-xl border flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <span class="font-bold text-xs">{{ $member->name }}</span>
                            </div>
                            <form action="{{ route('alumni.member.destroy', $member->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-300 hover:text-red-500">×</button>
                            </form>
                        </div>
                        @empty
                            <div class="col-span-2 text-center py-10 text-slate-400 italic">Belum ada anggota.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            @empty
                <div class="p-20 text-center bg-white rounded-[32px] border-2 border-dashed border-slate-100">
                    <p class="text-slate-400 font-bold italic">Belum ada data alumni.</p>
                </div>
            @endforelse
        </div>

        <!-- Modal Tambah Angkatan -->
        <div x-show="addBatchModal" x-cloak class="fixed inset-0 z-[999] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" @click="addBatchModal = false"></div>
            <div class="bg-white p-8 rounded-[40px] shadow-2xl relative w-full max-w-md">
                <h3 class="text-xl font-black mb-6">Tambah Angkatan Alumni</h3>
                <form action="{{ route('alumni.batch.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tahun Lulus</label>
                        <input type="number" name="year" placeholder="Contoh: 2024" required class="w-full p-4 rounded-2xl border bg-slate-50 font-black">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Foto Angkatan</label>
                        <input type="file" name="group_photo" class="text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kesan Singkat</label>
                        <textarea name="description" rows="2" class="w-full p-4 rounded-2xl border bg-slate-50"></textarea>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" @click="addBatchModal = false" class="flex-1 py-4 bg-slate-100 rounded-2xl font-black text-sm">BATAL</button>
                        <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-black text-sm">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>
