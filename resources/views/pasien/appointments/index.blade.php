<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">My Appointments</h1>
                <p class="text-gray-600 mt-2">Manage and track your counseling sessions</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
                    <div class="flex">
                        <svg class="h-6 w-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="ml-3 text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($appointments->count() > 0)
                <div class="grid gap-6">
                    @foreach($appointments as $appointment)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all duration-300">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                                    
                                    <!-- Psychologist Info -->
                                    <div class="flex items-start gap-4 flex-1">
                                        <div class="flex-shrink-0">
                                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                                                {{ substr($appointment->psikolog->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $appointment->psikolog->name }}</h3>
                                            <p class="text-sm text-blue-600 font-medium mb-3">{{ $appointment->psikolog->psychologistProfile->specialization }}</p>
                                            
                                            <!-- Appointment Details -->
                                            <div class="grid sm:grid-cols-2 gap-3">
                                                <div class="flex items-center gap-2 text-sm">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span class="text-gray-700">{{ $appointment->schedule_date->format('d M Y') }}</span>
                                                </div>
                                                <div class="flex items-center gap-2 text-sm">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="text-gray-700">{{ \Carbon\Carbon::parse($appointment->schedule_time)->format('H:i') }} WIB</span>
                                                </div>
                                            </div>

                                            @if($appointment->notes)
                                                <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-semibold text-gray-900">Notes:</span> {{ $appointment->notes }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Status & Actions -->
                                    <div class="flex flex-col items-end gap-3 lg:w-48">
                                        <!-- Status Badge -->
                                        <span class="px-4 py-2 text-sm font-semibold rounded-full 
                                            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                            @if($appointment->status === 'pending') ⏳ Pending
                                            @elseif($appointment->status === 'confirmed') ✓ Confirmed
                                            @elseif($appointment->status === 'completed') ★ Completed
                                            @elseif($appointment->status === 'cancelled') ✕ Cancelled
                                            @endif
                                        </span>

                                        <!-- Meeting Link -->
                                        @if($appointment->meeting_link && $appointment->status === 'confirmed')
                                            <a href="{{ $appointment->meeting_link }}" target="_blank" 
                                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                                Join Meeting
                                            </a>
                                        @endif

                                        <!-- Cancel Button -->
                                        @if($appointment->status === 'pending')
                                            <form method="POST" action="{{ route('pasien.appointments.cancel', $appointment->id) }}" 
                                                onsubmit="return confirm('Are you sure you want to cancel this appointment?')"
                                                class="w-full">
                                                @csrf
                                                <button type="submit" class="w-full text-red-600 hover:text-red-700 hover:bg-red-50 font-medium px-4 py-2 rounded-lg transition text-sm">
                                                    Cancel Appointment
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No appointments yet</h3>
                    <p class="mt-2 text-gray-500">Start by finding a psychologist and booking your first session</p>
                    <div class="mt-6">
                        <a href="{{ route('pasien.psychologists.index') }}" 
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Find Psychologists
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
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
