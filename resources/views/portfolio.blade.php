@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 right-20 w-64 h-64 bg-white bg-opacity-10 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
    <div class="absolute bottom-20 left-20 w-64 h-64 bg-yellow-300 bg-opacity-20 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-6">
            <span class="inline-flex items-center glass-bg rounded-full px-6 py-3 text-white text-sm font-medium border border-white border-opacity-20">
                <svg class="w-4 h-4 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Karya Terbaik Kami
            </span>
        </div>
        
        <h1 class="text-3xl sm:text-5xl md:text-6xl font-heading font-bold mb-4 sm:mb-6 text-white leading-tight">
            Portfolio
            <span class="block bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">
                Filia Interior
            </span>
        </h1>
        
        <p class="text-base sm:text-xl text-purple-100 max-w-4xl mx-auto leading-relaxed px-2">
            Koleksi karya eksklusif kami yang menampilkan berbagai gaya dan konsep desain interior yang mewah serta elegan
        </p>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="group">
                <div class="text-4xl font-heading font-bold text-purple-600 mb-2 group-hover:scale-110 transition-transform duration-300">150</div>
                <div class="text-gray-600 font-medium">Proyek Selesai</div>
            </div>
            <div class="group">
                <div class="text-4xl font-heading font-bold text-blue-600 mb-2 group-hover:scale-110 transition-transform duration-300">30</div>
                <div class="text-gray-600 font-medium">Tahun Pengalaman</div>
            </div>
            <div class="group">
                <div class="text-4xl font-heading font-bold text-green-600 mb-2 group-hover:scale-110 transition-transform duration-300">99%</div>
                <div class="text-gray-600 font-medium">Kepuasan Klien</div>
            </div>
            <div class="group">
                <div class="text-4xl font-heading font-bold text-orange-600 mb-2 group-hover:scale-110 transition-transform duration-300">11</div>
                <div class="text-gray-600 font-medium">Tim Profesional</div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Gallery -->
<section class="py-12 sm:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16">
            <span class="text-purple-600 font-semibold text-xs sm:text-sm uppercase tracking-wider">Galeri Karya</span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2 mb-4 sm:mb-6 px-2">
                Inspirasi Desain Terbaik
            </h2>
            <p class="text-sm sm:text-lg text-gray-600 max-w-3xl mx-auto px-4">
                Setiap project adalah cerminan dedikasi kami dalam menciptakan ruang yang tidak hanya indah, tetapi juga fungsional dan personal.
            </p>
        </div>

        @if(count($portfolioImages) > 0 || count($portfolios) > 0)
            <!-- Filter Tabs -->
            <div class="text-center mb-12">
                <!-- Desktop Filter -->
                <div class="hidden md:block">
                    <div class="inline-flex bg-white rounded-2xl p-2 shadow-lg border border-gray-200">
                        <button class="filter-btn active px-8 py-3 rounded-xl font-semibold transition-all duration-300 text-white gradient-bg" data-filter="all">
                            Semua Project
                        </button>
                        <button class="filter-btn px-8 py-3 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-purple-600 hover:bg-purple-50" data-filter="residential">
                            Residential
                        </button>
                        <button class="filter-btn px-8 py-3 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-purple-600 hover:bg-purple-50" data-filter="commercial">
                            Commercial
                        </button>
                        <button class="filter-btn px-8 py-3 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-purple-600 hover:bg-purple-50" data-filter="luxury">
                            Luxury
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Filter -->
                <div class="md:hidden">
                    <div class="grid grid-cols-2 gap-3 max-w-sm mx-auto">
                        <button class="filter-btn active px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-white gradient-bg text-sm" data-filter="all">
                            Semua
                        </button>
                        <button class="filter-btn px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-purple-600 bg-white border border-gray-200 text-sm" data-filter="residential">
                            Residential
                        </button>
                        <button class="filter-btn px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-purple-600 bg-white border border-gray-200 text-sm" data-filter="commercial">
                            Commercial
                        </button>
                        <button class="filter-btn px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-purple-600 bg-white border border-gray-200 text-sm" data-filter="luxury">
                            Luxury
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8" id="portfolio-grid">
                
                <!-- Database Portfolio Items -->
                @foreach($portfolios as $portfolio)
                    <div class="portfolio-item group bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2" data-category="{{ strtolower($portfolio->category) }}">
                        <div class="relative overflow-hidden">
                            @if($portfolio->image)
                                <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-56 sm:h-64 lg:h-72 object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-56 sm:h-64 lg:h-72 gradient-bg flex items-center justify-center">
                                    <svg class="w-12 sm:w-16 h-12 sm:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-70 transition-opacity duration-300"></div>
                            <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4 transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <div class="glass-bg rounded-lg sm:rounded-xl p-3 sm:p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-heading font-semibold text-base sm:text-lg">{{ $portfolio->title }}</h3>
                                            <p class="text-xs sm:text-sm text-purple-200">{{ $portfolio->location }}</p>
                                        </div>
                                        <div class="w-6 sm:w-8 h-6 sm:h-8 bg-white bg-opacity-20 rounded-md sm:rounded-lg flex items-center justify-center">
                                            <svg class="w-3 sm:w-4 h-3 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6">
                            <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2">{{ $portfolio->title }}</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4 leading-relaxed">{{ $portfolio->description }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-gray-500 text-xs sm:text-sm">
                                    <svg class="w-3 sm:w-4 h-3 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $portfolio->location }}
                                </div>
                                <span class="px-2 sm:px-3 py-1 text-xs font-semibold text-purple-600 bg-purple-100 rounded-full">
                                    {{ $portfolio->category }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Static Portfolio Items -->
                @foreach($portfolioImages as $index => $image)
                    <div class="portfolio-item group bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2" data-category="{{ $index % 3 == 0 ? 'residential' : ($index % 3 == 1 ? 'commercial' : 'luxury') }}">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset($image['path']) }}" alt="Portfolio {{ $index + 1 }}" class="w-full h-56 sm:h-64 lg:h-72 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-70 transition-opacity duration-300"></div>
                            <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4 transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <div class="glass-bg rounded-lg sm:rounded-xl p-3 sm:p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-heading font-semibold text-base sm:text-lg">{{ ucwords(str_replace(['_', '-'], ' ', $image['title'])) }}</h3>
                                            <p class="text-xs sm:text-sm text-purple-200">{{ ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta'][$index % 6] }}</p>
                                        </div>
                                        <div class="w-6 sm:w-8 h-6 sm:h-8 bg-white bg-opacity-20 rounded-md sm:rounded-lg flex items-center justify-center">
                                            <svg class="w-3 sm:w-4 h-3 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6">
                            <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2">{{ ucwords(str_replace(['_', '-'], ' ', $image['title'])) }}</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4 leading-relaxed">{{ ['Ruang tamu modern dengan sentuhan contemporary yang elegan dan fungsional.', 'Kantor eksekutif dengan desain professional yang meningkatkan produktivitas.', 'Kamar tidur mewah dengan suasana yang menenangkan dan relaxing.', 'Dapur kontemporer dengan layout efisien dan peralatan modern.', 'Kamar mandi minimalis dengan konsep clean dan sophisticated.', 'Ruang makan klasik dengan atmosfer hangat untuk keluarga.'][$index % 6] }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-gray-500 text-xs sm:text-sm">
                                    <svg class="w-3 sm:w-4 h-3 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta'][$index % 6] }}
                                </div>
                                <span class="px-2 sm:px-3 py-1 text-xs font-semibold text-purple-600 bg-purple-100 rounded-full">
                                    {{ $index % 3 == 0 ? 'Residential' : ($index % 3 == 1 ? 'Commercial' : 'Luxury') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if(count($portfolioImages) == 0 && count($portfolios) == 0)
                <div class="text-center py-16">
                    <div class="w-32 h-32 mx-auto mb-8 gradient-bg rounded-2xl flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 mb-4">Portfolio Segera Hadir</h3>
                    <p class="text-gray-600 max-w-md mx-auto">
                        Tim kami sedang menyiapkan koleksi portfolio terbaik untuk Anda. Tambahkan gambar di folder public/images/portfolio/ atau kelola melalui dashboard admin.
                    </p>
                </div>
            @endif
        @endif
    </div>
</section>

<!-- Services Showcase -->
<section class="py-12 sm:py-20 bg-white relative overflow-hidden">
    <div class="absolute bottom-0 left-0 w-48 sm:w-96 h-48 sm:h-96 bg-yellow-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16">
            <span class="text-purple-600 font-semibold text-xs sm:text-sm uppercase tracking-wider">Keunggulan Kami</span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2 mb-4 sm:mb-6 px-2">
                Mengapa Memilih Kami?
            </h2>
            <p class="text-sm sm:text-lg text-gray-600 max-w-3xl mx-auto px-4">
                Setiap project yang kami kerjakan didukung oleh tim professional yang berpengalaman dan peralatan yang modern.
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div class="text-center group">
                <div class="w-16 sm:w-20 h-16 sm:h-20 gradient-bg rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2 sm:mb-3">Kualitas Premium</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Menggunakan material berkualitas tinggi dalam setiap project.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 sm:w-20 h-16 sm:h-20 bg-blue-500 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2 sm:mb-3">Desain Inovatif</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Konsep desain yang selalu mengikuti tren global dengan sentuhan kreativitas lokal.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 sm:w-20 h-16 sm:h-20 bg-green-500 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2 sm:mb-3">Tepat Waktu</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Komitmen menyelesaikan setiap project sesuai deadline yang telah disepakati.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 sm:w-20 h-16 sm:h-20 bg-yellow-500 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2 sm:mb-3">Kepuasan Terjamin</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">99% tingkat kepuasan klien dengan garansi after-sales service yang komprehensif.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 sm:w-20 h-16 sm:h-20 bg-pink-500 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2 sm:mb-3">Konsultasi Expert</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Tim konsultan berpengalaman siap memberikan advice terbaik untuk project Anda.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 sm:w-20 h-16 sm:h-20 bg-indigo-500 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-heading font-semibold text-gray-900 mb-2 sm:mb-3">Teknologi Modern</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Progress pengerjaan bisa dimonitor melalui website Filia Interior.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 sm:py-20 relative overflow-hidden">
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-heading font-bold text-white mb-4 sm:mb-6 px-2">
                Inspired by Our Work?
            </h2>
            <p class="text-base sm:text-xl text-purple-100 mb-8 sm:mb-10 px-4">
                Mari wujudkan ruang impian Anda dengan sentuhan luxury dan modern. Tim expert kami siap membantu merealisasikan visi desain interior Anda.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                <a href="{{ route('contact') }}" class="group bg-white text-purple-900 px-6 sm:px-8 py-3 sm:py-4 rounded-xl sm:rounded-2xl font-semibold hover:bg-opacity-90 transition-all duration-300 transform hover:scale-105 shadow-2xl inline-flex items-center justify-center text-sm sm:text-base">
                    <svg class="mr-2 h-4 sm:h-5 w-4 sm:w-5 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Diskusi Project Anda
                </a>
                
                <a href="{{ route('history') }}" class="group glass-bg text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl sm:rounded-2xl font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center text-sm sm:text-base">
                    <svg class="mr-2 h-4 sm:h-5 w-4 sm:w-5 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pelajari Tentang Kami
                </a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    // Add intersection observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.8s ease forwards';
                entry.target.style.opacity = '1';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observe all portfolio items for scroll animation
    portfolioItems.forEach(item => {
        item.style.opacity = '0';
        observer.observe(item);
    });

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button with smooth transition
            filterBtns.forEach(b => {
                b.classList.remove('active', 'text-white');
                b.classList.remove('gradient-bg');
                b.classList.add('text-gray-600', 'hover:text-purple-600', 'hover:bg-purple-50');
            });
            
            this.classList.add('active', 'text-white', 'gradient-bg');
            this.classList.remove('text-gray-600', 'hover:text-purple-600', 'hover:bg-purple-50');
            
            // Filter items with staggered animation
            let delay = 0;
            portfolioItems.forEach((item, index) => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    setTimeout(() => {
                        item.style.display = 'block';
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(30px)';
                        
                        // Trigger animation
                        requestAnimationFrame(() => {
                            item.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        });
                    }, delay);
                    delay += 100; // Stagger delay
                } else {
                    item.style.transition = 'all 0.3s ease';
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Add hover effects for enhanced interactivity
    portfolioItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
            this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });
});
</script>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection