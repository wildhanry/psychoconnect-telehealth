<x-guest-layout>
    <form method="POST" action="{{ route('psychologist.store') }}">
        @csrf

        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <h3 class="font-semibold text-blue-900 mb-2">📋 Registrasi Psikolog</h3>
            <p class="text-sm text-blue-700">Lengkapi data profil Anda. Akun akan diverifikasi oleh admin sebelum dapat digunakan.</p>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <hr class="my-6">

        <!-- Specialization -->
        <div class="mt-4">
            <x-input-label for="specialization" :value="__('Spesialisasi')" />
            <x-text-input id="specialization" class="block mt-1 w-full" type="text" name="specialization" :value="old('specialization')" required placeholder="Contoh: Klinis Dewasa, Anak & Remaja" />
            <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
        </div>

        <!-- STR Number -->
        <div class="mt-4">
            <x-input-label for="str_number" :value="__('Nomor STR (Surat Tanda Registrasi)')" />
            <x-text-input id="str_number" class="block mt-1 w-full" type="text" name="str_number" :value="old('str_number')" required />
            <x-input-error :messages="$errors->get('str_number')" class="mt-2" />
        </div>

        <!-- Bio -->
        <div class="mt-4">
            <x-input-label for="bio" :value="__('Bio / Deskripsi Diri')" />
            <textarea id="bio" name="bio" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Ceritakan tentang diri Anda, pengalaman, dan pendekatan dalam konseling...">{{ old('bio') }}</textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <!-- Education -->
        <div class="mt-4">
            <x-input-label for="education" :value="__('Pendidikan (Opsional)')" />
            <textarea id="education" name="education" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: S1 Psikologi - Universitas Indonesia (2010-2014)">{{ old('education') }}</textarea>
            <x-input-error :messages="$errors->get('education')" class="mt-2" />
        </div>

        <!-- Experience Years -->
        <div class="mt-4">
            <x-input-label for="experience_years" :value="__('Pengalaman (Tahun)')" />
            <x-text-input id="experience_years" class="block mt-1 w-full" type="number" name="experience_years" :value="old('experience_years')" min="0" placeholder="5" />
            <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar Sebagai Psikolog') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
