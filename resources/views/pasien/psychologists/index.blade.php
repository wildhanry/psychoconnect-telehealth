<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Psikolog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Psikolog Tersedia</h3>

                    @if ($psychologists->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($psychologists as $psychologist)
                                <div
                                    class="bg-white border border-gray-200 rounded-2xl transform shadow-lg hover:scale-105 transition-all duration-300 ease-in-out flex flex-col">
                                    <div class="p-6 flex-grow">
                                        <div class="flex items-center mb-4">
                                            <img class="h-16 w-16 rounded-full object-cover mr-4"
                                                src="{{ $psychologist->psychologistProfile && $psychologist->psychologistProfile->photo ? asset('storage/' . $psychologist->psychologistProfile->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($psychologist->name) . '&background=EBF4FF&color=0284C7' }}"
                                                alt="Foto {{ $psychologist->name }}">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-lg text-gray-800">{{ $psychologist->name }}
                                                </h4>
                                                @if ($psychologist->psychologistProfile->specialization)
                                                    <span
                                                        class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">
                                                        {{ $psychologist->psychologistProfile->specialization }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($psychologist->psychologistProfile->bio)
                                            <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                                                {{ $psychologist->psychologistProfile->bio }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-b-2xl mt-auto">
                                        <div class="flex gap-3">
                                            <a href="{{ route('pasien.psychologists.show', $psychologist->id) }}"
                                                class="flex-1 text-center bg-white hover:bg-gray-100 text-gray-800 font-bold py-2 px-4 rounded-lg border border-gray-300 transition-colors duration-300 text-sm">
                                                Lihat Detail
                                            </a>
                                            <a href="{{ route('pasien.booking.create', $psychologist->id) }}"
                                                class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300 text-sm">
                                                Buat Janji
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Tidak Ada Psikolog Ditemukan</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                @if (request('search'))
                                    Kami tidak dapat menemukan psikolog dengan kata kunci "{{ request('search') }}".
                                    Coba cari dengan kata kunci lain.
                                @else
                                    Tidak ada psikolog yang tersedia saat ini. Silakan cek kembali nanti.
                                @endif
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('pasien.psychologists.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Tampilkan Semua Psikolog
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
