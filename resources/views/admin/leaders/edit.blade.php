<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengurus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Perbarui Data Pengurus</h3>
                </div>

                <div class="p-6 text-gray-900 bg-white">
                    <form action="{{ route('leaders.update', $leader->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $leader->name) }}"
                                       class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                                 @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="position" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Jabatan</label>
                                <input type="text" name="position" id="position" value="{{ old('position', $leader->position) }}"
                                       class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                                 @error('position')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>

                             <div>
                                <label for="division" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Divisi (Opsional)</label>
                                <input type="text" name="division" id="division" value="{{ old('division', $leader->division) }}" list="division-list"
                                       class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <datalist id="division-list">
                                    <option value="PSDM">
                                    <option value="Humas">
                                    <option value="Kominfo">
                                    <option value="KWU">
                                </datalist>
                                 @error('division')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="order" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Urutan Tampilan</label>
                                <input type="number" name="order" id="order" value="{{ old('order', $leader->order) }}"
                                       class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                                 @error('order')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Photo -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Ganti Foto Profil</label>
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg bg-gray-50/50">
                                @if($leader->photo)
                                    <div class="flex-shrink-0 mr-4">
                                        <img src="{{ asset('storage/' . $leader->photo) }}" alt="Preview" class="h-16 w-16 object-cover rounded-md shadow-sm border border-gray-200">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="photo" id="photo" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"/>
                                    <p class="text-[10px] text-gray-500 mt-1 pl-1">Pas foto formal. PNG/JPG hingga 2MB</p>
                                </div>
                            </div>
                             @error('photo')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-6">
                            <a href="{{ route('leaders.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 text-xs font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
