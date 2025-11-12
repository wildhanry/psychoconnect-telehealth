<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Psikolog') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Daftar Psikolog ({{ $psychologists->count() }})</h3>
                    </div>

                    @if ($psychologists->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Spesialisasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">STR</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($psychologists as $psychologist)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-semibold">{{ $psychologist->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $psychologist->email }}
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                {{ $psychologist->psychologistProfile->specialization ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                {{ $psychologist->psychologistProfile->str_number ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($psychologist->psychologistProfile)
                                                    <span class="px-2 py-1 text-xs rounded-full {{ $psychologist->psychologistProfile->is_verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ $psychologist->psychologistProfile->is_verified ? 'Terverifikasi' : 'Belum Verifikasi' }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <div class="flex gap-2">
                                                    @if ($psychologist->psychologistProfile)
                                                        @if (!$psychologist->psychologistProfile->is_verified)
                                                            <form method="POST" action="{{ route('admin.verify-psychologist', $psychologist->psychologistProfile->id) }}">
                                                                @csrf
                                                                <button type="submit" class="text-green-600 hover:text-green-900">
                                                                    Verifikasi
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form method="POST" action="{{ route('admin.unverify-psychologist', $psychologist->psychologistProfile->id) }}">
                                                                @csrf
                                                                <button type="submit" class="text-orange-600 hover:text-orange-900">
                                                                    Cabut Verifikasi
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                    
                                                    <form method="POST" action="{{ route('admin.users.delete', $psychologist->id) }}" 
                                                        onsubmit="return confirm('Yakin hapus psikolog ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada psikolog terdaftar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
