<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
                    
                    <p class="mb-6 text-gray-600">Silakan pilih menu di bawah ini untuk mulai menggunakan layanan PsychoConnect:</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a href="{{ route('pasien.psychologists.index') }}" 
                            class="block p-6 bg-blue-50 border border-blue-200 rounded-lg hover:shadow-lg transition">
                            <h4 class="text-xl font-bold text-blue-700 mb-2">🔍 Cari Psikolog</h4>
                            <p class="text-gray-600">Lihat daftar psikolog terverifikasi dan pilih yang sesuai dengan kebutuhan Anda</p>
                        </a>

                        <a href="{{ route('pasien.appointments.index') }}" 
                            class="block p-6 bg-green-50 border border-green-200 rounded-lg hover:shadow-lg transition">
                            <h4 class="text-xl font-bold text-green-700 mb-2">📅 Janji Temu Saya</h4>
                            <p class="text-gray-600">Kelola dan lihat status janji temu konseling Anda</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
