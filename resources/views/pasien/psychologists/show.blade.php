<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Psikolog') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 sm:mb-6">
                <div class="p-4 sm:p-6 text-gray-900">
                    <h3 class="text-xl sm:text-2xl font-bold mb-2">{{ $psychologist->name }}</h3>
                    <p class="text-base sm:text-lg text-blue-600 mb-4">{{ $psychologist->psychologistProfile->specialization }}</p>

                    @if ($psychologist->psychologistProfile->bio)
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-sm sm:text-base">Tentang:</h4>
                            <p class="text-gray-700 text-sm sm:text-base">{{ $psychologist->psychologistProfile->bio }}</p>
                        </div>
                    @endif

                    <div class="mb-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs sm:text-sm px-2 sm:px-3 py-1 rounded-full">
                            ✓ Terverifikasi
                        </span>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 sm:mb-6">
                <div class="p-4 sm:p-6 text-gray-900">
                    <h4 class="text-base sm:text-lg font-semibold mb-4">Jadwal Tersedia</h4>

                    @if ($psychologist->jadwals->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            @foreach ($psychologist->jadwals as $jadwal)
                                <div class="border rounded-lg p-3 sm:p-4">
                                    <div class="font-semibold text-sm sm:text-base">{{ $jadwal->day_of_week }}</div>
                                    <div class="text-xs sm:text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($jadwal->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($jadwal->end_time)->format('H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm sm:text-base">Psikolog belum mengatur jadwal.</p>
                    @endif
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 px-4 sm:px-0">
                <a href="{{ route('pasien.psychologists.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center text-sm sm:text-base">
                    Kembali
                </a>
                <a href="{{ route('pasien.booking.create', $psychologist->id) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center text-sm sm:text-base">
                    Buat Janji Temu
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
