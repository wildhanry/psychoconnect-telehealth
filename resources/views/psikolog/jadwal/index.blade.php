<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                        <h3 class="text-base sm:text-lg font-semibold">Jadwal Praktik</h3>
                        <a href="{{ route('psikolog.jadwal.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm sm:text-base w-full sm:w-auto text-center">
                            + Tambah Jadwal
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-3 sm:px-4 py-3 rounded mb-4 text-sm sm:text-base">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($jadwals->count() > 0)
                        <div class="overflow-x-auto -mx-4 sm:mx-0">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hari
                                        </th>
                                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Jam
                                            Mulai</th>
                                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Jam
                                            Selesai</th>
                                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Status</th>
                                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($jadwals as $jadwal)
                                        <tr>
                                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                                <div class="font-semibold text-sm">{{ $jadwal->day_of_week }}</div>
                                                <div class="text-xs text-gray-600 sm:hidden">
                                                    {{ \Carbon\Carbon::parse($jadwal->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->end_time)->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm hidden sm:table-cell">
                                                {{ \Carbon\Carbon::parse($jadwal->start_time)->format('H:i') }}</td>
                                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm hidden sm:table-cell">
                                                {{ \Carbon\Carbon::parse($jadwal->end_time)->format('H:i') }}</td>
                                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full {{ $jadwal->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $jadwal->is_available ? 'Tersedia' : 'Tidak' }}
                                                </span>
                                            </td>
                                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <a href="{{ route('psikolog.jadwal.edit', $jadwal->id) }}"
                                                        class="text-blue-600 hover:text-blue-900 text-xs sm:text-sm">Edit</a>
                                                    <form method="POST"
                                                        action="{{ route('psikolog.jadwal.destroy', $jadwal->id) }}"
                                                        class="inline" onsubmit="return confirm('Hapus jadwal ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 text-xs sm:text-sm">Hapus</button>
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
                    @else
                        <p class="text-gray-500 text-sm sm:text-base">Belum ada jadwal. Silakan tambah jadwal praktik Anda.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
