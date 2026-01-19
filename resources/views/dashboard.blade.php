<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pasien') }}
        </h2>
    </x-slot>

    <main class="py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 sm:mb-8">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">Selamat Datang Kembali!</h2>
                <p class="text-sm sm:text-base text-gray-600">Siap untuk mengambil langkah selanjutnya menuju kesehatan mental Anda?
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                <!-- Card 1: Cari Psikolog -->
                <a href="{{ route('pasien.psychologists.index') }}"
                    class="flex flex-col justify-between transform hover:scale-105 transition-transform duration-300 ease-in-out bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="p-6">
                        <div
                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-500 group-hover:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Cari Psikolog</h3>
                        <p class="text-gray-600">Temukan psikolog profesional yang tepat untuk Anda.</p>
                    </div>
                    <div class="bg-blue-500 text-white text-center py-2 font-semibold">
                        Mulai Sekarang
                    </div>
                </a>

                <!-- Card 2: Janji Temu Saya -->
                <a href="{{ route('pasien.appointments.index') }}"
                    class="flex flex-col justify-between transform hover:scale-105 transition-transform duration-300 ease-in-out bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="p-6">
                        <div
                            class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-green-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-green-500 group-hover:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Janji Temu Saya</h3>
                        <p class="text-gray-600">Lihat dan kelola jadwal sesi konseling Anda.</p>
                    </div>
                    <div class="bg-green-500 text-white text-center py-2 font-semibold">
                        Lihat Jadwal
                    </div>
                </a>

                <!-- Card 3: Jurnal Harian -->
                <a href="{{ route('pasien.journals.index') }}"
                    class="flex flex-col justify-between transform hover:scale-105 transition-transform duration-300 ease-in-out bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="p-6">
                        <div
                            class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-indigo-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-indigo-500 group-hover:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Jurnal Harian</h3>
                        <p class="text-gray-600">Tulis jurnal dan pantau mood Anda dengan AI.</p>
                    </div>
                    <div class="bg-indigo-500 text-white text-center py-2 font-semibold">
                        Tulis Jurnal
                    </div>
                </a>

                <!-- Card 4: Profil Saya -->
                <a href="{{ route('profile.edit') }}"
                    class="flex flex-col justify-between transform hover:scale-105 transition-transform duration-300 ease-in-out bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="p-6">
                        <div
                            class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-purple-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-purple-500 group-hover:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Profil Saya</h3>
                        <p class="text-gray-600">Perbarui informasi pribadi dan preferensi Anda.</p>
                    </div>
                    <div class="bg-purple-500 text-white text-center py-2 font-semibold">
                        Edit Profil
                    </div>
                </a>
            </div>
        </div>
    </main>
    </div>
</x-app-layout>
