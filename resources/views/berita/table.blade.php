<div class="bg-white shadow-sm rounded-xl border border-gray-200">
    <div class="p-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">
                <span class="inline-flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zM7 8h10M7 12h6M7 16h10"/></svg>Berita Terkini</span>
            </h3>
            <a href="{{ route('berita.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow">
                + Tambah Berita
            </a>
        </div>

        {{-- SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ $message }}',
                    timer: 1500,
                    showConfirmButton: false
                });
            </script>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto w-full border border-gray-200 rounded-lg">
            <table class="w-full table-fixed text-sm text-gray-700">

                {{-- Lebar kolom --}}
                <colgroup>
                    <col style="width: 120px">
                    <col style="width: 25%">
                    <col style="width: 40%">
                    <col style="width: 15%">
                    <col style="width: 120px">
                </colgroup>

                <thead class="bg-gray-50 border-b">
                    <tr class="text-xs font-semibold uppercase text-gray-500">
                        <th class="px-5 py-4">Gambar</th>
                        <th class="px-5 py-4">Judul</th>
                        <th class="px-5 py-4">Konten</th>
                        <th class="px-5 py-4">Tanggal</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($beritas as $berita)
                        <tr class="hover:bg-gray-50 align-top">

                            {{-- Gambar --}}
                            <td class="px-10 py-4">
                                @if ($berita->image)
                                    <img src="{{ asset('storage/' . $berita->image) }}"
                                        class="h-16 w-24 object-cover rounded-md shadow-sm border border-gray-100">
                                @else
                                    <div
                                        class="h-16 w-24 flex items-center justify-center bg-gray-50 rounded-md border border-gray-200 text-gray-400">
                                        <svg class="w-8 h-8 opacity-50" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            {{-- Judul (WRAP KE BAWAH) --}}
                            <td class="px-5 py-4 font-semibold break-words whitespace-normal">
                                {{ $berita->title }}
                            </td>

                            {{-- Konten (WRAP + SCROLL JIKA PANJANG) --}}
                            <td class="px-5 py-4 text-gray-600">
                                <div
                                    class="prose prose-sm max-w-none break-words whitespace-normal max-h-32 overflow-y-auto">
                                    {!! $berita->content !!}
                                </div>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-5 py-4">
                                <span class="px-3 py-1 text-xs bg-gray-100 rounded-full">
                                    {{ $berita->created_at->format('d M Y') }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('berita.edit', $berita->id) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                        title="Edit">
                                        ✏️
                                    </a>

                                    <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition"
                                            title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>
