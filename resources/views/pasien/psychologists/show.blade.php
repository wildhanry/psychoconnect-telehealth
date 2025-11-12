<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('pasien.psychologists.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Psychologists
                </a>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Main Profile Card -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                        <div class="p-8">
                            
                            <!-- Profile Header -->
                            <div class="flex flex-col sm:flex-row gap-6 mb-8">
                                <div class="flex-shrink-0">
                                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-5xl font-bold shadow-lg">
                                        {{ substr($psychologist->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $psychologist->name }}</h1>
                                    <p class="text-xl text-blue-600 font-semibold mb-3">{{ $psychologist->psychologistProfile->specialization }}</p>
                                    
                                    <!-- Rating & Reviews -->
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= 4)
                                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">4.8</span>
                                        <span class="text-sm text-gray-500">(156 reviews)</span>
                                    </div>
                                    
                                    <!-- Verified Badge -->
                                    <div class="inline-flex items-center gap-2 bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Verified Professional
                                    </div>
                                </div>
                            </div>

                            <!-- About Section -->
                            @if($psychologist->psychologistProfile->bio)
                                <div class="mb-8">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">About</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $psychologist->psychologistProfile->bio }}</p>
                                </div>
                            @endif

                            <!-- Expertise Tags -->
                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Expertise</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">Anxiety Management</span>
                                    <span class="px-4 py-2 bg-purple-50 text-purple-700 rounded-full text-sm font-medium">Stress Counseling</span>
                                    <span class="px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-medium">Cognitive Therapy</span>
                                </div>
                            </div>

                            <!-- Available Schedule -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Available Schedule</h3>
                                
                                @if($psychologist->jadwals->count() > 0)
                                    <div class="grid sm:grid-cols-2 gap-3">
                                        @foreach($psychologist->jadwals as $jadwal)
                                            <div class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition">
                                                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $jadwal->day_of_week }}</div>
                                                    <div class="text-sm text-gray-600">
                                                        {{ \Carbon\Carbon::parse($jadwal->start_time)->format('H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($jadwal->end_time)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">No schedule available yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Booking Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 sticky top-4">
                        <div class="bg-gradient-to-br from-blue-600 to-indigo-600 p-6 text-white">
                            <p class="text-sm font-medium opacity-90 mb-1">Session Price</p>
                            <p class="text-4xl font-bold">Rp 150K</p>
                            <p class="text-sm opacity-75 mt-1">per session (60 min)</p>
                        </div>
                        
                        <div class="p-6">
                            <!-- Features List -->
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700">Online video consultation</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700">Flexible scheduling</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700">Confidential & secure</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700">Easy rescheduling</span>
                                </li>
                            </ul>

                            <!-- Action Buttons -->
                            <a href="{{ route('pasien.booking.create', $psychologist->id) }}" 
                                class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-4 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg mb-3">
                                Book Appointment
                            </a>
                            
                            <a href="{{ route('pasien.psychologists.index') }}" 
                                class="block w-full bg-white hover:bg-gray-50 text-gray-700 text-center font-medium py-3 px-6 rounded-lg border-2 border-gray-300 transition duration-200">
                                Browse More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
