<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PsychoConnect - Konseling Psikologi Online Terpercaya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">

            <nav class="container mx-auto px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between">

                <a href="/" class="text-xl sm:text-2xl font-bold text-indigo-600">
                    🧠 PsychoConnect
                </a>

                <div class="hidden md:flex items-center space-x-4 lg:space-x-6">
                    <a href="#features" class="text-sm lg:text-base text-gray-600 hover:text-indigo-600 transition">Fitur</a>
                    <a href="#how-it-works" class="text-sm lg:text-base text-gray-600 hover:text-indigo-600 transition">Cara Kerja</a>
                    <a href="#testimonials" class="text-sm lg:text-base text-gray-600 hover:text-indigo-600 transition">Testimoni</a>
                </div>

                <div class="flex items-center space-x-2 sm:space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="bg-indigo-600 text-white px-3 sm:px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition text-xs sm:text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden sm:block text-sm lg:text-base text-gray-600 hover:text-indigo-600 transition font-medium">Log in</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-3 sm:px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition text-xs sm:text-sm">
                            Daftar
                        </a>
                    @endauth
                </div>
            </nav>
        </header>

        <main class="flex-grow">
            <!-- Hero Section -->
            <section class="relative text-center py-12 sm:py-20 md:py-32 px-4 sm:px-6 bg-white">
                <div
                    class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-indigo-50 to-white opacity-50 -z-10">
                </div>
                <div class="container mx-auto">
                    <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4 leading-tight">
                        Kesehatan Mental Anda adalah Prioritas
                    </h1>
                    <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto mb-6 sm:mb-8">
                        Dapatkan dukungan psikologis profesional kapan saja, di mana saja. PsychoConnect menghubungkan
                        Anda dengan psikolog terverifikasi secara aman dan rahasia.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 flex-wrap max-w-md sm:max-w-none mx-auto">
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg font-semibold hover:bg-indigo-700 transition transform hover:scale-105 shadow-lg text-sm sm:text-base">
                            Mulai Konseling
                        </a>
                        <a href="#how-it-works"
                            class="bg-white text-indigo-600 border border-indigo-200 px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg font-semibold hover:bg-indigo-50 transition transform hover:scale-105 shadow-lg text-sm sm:text-base">
                            Lihat Cara Kerja
                        </a>
                    </div>
                </div>
            </section>

            <!-- How It Works Section -->
            <section id="how-it-works" class="py-12 sm:py-16 lg:py-20 px-4 sm:px-6 bg-gradient-to-b from-white to-indigo-50">
                <div class="container mx-auto max-w-7xl text-center">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">
                        Cara Kerja
                    </h2>
                    <p class="text-sm sm:text-base text-gray-600 mb-8 sm:mb-12 max-w-3xl mx-auto">
                        Tiga langkah sederhana menuju kesehatan mental yang lebih baik
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md hover:shadow-xl transition">
                            <div
                                class="w-14 h-14 sm:w-16 sm:h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold mx-auto mb-4">
                                1
                            </div>
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Pilih Psikolog</h3>
                            <p class="text-sm sm:text-base text-gray-600">Jelajahi profil psikolog kami dan pilih yang sesuai dengan
                                kebutuhan Anda.</p>
                        </div>
                        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md hover:shadow-xl transition">
                            <div
                                class="w-14 h-14 sm:w-16 sm:h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold mx-auto mb-4">
                                2
                            </div>
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Buat Janji</h3>
                            <p class="text-sm sm:text-base text-gray-600">Pilih jadwal yang tersedia dan buat janji temu secara online.</p>
                        </div>
                        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md hover:shadow-xl transition sm:col-span-2 md:col-span-1">
                            <div
                                class="w-14 h-14 sm:w-16 sm:h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold mx-auto mb-4">
                                3
                            </div>
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Mulai Konseling</h3>
                            <p class="text-sm sm:text-base text-gray-600">Hadiri sesi konseling Anda secara online di waktu yang telah
                                ditentukan.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="py-12 sm:py-16 lg:py-20 px-4 sm:px-6 bg-white">
                <div class="container mx-auto max-w-7xl text-center">
                    <div class="mb-8 sm:mb-12">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 sm:mb-3">Mengapa Memilih PsychoConnect?
                        </h2>
                        <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">Kami menyediakan platform yang aman, nyaman, dan
                            profesional untuk kebutuhan kesehatan mental Anda.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">✓ Psikolog Terverifikasi</h3>
                            <p class="text-sm sm:text-base text-gray-600">Semua psikolog kami memiliki lisensi dan telah melalui proses
                                verifikasi yang ketat.</p>
                        </div>
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">✓ Privasi Terjamin</h3>
                            <p class="text-sm sm:text-base text-gray-600">Sesi Anda 100% rahasia. Kami menggunakan teknologi enkripsi untuk
                                melindungi data Anda.</p>
                        </div>
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">✓ Jadwal Fleksibel</h3>
                            <p class="text-sm sm:text-base text-gray-600">Atur jadwal konseling sesuai ketersediaan Anda, termasuk di malam
                                hari dan akhir pekan.</p>
                        </div>
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">✓ Akses Mudah</h3>
                            <p class="text-sm sm:text-base text-gray-600">Dapatkan bantuan di mana pun Anda berada, cukup dengan koneksi
                                internet.</p>
                        </div>
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">✓ Beragam Spesialisasi</h3>
                            <p class="text-sm sm:text-base text-gray-600">Temukan psikolog dengan keahlian di bidang depresi, kecemasan,
                                hubungan, dan lainnya.</p>
                        </div>
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">✓ Dukungan Penuh</h3>
                            <p class="text-sm sm:text-base text-gray-600">Tim support kami siap membantu Anda jika mengalami kendala teknis
                                atau non-teknis.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <section id="testimonials" class="py-12 sm:py-16 lg:py-20 px-4 sm:px-6">
                <div class="container mx-auto max-w-7xl text-center">
                    <div class="mb-8 sm:mb-12">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 sm:mb-3">Apa Kata Mereka?</h2>
                        <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">Kisah nyata dari para pengguna yang telah merasakan
                            manfaat PsychoConnect.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
                            <p class="text-sm sm:text-base text-gray-600 italic mb-4">"Awalnya ragu konseling online, tapi ternyata sangat
                                nyaman dan membantu. Psikolognya sangat pengertian. Terima kasih PsychoConnect!"</p>
                            <div class="font-semibold text-gray-900 text-sm sm:text-base">- Sarah D.</div>
                            <div class="text-xs sm:text-sm text-gray-500">Pengguna, 28</div>
                        </div>
                        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
                            <p class="text-sm sm:text-base text-gray-600 italic mb-4">"Platformnya mudah digunakan, proses bookingnya juga
                                cepat. Sangat membantu di tengah kesibukan kerja."</p>
                            <div class="font-semibold text-gray-900 text-sm sm:text-base">- Budi S.</div>
                            <div class="text-xs sm:text-sm text-gray-500">Pengguna, 35</div>
                        </div>
                        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md sm:col-span-2 lg:col-span-1">
                            <p class="text-sm sm:text-base text-gray-600 italic mb-4">"Sebagai seorang psikolog, platform ini memudahkan saya
                                menjangkau lebih banyak klien tanpa terikat lokasi. Sistemnya profesional."</p>
                            <div class="font-semibold text-gray-900 text-sm sm:text-base">- dr. Amanda, M.Psi.</div>
                            <div class="text-xs sm:text-sm text-gray-500">Psikolog Mitra</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="bg-indigo-600 text-white py-12 sm:py-16 lg:py-20 px-4 sm:px-6">
                <div class="container mx-auto text-center">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4">Siap Mengambil Langkah Pertama?</h2>
                    <p class="text-sm sm:text-base text-indigo-200 max-w-2xl mx-auto mb-6 sm:mb-8">Bergabunglah dengan ribuan orang lainnya yang
                        telah
                        mempercayakan perjalanan kesehatan mental mereka kepada kami.</p>
                    <a href="{{ route('register') }}"
                        class="inline-block bg-white text-indigo-600 px-6 sm:px-10 py-3 sm:py-4 rounded-lg font-bold hover:bg-indigo-50 transition transform hover:scale-105 shadow-2xl text-sm sm:text-base">
                        Daftar Gratis Sekarang
                    </a>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8 sm:py-10 px-4 sm:px-6">
            <div class="container mx-auto text-center">
                <p class="font-semibold text-base sm:text-lg mb-2">PsychoConnect</p>
                <p class="text-gray-400 text-xs sm:text-sm">&copy; {{ date('Y') }} PsychoConnect. All rights reserved.</p>
                <p class="text-gray-500 text-xs mt-3 sm:mt-4">Dibangun dengan ❤️ menggunakan Laravel & Tailwind CSS</p>
            </div>
        </footer>

    </div>
</body>

</html>
