<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Psikolog</div>
                    <div class="text-3xl font-bold">{{ $stats['total_psychologists'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Psikolog Terverifikasi</div>
                    <div class="text-3xl font-bold">{{ $stats['verified_psychologists'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Pasien</div>
                    <div class="text-3xl font-bold">{{ $stats['total_patients'] }}</div>
                </div>
            </div>

            <!-- Unverified Psychologists -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                                                    action="{{ route('admin.psychologists.verify', $profile->id) }}"
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
