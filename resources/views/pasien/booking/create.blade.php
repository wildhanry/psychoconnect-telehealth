<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Janji Temu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-semibold text-lg">{{ $psychologist->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $psychologist->psychologistProfile->specialization }}</p>
                    </div>

                    @if ($psychologist->jadwals->count() > 0)
                        <div class="mb-6">
                            <h5 class="font-semibold mb-2">Jadwal Tersedia:</h5>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                @foreach ($psychologist->jadwals as $jadwal)
                                    <div class="text-sm border rounded p-2">
                                        <div class="font-medium">{{ $jadwal->day_of_week }}</div>
                                        <div class="text-gray-600">
                                            {{ \Carbon\Carbon::parse($jadwal->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($jadwal->end_time)->format('H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <form method="POST" action="{{ route('pasien.booking.store') }}">
                            @csrf
                            <input type="hidden" name="psikolog_id" value="{{ $psychologist->id }}">

                            <!-- Schedule Date -->
                            <div class="mb-4">
                                <label for="schedule_date" class="block text-sm font-medium text-gray-700">Tanggal
                                    *</label>
                                <input type="date" name="schedule_date" id="schedule_date"
                                    value="{{ old('schedule_date') }}" min="{{ date('Y-m-d') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                @error('schedule_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Schedule Time -->
                            <div class="mb-4">
                                <label for="schedule_time" class="block text-sm font-medium text-gray-700">Waktu
                                    *</label>
                                <input type="time" name="schedule_time" id="schedule_time"
                                    value="{{ old('schedule_time') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                @error('schedule_time')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Pastikan waktu sesuai dengan jadwal tersedia di
                                    atas</p>
                            </div>

                            <!-- Notes -->
                            <div class="mb-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan
                                    (Opsional)</label>
                                <textarea name="notes" id="notes" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Jelaskan keluhan atau hal yang ingin dikonsultasikan...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-4">
                                <a href="{{ route('pasien.psychologists.show', $psychologist->id) }}"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Buat Janji Temu
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                            Psikolog belum mengatur jadwal. Silakan pilih psikolog lain atau coba lagi nanti.
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('pasien.psychologists.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Kembali ke Daftar Psikolog
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
