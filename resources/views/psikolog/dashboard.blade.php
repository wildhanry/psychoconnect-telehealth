<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900">
                        Dashboard Psikolog
                    </h1>
                    <div class="flex items-center gap-2 sm:gap-4">
                        <div class="hidden sm:block text-right">
                            <div class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <img class="h-10 w-10 sm:h-12 sm:w-12 rounded-full object-cover"
                            src="{{ Auth::user()->psychologistProfile && Auth::user()->psychologistProfile->photo ? asset('storage/' . Auth::user()->psychologistProfile->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&color=fff' }}"
                            alt="User avatar">
                    </div>
                </div>
            </div>
        </header>

        <main class="py-6 sm:py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Quick Actions -->
                <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                    <a href="{{ route('psikolog.profile.edit') }}"
                        class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L13.196 5.196z">
                            </path>
                        </svg>
                        Edit Profil
                    </a>
                    <a href="{{ route('psikolog.jadwal.index') }}"
                        class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Kelola Jadwal
                    </a>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                    <div
                        class="bg-gradient-to-br from-yellow-400 to-orange-500 text-white p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-xs sm:text-sm font-semibold">Menunggu Konfirmasi</div>
                                <div class="text-2xl sm:text-4xl font-bold">{{ $stats['pending'] }}</div>
                            </div>
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-green-400 to-teal-500 text-white p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-xs sm:text-sm font-semibold">Terkonfirmasi</div>
                                <div class="text-2xl sm:text-4xl font-bold">{{ $stats['confirmed'] }}</div>
                            </div>
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-blue-400 to-indigo-500 text-white p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-xs sm:text-sm font-semibold">Sesi Selesai</div>
                                <div class="text-2xl sm:text-4xl font-bold">{{ $stats['completed'] }}</div>
                            </div>
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                    <div class="p-4 sm:p-6 lg:p-8 text-gray-900">
                        <h3 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Janji Temu Mendatang</h3>

                        @if (session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md"
                                role="alert">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        @if ($upcomingAppointments->count() > 0)
                            <div class="space-y-6">
                                @foreach ($upcomingAppointments as $appointment)
                                    <div
                                        class="border rounded-xl p-5 hover:shadow-lg hover:border-indigo-500 transition-all duration-300 bg-gray-50">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                                            <div class="flex items-center gap-4 mb-4 sm:mb-0">
                                                <img class="h-14 w-14 rounded-full object-cover"
                                                    src="https://ui-avatars.com/api/?name={{ urlencode($appointment->pasien->name) }}&background=random&color=fff"
                                                    alt="Pasien avatar">
                                                <div>
                                                    <h4 class="font-semibold text-lg text-gray-800">
                                                        {{ $appointment->pasien->name }}</h4>
                                                    <p class="text-gray-600 text-sm">{{ $appointment->pasien->email }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="px-3 py-1 text-xs font-semibold rounded-full {{ [
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'confirmed' => 'bg-green-100 text-green-800',
                                                        'completed' => 'bg-blue-100 text-blue-800',
                                                        'rejected' => 'bg-red-100 text-red-800',
                                                    ][$appointment->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="border-t my-4"></div>
                                        <div class="flex flex-col sm:flex-row justify-between items-start">
                                            <div>
                                                <p class="text-sm text-gray-700">
                                                    <strong class="font-semibold">Jadwal:</strong>
                                                    {{ $appointment->schedule_date->isoFormat('dddd, D MMMM Y') }}
                                                </p>
                                                <p class="text-sm text-gray-700">
                                                    <strong class="font-semibold">Waktu:</strong>
                                                    {{ \Carbon\Carbon::parse($appointment->schedule_time)->format('H:i') }}
                                                    WIB
                                                </p>
                                                @if ($appointment->notes)
                                                    <p class="text-sm text-gray-600 mt-2 italic">
                                                        "{{ $appointment->notes }}"
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="flex gap-2 mt-4 sm:mt-0 self-end sm:self-center">
                                                @if ($appointment->status === 'pending')
                                                    <form method="POST"
                                                        action="{{ route('psikolog.appointments.approve', $appointment->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-3 rounded-lg text-sm transition-colors">
                                                            Terima
                                                        </button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('psikolog.appointments.reject', $appointment->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded-lg text-sm transition-colors">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                @elseif($appointment->status === 'confirmed')
                                                    <form method="POST"
                                                        action="{{ route('psikolog.appointments.complete', $appointment->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded-lg text-sm transition-colors">
                                                            Selesaikan Sesi
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($appointment->status === 'confirmed')
                                            <div class="border-t mt-4 pt-4">
                                                <form method="POST"
                                                    action="{{ route('psikolog.appointments.meeting-link', $appointment->id) }}"
                                                    class="flex flex-col sm:flex-row gap-2 items-center">
                                                    @csrf
                                                    <label for="meeting_link_{{ $appointment->id }}" class="text-sm font-semibold text-gray-700">Meeting Link:</label>
                                                    <input type="url" name="meeting_link" id="meeting_link_{{ $appointment->id }}"
                                                        value="{{ $appointment->meeting_link }}"
                                                        placeholder="https://meet.google.com/..."
                                                        class="flex-1 w-full sm:w-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                                    <button type="submit"
                                                        class="w-full sm:w-auto bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg text-sm transition-colors">
                                                        Update Link
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path vector-effect="non-scaling-stroke" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada janji temu</h3>
                                <p class="mt-1 text-sm text-gray-500">Belum ada janji temu yang dijadwalkan untuk Anda.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
