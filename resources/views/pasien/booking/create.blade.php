<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('pasien.psychologists.show', $psychologist->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Profile
                </a>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Booking Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                        <div class="p-8">
                            <h1 class="text-3xl font-bold text-gray-900 mb-6">Book Appointment</h1>

                            @if($psychologist->jadwals->count() > 0)
                                <form method="POST" action="{{ route('pasien.booking.store') }}" class="space-y-6">
                                    @csrf
                                    <input type="hidden" name="psikolog_id" value="{{ $psychologist->id }}">
                                    
                                    <!-- Schedule Date -->
                                    <div>
                                        <label for="schedule_date" class="block text-sm font-semibold text-gray-900 mb-2">
                                            Select Date *
                                        </label>
                                        <input type="date" name="schedule_date" id="schedule_date" 
                                            value="{{ old('schedule_date') }}"
                                            min="{{ date('Y-m-d') }}"
                                            class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition" 
                                            required>
                                        @error('schedule_date')
                                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Schedule Time -->
                                    <div>
                                        <label for="schedule_time" class="block text-sm font-semibold text-gray-900 mb-2">
                                            Select Time *
                                        </label>
                                        <input type="time" name="schedule_time" id="schedule_time" 
                                            value="{{ old('schedule_time') }}"
                                            class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition" 
                                            required>
                                        @error('schedule_time')
                                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                        <p class="text-sm text-gray-500 mt-2">Please select a time within the available schedule shown on the right</p>
                                    </div>

                                    <!-- Notes -->
                                    <div>
                                        <label for="notes" class="block text-sm font-semibold text-gray-900 mb-2">
                                            Notes (Optional)
                                        </label>
                                        <textarea name="notes" id="notes" rows="4" 
                                            class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition" 
                                            placeholder="Tell us what you'd like to discuss or any specific concerns...">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="flex gap-4 pt-4">
                                        <a href="{{ route('pasien.psychologists.show', $psychologist->id) }}" 
                                            class="flex-1 bg-white hover:bg-gray-50 text-gray-700 text-center font-semibold py-3 px-6 rounded-lg border-2 border-gray-300 transition duration-200">
                                            Cancel
                                        </a>
                                        <button type="submit" 
                                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                                            Book Appointment
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No schedule available</h3>
                                    <p class="mt-1 text-sm text-gray-500">This psychologist hasn't set their schedule yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Psychologist Info & Schedule -->
                <div class="lg:col-span-1">
                    <!-- Psychologist Card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 mb-6 sticky top-4">
                        <div class="p-6">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold flex-shrink-0">
                                    {{ substr($psychologist->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-900 truncate">{{ $psychologist->name }}</h3>
                                    <p class="text-sm text-blue-600 font-medium">{{ $psychologist->psychologistProfile->specialization }}</p>
                                </div>
                            </div>

                            @if($psychologist->jadwals->count() > 0)
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3 text-sm">Available Schedule:</h4>
                                    <div class="space-y-2">
                                        @foreach($psychologist->jadwals as $jadwal)
                                            <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-lg">
                                                <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <div class="text-sm">
                                                    <div class="font-medium text-gray-900">{{ $jadwal->day_of_week }}</div>
                                                    <div class="text-gray-600">
                                                        {{ \Carbon\Carbon::parse($jadwal->start_time)->format('H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($jadwal->end_time)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
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
