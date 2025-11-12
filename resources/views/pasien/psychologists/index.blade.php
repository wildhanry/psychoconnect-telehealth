<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h1 class="text-4xl font-bold text-gray-900">Find Your Psychologist</h1>
                <p class="text-gray-600 mt-2">Browse and connect with qualified mental health professionals</p>
                
                <!-- Search Bar -->
                <div class="mt-6 max-w-2xl">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" id="searchInput" 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Search by name...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar Filters -->
                <aside class="lg:w-64 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Filters</h3>
                        
                        <!-- Specialization Filter -->
                        <div class="mb-6">
                            <button class="w-full flex items-center justify-between text-left font-semibold text-gray-900 mb-3" onclick="toggleFilter('spec')">
                                <span>Specialization</span>
                                <svg id="spec-icon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="spec-filter" class="space-y-2">
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                                    <input type="checkbox" class="specialization-filter rounded text-blue-600 focus:ring-blue-500" value="Anxiety" checked>
                                    <span class="ml-2 text-sm text-gray-700">Anxiety</span>
                                </label>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                                    <input type="checkbox" class="specialization-filter rounded text-blue-600 focus:ring-blue-500" value="Depression" checked>
                                    <span class="ml-2 text-sm text-gray-700">Depression</span>
                                </label>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                                    <input type="checkbox" class="specialization-filter rounded text-blue-600 focus:ring-blue-500" value="Trauma" checked>
                                    <span class="ml-2 text-sm text-gray-700">Trauma</span>
                                </label>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                                    <input type="checkbox" class="specialization-filter rounded text-blue-600 focus:ring-blue-500" value="Relationship" checked>
                                    <span class="ml-2 text-sm text-gray-700">Relationships</span>
                                </label>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                                    <input type="checkbox" class="specialization-filter rounded text-blue-600 focus:ring-blue-500" value="Stress" checked>
                                    <span class="ml-2 text-sm text-gray-700">Stress</span>
                                </label>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-6">
                            <button class="w-full flex items-center justify-between text-left font-semibold text-gray-900 mb-3" onclick="toggleFilter('price')">
                                <span>Price Range</span>
                                <svg id="price-icon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="price-filter" class="space-y-3">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Rp <span id="minPrice">0</span></span>
                                    <span class="text-gray-600">Rp <span id="maxPrice">500.000</span></span>
                                </div>
                                <input type="range" id="priceRange" min="0" max="500000" step="50000" value="500000" 
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                            </div>
                        </div>

                        <!-- Reset Filters -->
                        <button onclick="resetFilters()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition">
                            Reset Filters
                        </button>
                    </div>
                </aside>

                <!-- Psychologists Grid -->
                <main class="flex-1">
                    <div class="mb-4">
                        <p class="text-gray-600">Showing <span id="countResults">{{ $psychologists->count() }}</span> psychologists</p>
                    </div>

                    @if($psychologists->count() > 0)
                        <div id="psychologistGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($psychologists as $psychologist)
                                <div class="psychologist-card bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100"
                                    data-name="{{ strtolower($psychologist->name) }}"
                                    data-specialization="{{ $psychologist->psychologistProfile->specialization }}"
                                    data-price="150000">
                                    
                                    <div class="p-6">
                                        <!-- Avatar & Info -->
                                        <div class="flex items-start gap-4 mb-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                                                    {{ substr($psychologist->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-bold text-gray-900 truncate">{{ $psychologist->name }}</h3>
                                                <p class="text-sm text-blue-600 font-medium">{{ $psychologist->psychologistProfile->specialization }}</p>
                                            </div>
                                        </div>

                                        <!-- Bio -->
                                        @if($psychologist->psychologistProfile->bio)
                                            <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                                                {{ Str::limit($psychologist->psychologistProfile->bio, 120) }}
                                            </p>
                                        @endif

                                        <!-- Rating -->
                                        <div class="flex items-center gap-1 mb-4">
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
                                            <span class="text-sm text-gray-600 ml-1">4.8 (156)</span>
                                        </div>

                                        <!-- Price -->
                                        <div class="mb-4">
                                            <p class="text-2xl font-bold text-gray-900">
                                                Rp 150.000
                                                <span class="text-sm font-normal text-gray-500">/ session</span>
                                            </p>
                                        </div>

                                        <!-- Action Button -->
                                        <a href="{{ route('pasien.psychologists.show', $psychologist->id) }}" 
                                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition duration-200">
                                            View Profile
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="noResults" class="hidden text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No psychologists found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your filters</p>
                        </div>
                    @else
                        <div class="text-center py-12 bg-white rounded-lg">
                            <p class="text-gray-500">Tidak ada psikolog yang tersedia saat ini.</p>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Toggle filter sections
        function toggleFilter(section) {
            const filter = document.getElementById(section + '-filter');
            const icon = document.getElementById(section + '-icon');
            filter.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', filterPsychologists);

        // Specialization filter
        const specializationFilters = document.querySelectorAll('.specialization-filter');
        specializationFilters.forEach(filter => {
            filter.addEventListener('change', filterPsychologists);
        });

        // Price range filter
        const priceRange = document.getElementById('priceRange');
        const maxPriceDisplay = document.getElementById('maxPrice');
        priceRange.addEventListener('input', (e) => {
            maxPriceDisplay.textContent = parseInt(e.target.value).toLocaleString('id-ID');
            filterPsychologists();
        });

        function filterPsychologists() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedSpecs = Array.from(specializationFilters)
                .filter(cb => cb.checked)
                .map(cb => cb.value.toLowerCase());
            const maxPrice = parseInt(priceRange.value);

            const cards = document.querySelectorAll('.psychologist-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.dataset.name;
                const spec = card.dataset.specialization.toLowerCase();
                const price = parseInt(card.dataset.price);

                const matchesSearch = name.includes(searchTerm);
                const matchesSpec = selectedSpecs.length === 0 || selectedSpecs.some(s => spec.includes(s));
                const matchesPrice = price <= maxPrice;

                if (matchesSearch && matchesSpec && matchesPrice) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            document.getElementById('countResults').textContent = visibleCount;
            document.getElementById('noResults').classList.toggle('hidden', visibleCount > 0);
        }

        function resetFilters() {
            searchInput.value = '';
            specializationFilters.forEach(cb => cb.checked = true);
            priceRange.value = 500000;
            maxPriceDisplay.textContent = '500.000';
            filterPsychologists();
        }
    </script>
    @endpush
</x-app-layout>
