<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Psikolog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Quick Actions -->
            <div class="mb-6 flex gap-4">
                <a href="{{ route('psikolog.profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Profil
                </a>
                <a href="{{ route('psikolog.jadwal.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Kelola Jadwal
                </a>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Menunggu Konfirmasi</div>
                    <div class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Terkonfirmasi</div>
                    <div class="text-3xl font-bold text-green-600">{{ $stats['confirmed'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Selesai</div>
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['completed'] }}</div>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Janji Temu Mendatang</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($upcomingAppointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingAppointments as $appointment)
                                <div class="border rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold text-lg">{{ $appointment->pasien->name }}</h4>
                                            <p class="text-gray-600">{{ $appointment->pasien->email }}</p>
                                            <p class="text-sm text-gray-500 mt-2">
                                                <strong>Tanggal:</strong> {{ $appointment->schedule_date->format('d M Y') }}<br>
                                                <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($appointment->schedule_time)->format('H:i') }}
                                            </p>
                                            @if($appointment->notes)
                                                <p class="text-sm text-gray-600 mt-2">
                                                    <strong>Catatan:</strong> {{ $appointment->notes }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <span class="px-3 py-1 text-sm rounded-full {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                            
                                            @if($appointment->status === 'pending')
                                                <div class="flex gap-2">
                                                    <form method="POST" action="{{ route('psikolog.appointments.approve', $appointment->id) }}">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                            Terima
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('psikolog.appointments.reject', $appointment->id) }}">
                                                        @csrf
                                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @elseif($appointment->status === 'confirmed')
                                                <form method="POST" action="{{ route('psikolog.appointments.complete', $appointment->id) }}">
                                                    @csrf
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Selesai
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($appointment->status === 'confirmed')
                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('psikolog.appointments.meeting-link', $appointment->id) }}" class="flex gap-2">
                                                @csrf
                                                <input type="url" name="meeting_link" value="{{ $appointment->meeting_link }}" 
                                                    placeholder="https://meet.google.com/..." 
                                                    class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                                    Update Link
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada janji temu mendatang.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
