<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Psikolog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">{{ $psychologist->name }}</h3>
                    <p class="text-lg text-blue-600 mb-4">{{ $psychologist->psychologistProfile->specialization }}</p>
                    
                    @if($psychologist->psychologistProfile->bio)
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2">Tentang:</h4>
                            <p class="text-gray-700">{{ $psychologist->psychologistProfile->bio }}</p>
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
                            ✓ Terverifikasi
                        </span>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h4 class="text-lg font-semibold mb-4">Jadwal Tersedia</h4>
                    
                    @if($psychologist->jadwals->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($psychologist->jadwals as $jadwal)
                                <div class="border rounded-lg p-4">
                                    <div class="font-semibold">{{ $jadwal->day_of_week }}</div>
                                    <div class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($jadwal->start_time)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($jadwal->end_time)->format('H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Psikolog belum mengatur jadwal.</p>
                    @endif
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('pasien.psychologists.index') }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Kembali
                </a>
                <a href="{{ route('pasien.booking.create', $psychologist->id) }}" 
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Buat Janji Temu
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
