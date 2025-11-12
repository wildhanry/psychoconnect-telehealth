<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Janji Temu Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-4">Daftar Janji Temu</h3>

                    @if ($appointments->count() > 0)
                        <div class="space-y-4">
                            @foreach ($appointments as $appointment)
                                <div class="border rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-lg">{{ $appointment->psikolog->name }}</h4>
                                            <p class="text-sm text-gray-600">
                                                {{ $appointment->psikolog->psychologistProfile->specialization }}</p>

                                            <div class="mt-2 text-sm">
                                                <p><strong>Tanggal:</strong>
                                                    {{ $appointment->schedule_date->format('d M Y') }}</p>
                                                <p><strong>Waktu:</strong>
                                                    {{ \Carbon\Carbon::parse($appointment->schedule_time)->format('H:i') }}
                                                </p>
                                            </div>

                                            @if ($appointment->notes)
                                                <div class="mt-2 text-sm text-gray-600">
                                                    <strong>Catatan:</strong> {{ $appointment->notes }}
                                                </div>
                                            @endif

                                            @if ($appointment->meeting_link && $appointment->status === 'confirmed')
                                                <div class="mt-3">
                                                    <a href="{{ $appointment->meeting_link }}" target="_blank"
                                                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                                        🔗 Join Meeting
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex flex-col items-end gap-2">
                                            <span
                                                class="px-3 py-1 text-sm rounded-full 
                                                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                @if ($appointment->status === 'pending')
                                                    Menunggu Konfirmasi
                                                @elseif($appointment->status === 'confirmed')
                                                    Dikonfirmasi
                                                @elseif($appointment->status === 'completed')
                                                    Selesai
                                                @elseif($appointment->status === 'cancelled')
                                                    Dibatalkan
                                                @endif
                                            </span>

                                            @if ($appointment->status === 'pending')
                                                <form method="POST"
                                                    action="{{ route('pasien.appointments.cancel', $appointment->id) }}"
                                                    onsubmit="return confirm('Batalkan janji temu ini?')">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 text-sm">
                                                        Batalkan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Anda belum memiliki janji temu.</p>
                        <div class="mt-4">
                            <a href="{{ route('pasien.psychologists.index') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Cari Psikolog
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
