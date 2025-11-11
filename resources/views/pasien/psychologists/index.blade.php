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
                    
                    @if($psychologists->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($psychologists as $psychologist)
                                <div class="border rounded-lg p-6 hover:shadow-lg transition">
                                    <h4 class="font-bold text-xl mb-2">{{ $psychologist->name }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $psychologist->psychologistProfile->specialization }}</p>
                                    
                                    @if($psychologist->psychologistProfile->bio)
                                        <p class="text-sm text-gray-700 mb-4">
                                            {{ Str::limit($psychologist->psychologistProfile->bio, 100) }}
                                        </p>
                                    @endif
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ route('pasien.psychologists.show', $psychologist->id) }}" 
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                            Lihat Detail
                                        </a>
                                        <a href="{{ route('pasien.booking.create', $psychologist->id) }}" 
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                            Buat Janji
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada psikolog yang tersedia saat ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
