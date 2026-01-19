<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jurnal Harian & Monitor Mood') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Success/Warning Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif

            {{-- AI Disclaimer Warning --}}
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Perhatian:</strong> Analisis mood menggunakan AI dan dapat menghasilkan kesalahan. 
                            Hasil ini hanya sebagai panduan awal. Untuk evaluasi yang lebih akurat dan mendalam, 
                            <a href="{{ route('pasien.psychologists.index') }}" class="font-semibold underline hover:text-blue-900">
                                konsultasikan dengan psikolog profesional kami
                            </a>.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Journal Input Form --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Tulis Jurnal Harian Anda
                    </h3>
                    
                    <form method="POST" action="{{ route('pasien.journals.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Bagaimana hari Anda? Ceritakan pikiran dan perasaan Anda...
                            </label>
                            <textarea 
                                id="content" 
                                name="content" 
                                rows="6"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Hari ini saya merasa..."
                                required
                            >{{ old('content') }}</textarea>
                            
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="text-xs text-gray-500">
                                🤖 AI akan menganalisis mood Anda secara otomatis
                            </p>
                            <button 
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition transform hover:scale-105"
                            >
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Analisis Mood Saya
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Past Journals List --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Riwayat Jurnal Anda
                    </h3>

                    @if ($journals->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <p class="text-lg font-medium">Belum ada jurnal</p>
                            <p class="text-sm mt-1">Mulai menulis jurnal pertama Anda di atas!</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($journals as $journal)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="text-sm text-gray-500">
                                                📅 {{ $journal->created_at->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                {{ $journal->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                        
                                        {{-- Mood Badge --}}
                                        @if ($journal->mood_label === 'Pending Analysis')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                ⏳ Menunggu Analisis
                                            </span>
                                        @elseif ($journal->mood_score === 0)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                😊 {{ $journal->mood_label }}
                                            </span>
                                        @elseif ($journal->mood_score === 1)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                😔 {{ $journal->mood_label }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                ❓ {{ $journal->mood_label }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="text-gray-700 mb-3">
                                        @if (strlen($journal->content) > 200)
                                            {{ Str::limit($journal->content, 200) }}
                                        @else
                                            {{ $journal->content }}
                                        @endif
                                    </div>

                                    @if ($journal->confidence_score)
                                        <div class="text-xs text-gray-500 mb-3">
                                            🎯 Tingkat Keyakinan AI: {{ number_format($journal->confidence_score, 1) }}%
                                        </div>
                                    @endif

                                    {{-- Action Buttons --}}
                                    <div class="flex items-center gap-2 pt-3 border-t border-gray-200">
                                        <a href="{{ route('pasien.journals.edit', $journal->id) }}" 
                                           class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('pasien.journals.reanalyze', $journal->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 text-xs font-medium rounded transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                Analisis Ulang
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('pasien.journals.destroy', $journal->id) }}" 
                                              class="inline ml-auto"
                                              onsubmit="return confirm('Yakin ingin menghapus jurnal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
