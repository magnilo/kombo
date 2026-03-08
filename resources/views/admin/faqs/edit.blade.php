<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
                <div class="p-6 text-gray-900 bg-white">
                    <form action="{{ route('faqs.update', $faq->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="question" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Pertanyaan</label>
                            <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                   required>
                        </div>

                        <div>
                            <label for="answer" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Jawaban</label>
                            <textarea name="answer" id="answer" rows="5" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>{{ old('answer', $faq->answer) }}</textarea>
                        </div>

                         <div>
                            <label for="order" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Urutan</label>
                            <input type="number" name="order" id="order" value="{{ old('order', $faq->order) }}"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                   required>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-6">
                            <a href="{{ route('faqs.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 shadow-sm">
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
