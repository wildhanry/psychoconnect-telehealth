<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <a href="{{ route('admin.users') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg shadow-md transition flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold">Kelola User</div>
                        <div class="text-2xl font-bold">Semua</div>
                    </div>
                    <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </a>
                <a href="{{ route('admin.psychologists') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg shadow-md transition flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold">Psikolog</div>
                        <div class="text-2xl font-bold">{{ $stats['total_psychologists'] }}</div>
                    </div>
                    <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </a>
                <a href="{{ route('admin.patients') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg shadow-md transition flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold">Pasien</div>
                        <div class="text-2xl font-bold">{{ $stats['total_patients'] }}</div>
                    </div>
                    <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </a>
                <a href="{{ route('admin.appointments') }}" class="bg-orange-500 hover:bg-orange-600 text-white p-4 rounded-lg shadow-md transition flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold">Janji Temu</div>
                        <div class="text-2xl font-bold">{{ $stats['total_appointments'] ?? 0 }}</div>
                    </div>
                    <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </a>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <div class="text-gray-600 text-xs sm:text-sm">Total Psikolog</div>
                    <div class="text-2xl sm:text-3xl font-bold">{{ $stats['total_psychologists'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <div class="text-gray-600 text-xs sm:text-sm">Psikolog Terverifikasi</div>
                    <div class="text-2xl sm:text-3xl font-bold">{{ $stats['verified_psychologists'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <div class="text-gray-600 text-xs sm:text-sm">Total Pasien</div>
                    <div class="text-2xl sm:text-3xl font-bold">{{ $stats['total_patients'] }}</div>
                </div>
            </div>

            <!-- Unverified Psychologists -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Psikolog Menunggu Verifikasi</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($unverifiedPsychologists->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Spesialisasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Nomor STR</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($unverifiedPsychologists as $profile)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $profile->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $profile->user->email }}</td>
                                            <td class="px-6 py-4">{{ $profile->specialization }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $profile->str_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form method="POST"
                                                    action="{{ route('admin.verify-psychologist', $profile->id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                                        Verifikasi
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada psikolog yang menunggu verifikasi.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
