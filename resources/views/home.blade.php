@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center overflow-hidden" id="hero-section">
    <!-- Background -->
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
    </div>
    
    <!-- Enhanced Floating Elements -->
    <div class="floating-orb absolute top-20 right-20 w-72 h-72 bg-white bg-opacity-10 rounded-full mix-blend-multiply filter blur-xl"></div>
    <div class="floating-orb absolute top-40 left-20 w-72 h-72 bg-yellow-300 bg-opacity-20 rounded-full mix-blend-multiply filter blur-xl" style="animation-delay: 2s;"></div>
    <div class="floating-orb absolute bottom-20 right-1/2 w-48 h-48 bg-purple-300 bg-opacity-15 rounded-full mix-blend-multiply filter blur-xl" style="animation-delay: 4s;"></div>
    
    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="text-center">
            <div class="mb-8 hero-badge">
                <div class="inline-flex items-center glass-bg rounded-full px-6 py-3 text-white text-sm font-medium border border-white border-opacity-20">
                    <svg class="w-4 h-4 mr-2 text-yellow-400 sparkle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    Filia Interior Design Studio
                </div>
            </div>
            
            <h1 class="hero-title text-5xl md:text-7xl font-heading font-bold mb-8 text-white leading-tight">
                <span class="word-slide">Transforming</span> <span class="word-slide">Spaces</span> <span class="word-slide">Into</span>
                <span class="block bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 bg-clip-text text-transparent gradient-text">
                    Luxury Dreams
                </span>
            </h1>
            
            <p class="hero-subtitle text-xl md:text-2xl mb-12 max-w-4xl mx-auto text-purple-100 leading-relaxed">
                Kami menciptakan desain interior mewah yang menggabungkan keindahan, fungsionalitas, dan kepribadian unik Anda dalam setiap ruang dengan sentuhan profesional.
            </p>
            
            <div class="hero-buttons flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('portfolio') }}" class="btn-primary group bg-white text-purple-900 px-8 py-4 rounded-2xl font-semibold hover:bg-opacity-90 transition-all duration-500 transform hover:scale-105 shadow-2xl flex items-center">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Lihat Portfolio
                </a>
                <a href="{{ route('contact') }}" class="btn-secondary group glass-bg text-white px-8 py-4 rounded-2xl font-semibold hover:bg-white hover:bg-opacity-30 transition-all duration-500 transform hover:scale-105 flex items-center shadow-xl">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Scroll Indicator with Click Function -->
    <a href="#about-section" class="scroll-indicator absolute bottom-8 left-1/2 transform -translate-x-1/2 cursor-pointer">
        <div class="scroll-icon">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </a>
</section>

<!-- About Section -->
<section class="py-20 bg-white relative overflow-hidden" id="about-section">
    <!-- Enhanced floating backgrounds -->
    <div class="floating-bg absolute top-0 right-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
    <div class="floating-bg absolute top-0 left-0 w-96 h-96 bg-yellow-100 rounded-full mix-blend-multiply filter blur-xl opacity-70" style="animation-delay: 1s;"></div>
    <div class="floating-bg absolute bottom-0 center w-64 h-64 bg-pink-100 rounded-full mix-blend-multiply filter blur-xl opacity-50" style="animation-delay: 3s;"></div>
    
    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
            <div class="about-content">
                <div class="mb-6 section-header">
                    <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider badge-slide">Tentang Kami</span>
                    <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2 leading-tight title-reveal">
                        Filia Interior
                        <span class="text-purple-600 highlight-text">Design Studio</span>
                    </h2>
                </div>
                
                <p class="text-lg text-gray-600 mb-8 leading-relaxed content-fade">
                    Dengan pengalaman lebih dari 30 tahun dalam industri desain interior mewah, kami telah membantu lebih dari 150 klien mewujudkan rumah impian mereka. Tim ahli kami terdiri dari desainer berpengalaman internasional yang memahami tren global dan kebutuhan fungsional setiap ruang.
                </p>
                
                <!-- Enhanced Stats Grid -->
                <div class="grid grid-cols-2 gap-6 mb-8 stats-container">
                    <div class="stat-card stat-card-1 text-center p-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl border border-purple-100 hover:shadow-lg transition-all duration-500">
                        <div class="stat-number text-4xl font-heading font-bold text-purple-600 mb-2" data-target="150">0</div>
                        <div class="text-gray-600 font-medium">Proyek Selesai</div>
                    </div>
                    <div class="stat-card stat-card-2 text-center p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border border-yellow-100 hover:shadow-lg transition-all duration-500">
                        <div class="stat-number text-4xl font-heading font-bold text-orange-600 mb-2" data-target="30">0</div>
                        <div class="text-gray-600 font-medium">Tahun Pengalaman</div>
                    </div>
                    <div class="stat-card stat-card-3 text-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100 hover:shadow-lg transition-all duration-500">
                        <div class="stat-number text-4xl font-heading font-bold text-green-600 mb-2" data-target="150">0</div>
                        <div class="text-gray-600 font-medium">Kepuasan Klien</div>
                    </div>
                    <div class="stat-card stat-card-4 text-center p-6 bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl border border-pink-100 hover:shadow-lg transition-all duration-500">
                        <div class="stat-number text-4xl font-heading font-bold text-pink-600 mb-2" data-target="11">0</div>
                        <div class="text-gray-600 font-medium">Tim Profesional</div>
                    </div>
                </div>
                
                <a href="{{ route('history') }}" class="cta-link inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold transition-all duration-300 group">
                    Pelajari Lebih Lanjut
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <div class="lg:pl-8 images-container mt-8 lg:mt-0">
                @if(isset($portfolioImages) && count($portfolioImages) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 image-grid">
                        @foreach($portfolioImages as $index => $image)
                            <div class="image-card relative group overflow-hidden rounded-xl" style="animation-delay: {{ $index * 0.1 }}s;">
                                <img src="{{ asset($image) }}" alt="Portfolio Image" class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-70 transition-opacity duration-500"></div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-12 text-center border border-gray-200 placeholder-content">
                        <div class="w-24 h-24 mx-auto mb-6 gradient-bg rounded-2xl flex items-center justify-center icon-bounce">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Tambahkan foto portfolio di folder public/images/portfolio/</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 bg-gray-50 relative" id="services-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 section-intro">
            <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider badge-slide">Layanan Kami</span>
            <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2 mb-4 title-reveal">
                Solusi Desain Interior Terlengkap
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto content-fade">
                Kami menyediakan berbagai layanan desain interior yang komprehensif untuk memenuhi semua kebutuhan Anda dengan standar internasional.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 services-grid">
            <div class="service-card service-card-1 group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-purple-200">
                <div class="service-icon w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Desain Ruang Tamu</h3>
                <p class="text-gray-600 leading-relaxed">Menciptakan ruang tamu yang nyaman dan elegan untuk berkumpul bersama keluarga dan tamu dengan konsep modern luxury.</p>
            </div>
            
            <div class="service-card service-card-2 group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-blue-200">
                <div class="service-icon w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Desain Kamar Tidur</h3>
                <p class="text-gray-600 leading-relaxed">Merancang kamar tidur yang memberikan kenyamanan maksimal untuk istirahat yang berkualitas dengan suasana yang menenangkan.</p>
            </div>
            
            <div class="service-card service-card-3 group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-green-200">
                <div class="service-icon w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V4H8v2m8 0h1a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V8a2 2 0 012-2h1" />
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Desain Dapur</h3>
                <p class="text-gray-600 leading-relaxed">Membuat dapur yang fungsional dan estetis untuk aktivitas memasak yang menyenangkan dengan layout yang efisien.</p>
            </div>
            
            <div class="service-card service-card-4 group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-yellow-200">
                <div class="service-icon w-16 h-16 bg-yellow-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Desain Kantor</h3>
                <p class="text-gray-600 leading-relaxed">Menciptakan ruang kerja yang produktif dan inspiratif untuk meningkatkan performa dengan atmosphere yang professional.</p>
            </div>
            
            <div class="service-card service-card-5 group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-pink-200">
                <div class="service-icon w-16 h-16 bg-pink-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Konsultasi Desain</h3>
                <p class="text-gray-600 leading-relaxed">Memberikan konsultasi ahli untuk membantu Anda merencanakan desain interior yang tepat sesuai budget dan preferensi.</p>
            </div>
            
            <div class="service-card service-card-6 group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-indigo-200">
                <div class="service-icon w-16 h-16 bg-indigo-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Renovasi Total</h3>
                <p class="text-gray-600 leading-relaxed">Layanan renovasi menyeluruh untuk mengubah total tampilan dan fungsi ruang Anda dengan hasil yang menakjubkan.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative overflow-hidden" id="cta-section">
    <!-- Enhanced Background with Floating Elements -->
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        
        <!-- Floating CTA Elements -->
        <div class="floating-cta-orb absolute top-10 left-10 w-32 h-32 bg-white bg-opacity-10 rounded-full blur-xl"></div>
        <div class="floating-cta-orb absolute top-32 right-20 w-24 h-24 bg-purple-300 bg-opacity-20 rounded-full blur-lg"></div>
        <div class="floating-cta-orb absolute bottom-20 left-1/4 w-40 h-40 bg-blue-300 bg-opacity-15 rounded-full blur-2xl"></div>
        <div class="floating-cta-orb absolute bottom-32 right-1/3 w-28 h-28 bg-yellow-300 bg-opacity-10 rounded-full blur-xl"></div>
        
        <!-- Animated Gradient Overlay -->
        <div class="absolute inset-0 opacity-50">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-purple-600 via-transparent to-blue-600 animate-pulse"></div>
        </div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto">
            <!-- Animated Badge -->
            <div class="cta-badge inline-flex items-center px-4 py-2 rounded-full bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg text-white text-sm font-medium mb-8">
                <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                Available for New Projects
            </div>
            
            <!-- Enhanced Title with Character Animation -->
            <h2 class="cta-title text-4xl lg:text-5xl font-heading font-bold text-white mb-6 leading-tight">
                <span class="cta-word inline-block">Siap</span>
                <span class="cta-word inline-block">Mewujudkan</span>
                <span class="cta-word inline-block">Ruang</span>
                <span class="cta-word inline-block gradient-text-cta">Impian</span>
                <span class="cta-word inline-block">Anda?</span>
            </h2>
            
            <!-- Enhanced Subtitle -->
            <p class="cta-subtitle text-xl text-purple-100 mb-10 leading-relaxed">
                Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik untuk proyek desain interior mewah Anda. Tim ahli kami siap membantu mewujudkan visi Anda.
            </p>
            
            <!-- Enhanced Action Buttons -->
            <div class="cta-buttons flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="cta-btn-primary group bg-white text-purple-900 px-8 py-4 rounded-2xl font-semibold hover:bg-opacity-90 transition-all duration-500 transform hover:scale-105 shadow-2xl inline-flex items-center justify-center overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 group-hover:text-white transition-colors duration-500 flex items-center">
                        <svg class="mr-2 h-5 w-5 group-hover:rotate-12 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Mulai Konsultasi
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full opacity-0 group-hover:opacity-100">
                        <div class="floating-sparkle absolute top-2 left-4 w-1 h-1 bg-white rounded-full"></div>
                        <div class="floating-sparkle absolute top-6 right-6 w-1 h-1 bg-white rounded-full"></div>
                        <div class="floating-sparkle absolute bottom-4 left-1/3 w-1 h-1 bg-white rounded-full"></div>
                    </div>
                </a>
                
                <a href="{{ route('portfolio') }}" class="cta-btn-secondary group glass-bg text-white px-8 py-4 rounded-2xl font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-500 transform hover:scale-105 inline-flex items-center justify-center border border-white border-opacity-30 hover:border-opacity-50 backdrop-filter backdrop-blur-lg">
                    <svg class="mr-2 h-5 w-5 group-hover:rotate-12 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Lihat Portfolio
                </a>
            </div>
            
            <!-- Trust Indicators -->
            <div class="cta-trust mt-12 flex flex-wrap justify-center items-center gap-8 text-purple-100">
                <div class="trust-item flex items-center">
                    <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="text-sm font-medium">150+ Happy Clients</span>
                </div>
                <div class="trust-item flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium">30+ Years Experience</span>
                </div>
                <div class="trust-item flex items-center">
                    <svg class="w-5 h-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium">Premium Quality</span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Custom Animation Styles */
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-20px) rotate(2deg); }
    66% { transform: translateY(-10px) rotate(-1deg); }
}

@keyframes floatReverse {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-15px) rotate(-2deg); }
    66% { transform: translateY(-25px) rotate(1deg); }
}

@keyframes floatSlow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(3deg); }
}

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); opacity: 1; }
    25% { transform: scale(1.2) rotate(90deg); opacity: 0.8; }
    50% { transform: scale(0.8) rotate(180deg); opacity: 1; }
    75% { transform: scale(1.1) rotate(270deg); opacity: 0.9; }
}

@keyframes slideInLeft {
    from { transform: translateX(-100px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideInRight {
    from { transform: translateX(100px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideInUp {
    from { transform: translateY(80px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes slideInDown {
    from { transform: translateY(-80px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes fadeInScale {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes bounceIn {
    0% { transform: scale(0.3); opacity: 0; }
    50% { transform: scale(1.05); opacity: 1; }
    70% { transform: scale(0.9); }
    100% { transform: scale(1); }
}

@keyframes pulseGlow {
    0%, 100% { box-shadow: 0 0 20px rgba(139, 92, 246, 0.3); }
    50% { box-shadow: 0 0 40px rgba(139, 92, 246, 0.6); }
}

@keyframes scrollBounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

@keyframes typewriter {
    from { width: 0; }
    to { width: 100%; }
}

/* Enhanced Element Animations */
.floating-orb {
    animation: float 6s ease-in-out infinite;
}

.floating-orb:nth-child(2) {
    animation: floatReverse 8s ease-in-out infinite;
}

.floating-orb:nth-child(3) {
    animation: floatSlow 10s ease-in-out infinite;
}

.floating-bg {
    animation: float 8s ease-in-out infinite;
}

.sparkle-icon {
    animation: sparkle 3s ease-in-out infinite;
}

.hero-badge {
    animation: slideInDown 1s ease-out 0.2s both;
}

.hero-title .word-slide:nth-child(1) {
    animation: slideInLeft 1s ease-out 0.4s both;
}

.hero-title .word-slide:nth-child(2) {
    animation: slideInUp 1s ease-out 0.6s both;
}

.hero-title .word-slide:nth-child(3) {
    animation: slideInRight 1s ease-out 0.8s both;
}

.gradient-text {
    background-size: 300% 300%;
    animation: gradientShift 3s ease infinite, slideInUp 1.2s ease-out 1s both;
}

.hero-subtitle {
    animation: fadeInScale 1s ease-out 1.4s both;
}

.hero-buttons {
    animation: slideInUp 1s ease-out 1.6s both;
}

.btn-primary {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-primary:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 20px 40px rgba(139, 92, 246, 0.3);
}

.btn-secondary {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-secondary:hover {
    transform: translateY(-3px) scale(1.05);
    backdrop-filter: blur(20px);
}

.scroll-indicator {
    animation: scrollBounce 2s infinite;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 10;
    position: relative;
    overflow: hidden;
}

.scroll-indicator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: pulse 2s infinite;
    z-index: -1;
}

.scroll-icon {
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.scroll-indicator:hover {
    transform: translate(-50%, -50%) scale(1.1);
}

.scroll-indicator:hover .scroll-icon {
    transform: scale(1.2);
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 30px rgba(139, 92, 246, 0.5);
}

.scroll-indicator:active {
    transform: translate(-50%, -50%) scale(0.95);
}

@keyframes pulse {
    0%, 100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.1);
        opacity: 0.7;
    }
}

/* Enhanced Ripple Effect for Scroll Indicator */
@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* About Section Animations */
.badge-slide {
    animation: slideInLeft 0.8s ease-out;
}

.title-reveal {
    animation: slideInUp 1s ease-out 0.2s both;
}

.highlight-text {
    position: relative;
    overflow: hidden;
}

.highlight-text::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, #8b5cf6, #06b6d4);
    animation: slideInRight 1s ease-out 1.2s forwards;
}

.content-fade {
    animation: fadeInScale 1s ease-out 0.4s both;
}

.stats-container {
    animation: slideInUp 1s ease-out 0.6s both;
}

.stat-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: bounceIn 0.8s ease-out both;
}

.stat-card-1 { animation-delay: 0.8s; }
.stat-card-2 { animation-delay: 1s; }
.stat-card-3 { animation-delay: 1.2s; }
.stat-card-4 { animation-delay: 1.4s; }

.stat-card:hover {
    transform: translateY(-8px) scale(1.03);
    animation: pulseGlow 2s infinite;
}

.cta-link {
    animation: slideInLeft 1s ease-out 1.6s both;
    transition: all 0.3s ease;
}

.cta-link:hover {
    transform: translateX(10px);
}

.image-card {
    animation: fadeInScale 0.8s ease-out both;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.image-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
}

.placeholder-content {
    animation: fadeInScale 1s ease-out 0.8s both;
}

.icon-bounce {
    animation: bounceIn 1s ease-out 1s both;
}

/* Services Section Animations */
.section-intro {
    animation: slideInUp 1s ease-out both;
}

.services-grid {
    animation: fadeInScale 1s ease-out 0.4s both;
}

.service-card {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    animation: slideInUp 0.8s ease-out both;
}

.service-card-1 { animation-delay: 0.1s; }
.service-card-2 { animation-delay: 0.2s; }
.service-card-3 { animation-delay: 0.3s; }
.service-card-4 { animation-delay: 0.4s; }
.service-card-5 { animation-delay: 0.5s; }
.service-card-6 { animation-delay: 0.6s; }

.service-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.service-icon {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card:hover .service-icon {
    transform: scale(1.1) rotate(5deg);
}

/* Intersection Observer Classes */
.animate-in {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

.observer-target {
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Enhanced hover effects */
.hover-lift {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* CTA Section Animations */
.floating-cta-orb {
    animation: float 8s ease-in-out infinite;
}

.floating-cta-orb:nth-child(2) {
    animation: floatReverse 10s ease-in-out infinite;
}

.floating-cta-orb:nth-child(3) {
    animation: floatSlow 12s ease-in-out infinite;
}

.floating-cta-orb:nth-child(4) {
    animation: float 7s ease-in-out infinite;
}

.cta-badge {
    animation: slideInDown 1s ease-out 0.2s both;
}

.cta-title .cta-word:nth-child(1) {
    animation: slideInLeft 0.8s ease-out 0.4s both;
}

.cta-title .cta-word:nth-child(2) {
    animation: slideInUp 0.8s ease-out 0.6s both;
}

.cta-title .cta-word:nth-child(3) {
    animation: slideInRight 0.8s ease-out 0.8s both;
}

.cta-title .cta-word:nth-child(4) {
    animation: bounceIn 1s ease-out 1s both;
}

.cta-title .cta-word:nth-child(5) {
    animation: slideInLeft 0.8s ease-out 1.2s both;
}

.gradient-text-cta {
    background: linear-gradient(45deg, #ffd700, #ff6b6b, #4ecdc4, #45b7d1);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradientShift 2s ease infinite;
}

.cta-subtitle {
    animation: fadeInScale 1s ease-out 1.4s both;
}

.cta-buttons {
    animation: slideInUp 1s ease-out 1.6s both;
}

.cta-btn-primary {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.cta-btn-primary:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 25px 50px rgba(139, 92, 246, 0.4);
}

.cta-btn-secondary {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.cta-btn-secondary:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 25px 50px rgba(255, 255, 255, 0.2);
}

.floating-sparkle {
    animation: sparkle 2s infinite;
}

.cta-trust {
    animation: slideInUp 1s ease-out 1.8s both;
}

.trust-item {
    transition: all 0.3s ease;
    animation: fadeInScale 0.8s ease-out both;
}

.trust-item:nth-child(1) { animation-delay: 2s; }
.trust-item:nth-child(2) { animation-delay: 2.2s; }
.trust-item:nth-child(3) { animation-delay: 2.4s; }

.trust-item:hover {
    transform: scale(1.1);
    color: white;
}

/* Navigation Animations */
@keyframes navSlideIn {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.nav-animate {
    animation: navSlideIn 0.8s ease-out both;
}

.nav-logo {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-logo:hover {
    transform: scale(1.05) rotate(2deg);
}

.nav-link {
    position: relative;
    transition: all 0.3s ease;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #8b5cf6, #06b6d4);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::after {
    width: 100%;
}

.nav-link:hover {
    color: #8b5cf6;
    transform: translateY(-1px);
}

/* Mobile Menu Animations */
.mobile-menu-slide {
    transform: translateY(-20px);
    opacity: 0;
    transition: all 0.3s ease;
}

.mobile-menu-slide.active {
    transform: translateY(0);
    opacity: 1;
}

.mobile-menu-item {
    transform: translateX(-20px);
    opacity: 0;
    animation: slideInLeft 0.4s ease-out forwards;
}

.mobile-menu-item:nth-child(1) { animation-delay: 0.1s; }
.mobile-menu-item:nth-child(2) { animation-delay: 0.2s; }
.mobile-menu-item:nth-child(3) { animation-delay: 0.3s; }
.mobile-menu-item:nth-child(4) { animation-delay: 0.4s; }
.mobile-menu-item:nth-child(5) { animation-delay: 0.5s; }

/* Footer Animations */
@keyframes footerSlideUp {
    from { transform: translateY(50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.footer-animate {
    animation: footerSlideUp 1s ease-out both;
}

.footer-section {
    animation: slideInUp 0.8s ease-out both;
}

.footer-section:nth-child(1) { animation-delay: 0.1s; }
.footer-section:nth-child(2) { animation-delay: 0.3s; }
.footer-section:nth-child(3) { animation-delay: 0.5s; }
.footer-section:nth-child(4) { animation-delay: 0.7s; }

.footer-social {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.footer-social:hover {
    transform: translateY(-3px) scale(1.1);
    background: linear-gradient(45deg, #8b5cf6, #06b6d4);
}

.footer-link {
    position: relative;
    transition: all 0.3s ease;
}

.footer-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: #8b5cf6;
    transition: width 0.3s ease;
}

.footer-link:hover::after {
    width: 100%;
}

.footer-link:hover {
    color: #8b5cf6;
    transform: translateX(5px);
}

/* Enhanced Loading Animation */
@keyframes pageLoad {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.page-load {
    animation: pageLoad 0.8s ease-out both;
}

/* Scroll Indicator Enhancement */
.scroll-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, #8b5cf6, #06b6d4);
    z-index: 100;
    transition: width 0.1s ease;
}

/* Enhanced Button Hover Effects */
.btn-hover-effect {
    position: relative;
    overflow: hidden;
}

.btn-hover-effect::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.btn-hover-effect:hover::before {
    left: 100%;
}

/* Card Flip Animation */
@keyframes cardFlip {
    0% { transform: rotateY(0); }
    50% { transform: rotateY(90deg); }
    100% { transform: rotateY(0); }
}

.card-flip:hover {
    animation: cardFlip 0.6s ease-in-out;
}

/* Text Reveal Animation */
@keyframes textReveal {
    0% { 
        transform: translateY(100%);
        opacity: 0;
    }
    100% { 
        transform: translateY(0);
        opacity: 1;
    }
}

.text-reveal {
    overflow: hidden;
}

.text-reveal span {
    display: inline-block;
    animation: textReveal 0.8s ease-out both;
}

/* Enhanced Glow Effects */
.glow-on-hover {
    transition: all 0.4s ease;
}

.glow-on-hover:hover {
    box-shadow: 0 0 30px rgba(139, 92, 246, 0.6);
    transform: scale(1.02);
}

/* Staggered List Animation */
.staggered-list > * {
    opacity: 0;
    transform: translateX(-20px);
    animation: slideInLeft 0.6s ease-out forwards;
}

.staggered-list > *:nth-child(1) { animation-delay: 0.1s; }
.staggered-list > *:nth-child(2) { animation-delay: 0.2s; }
.staggered-list > *:nth-child(3) { animation-delay: 0.3s; }
.staggered-list > *:nth-child(4) { animation-delay: 0.4s; }
.staggered-list > *:nth-child(5) { animation-delay: 0.5s; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .floating-orb {
        width: 200px !important;
        height: 200px !important;
    }
    
    .floating-cta-orb {
        width: 100px !important;
        height: 100px !important;
    }
    
    .hero-title {
        font-size: 2.5rem !important;
    }
    
    .cta-title {
        font-size: 2rem !important;
    }
    
    .word-slide, .cta-word {
        animation-duration: 0.6s;
    }
    
    .trust-item {
        font-size: 0.875rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎭 Enhanced Animations Loading...');

    // Enhanced Intersection Observer with staggered animations
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -100px 0px'
    };

    const animationObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('animate-in');
                }, index * 100); // Staggered animation
                animationObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Enhanced Counter Animation with easing
    const createCounter = (element, target, duration = 2500) => {
        const start = parseInt(element.textContent) || 0;
        const end = target;
        const range = end - start;
        const startTime = performance.now();
        
        const easeOutQuart = t => 1 - (--t) * t * t * t;
        
        const updateCounter = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuart(progress);
            
            const current = Math.floor(start + (range * easedProgress));
            element.textContent = current.toLocaleString() + (element.dataset.suffix || '');
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = end.toLocaleString() + (element.dataset.suffix || '');
                // Add completion effect
                element.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            }
        };
        
        requestAnimationFrame(updateCounter);
    };

    // Stats Counter Observer
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalValue = parseInt(target.dataset.target);
                const suffix = target.textContent.includes('+') ? '+' : 
                             target.textContent.includes('%') ? '%' : '';
                target.dataset.suffix = suffix;
                
                createCounter(target, finalValue);
                statsObserver.unobserve(target);
            }
        });
    }, { threshold: 0.5 });

    // Enhanced Parallax with performance optimization
    let ticking = false;
    const handleParallax = () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.3;
                
                document.querySelectorAll('.floating-orb').forEach((element, index) => {
                    const speed = 0.2 + (index * 0.1);
                    const yPos = -(scrolled * speed);
                    const rotate = scrolled * 0.05;
                    
                    element.style.transform = `translate3d(0, ${yPos}px, 0) rotate(${rotate}deg)`;
                });

                document.querySelectorAll('.floating-bg').forEach((element, index) => {
                    const speed = 0.15 + (index * 0.05);
                    const yPos = -(scrolled * speed);
                    
                    element.style.transform = `translate3d(0, ${yPos}px, 0)`;
                });
                
                ticking = false;
            });
            ticking = true;
        }
    };

    // Mouse movement parallax for hero section
    const heroSection = document.getElementById('hero-section');
    if (heroSection) {
        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = (e.clientY - rect.top) / rect.height;
            
            document.querySelectorAll('.floating-orb').forEach((orb, index) => {
                const strength = 20 + (index * 10);
                const xMove = (x - 0.5) * strength;
                const yMove = (y - 0.5) * strength;
                
                orb.style.transform += ` translate(${xMove}px, ${yMove}px)`;
            });
        });
    }

    // Enhanced card interactions
    const enhanceCardInteractions = () => {
        document.querySelectorAll('.service-card, .stat-card, .image-card').forEach(card => {
            card.addEventListener('mouseenter', function(e) {
                this.style.transform = 'translateY(-10px) scale(1.02)';
                this.style.zIndex = '10';
                
                // Add glow effect
                const rect = this.getBoundingClientRect();
                this.style.boxShadow = `0 25px 50px rgba(139, 92, 246, 0.2)`;
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.zIndex = '1';
                this.style.boxShadow = '';
            });

            // Add ripple effect on click
            card.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(139, 92, 246, 0.3);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    left: ${x}px;
                    top: ${y}px;
                    width: ${size}px;
                    height: ${size}px;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    };

    // Typing effect for hero title
    const createTypingEffect = () => {
        const title = document.querySelector('.hero-title');
        if (title) {
            const words = title.querySelectorAll('.word-slide');
            words.forEach((word, index) => {
                word.style.opacity = '0';
                setTimeout(() => {
                    word.style.opacity = '1';
                    word.style.animation = `slideInLeft 0.8s ease-out forwards`;
                }, index * 200);
            });
        }
    };

    // Enhanced scroll-triggered animations
    const observeElements = () => {
        const targets = document.querySelectorAll(`
            .service-card, .stat-card, .image-card,
            .section-header, .content-fade, .cta-link,
            .about-content, .images-container, .section-intro
        `);

        targets.forEach((el, index) => {
            el.classList.add('observer-target');
            setTimeout(() => {
                animationObserver.observe(el);
            }, index * 50);
        });

        // Stats counters
        document.querySelectorAll('.stat-number').forEach(counter => {
            statsObserver.observe(counter);
        });
    };

    // Add ripple animation keyframes
    const addRippleStyles = () => {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    };

    // Enhanced CTA Section Interactions
    const enhanceCTASection = () => {
        const ctaSection = document.getElementById('cta-section');
        if (!ctaSection) return;

        // CTA Section Mouse Parallax
        ctaSection.addEventListener('mousemove', (e) => {
            const rect = ctaSection.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = (e.clientY - rect.top) / rect.height;
            
            document.querySelectorAll('.floating-cta-orb').forEach((orb, index) => {
                const strength = 15 + (index * 8);
                const xMove = (x - 0.5) * strength;
                const yMove = (y - 0.5) * strength;
                
                orb.style.transform += ` translate(${xMove}px, ${yMove}px)`;
            });
        });

        // Enhanced CTA Button Effects
        document.querySelectorAll('.cta-btn-primary, .cta-btn-secondary').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.05)';
                
                // Add dynamic sparkles
                if (this.classList.contains('cta-btn-primary')) {
                    this.style.boxShadow = '0 25px 50px rgba(139, 92, 246, 0.4), 0 0 30px rgba(255, 255, 255, 0.3)';
                }
            });

            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '';
            });

            // Add click ripple effect
            btn.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.6);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    left: ${x}px;
                    top: ${y}px;
                    width: ${size}px;
                    height: ${size}px;
                    pointer-events: none;
                    z-index: 1;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
    };

    // Enhanced Scroll Progress Bar
    const createScrollProgress = () => {
        const scrollProgress = document.createElement('div');
        scrollProgress.className = 'scroll-progress';
        document.body.appendChild(scrollProgress);

        window.addEventListener('scroll', () => {
            const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            scrollProgress.style.width = scrolled + '%';
        });
    };

    // Enhanced Scroll Indicator Function
    const enhanceScrollIndicator = () => {
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            // Add click event for smooth scrolling
            scrollIndicator.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector('#about-section');
                if (target) {
                    // Add ripple effect
                    const ripple = document.createElement('div');
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.6);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        left: 50%;
                        top: 50%;
                        width: 30px;
                        height: 30px;
                        margin-left: -15px;
                        margin-top: -15px;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                    
                    // Smooth scroll to target
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });

            // Hide scroll indicator when scrolled past hero section
            window.addEventListener('scroll', () => {
                const heroHeight = document.querySelector('.hero-section')?.offsetHeight || 0;
                if (window.scrollY > heroHeight * 0.8) {
                    scrollIndicator.style.opacity = '0';
                    scrollIndicator.style.pointerEvents = 'none';
                } else {
                    scrollIndicator.style.opacity = '1';
                    scrollIndicator.style.pointerEvents = 'auto';
                }
            });

            // Enhanced hover effect
            scrollIndicator.addEventListener('mouseenter', function() {
                this.style.transform = 'translate(-50%, -50%) scale(1.1)';
            });

            scrollIndicator.addEventListener('mouseleave', function() {
                this.style.transform = 'translate(-50%, -50%) scale(1)';
            });
        }
    };

    // Enhanced Navigation Animations
    const enhanceNavigation = () => {
        const nav = document.querySelector('nav');
        if (nav) {
            nav.classList.add('nav-animate');
            
            // Add hover effects to navigation links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        }
    };

    // Enhanced Footer Animations
    const enhanceFooter = () => {
        const footer = document.querySelector('footer');
        if (footer) {
            const footerObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        footer.classList.add('footer-animate');
                        
                        // Animate footer sections
                        footer.querySelectorAll('.col-span-1, .col-span-2').forEach((section, index) => {
                            section.classList.add('footer-section');
                            section.style.animationDelay = `${index * 0.2}s`;
                        });
                        
                        footerObserver.unobserve(footer);
                    }
                });
            }, { threshold: 0.1 });
            
            footerObserver.observe(footer);
        }
    };

    // Enhanced Text Reveal Animation
    const createTextReveal = () => {
        document.querySelectorAll('.text-reveal').forEach(element => {
            const text = element.textContent;
            const words = text.split(' ');
            element.innerHTML = words.map(word => `<span>${word}</span>`).join(' ');
            
            element.querySelectorAll('span').forEach((span, index) => {
                span.style.animationDelay = `${index * 0.1}s`;
            });
        });
    };

    // Enhanced Mobile Menu with Animations
    const enhanceMobileMenu = () => {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                const isActive = mobileMenu.classList.contains('active');
                
                if (!isActive) {
                    // Add staggered animation to menu items
                    mobileMenu.querySelectorAll('a').forEach((item, index) => {
                        item.classList.add('mobile-menu-item');
                        item.style.animationDelay = `${index * 0.1}s`;
                    });
                } else {
                    // Remove animation classes
                    mobileMenu.querySelectorAll('a').forEach(item => {
                        item.classList.remove('mobile-menu-item');
                        item.style.animationDelay = '';
                    });
                }
            });
        }
    };

    // Enhanced Scroll Triggered Animations
    const enhanceScrollAnimations = () => {
        // Enhanced observer for better performance
        const enhancedObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('animate-in');
                        
                        // Add special effects for specific elements
                        if (entry.target.classList.contains('cta-section')) {
                            entry.target.style.transform = 'scale(1.02)';
                            setTimeout(() => {
                                entry.target.style.transform = 'scale(1)';
                            }, 300);
                        }
                        
                        // Add glow effect for cards
                        if (entry.target.classList.contains('service-card') || 
                            entry.target.classList.contains('stat-card')) {
                            entry.target.classList.add('glow-on-hover');
                        }
                        
                    }, index * 80);
                    enhancedObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe CTA section and other elements
        document.querySelectorAll(`
            #cta-section, .cta-badge, .cta-title, .cta-subtitle, 
            .cta-buttons, .cta-trust, .trust-item
        `).forEach(el => {
            enhancedObserver.observe(el);
        });
    };

    // Page Load Animation
    const initPageLoad = () => {
        document.body.classList.add('page-load');
        
        // Animate elements on page load
        setTimeout(() => {
            document.querySelectorAll('.hero-section, .about-section, .services-section').forEach((section, index) => {
                section.style.animationDelay = `${index * 0.2}s`;
                section.classList.add('page-load');
            });
        }, 200);
    };

    // Dynamic Background Particles
    const createBackgroundParticles = () => {
        const heroSection = document.getElementById('hero-section');
        if (!heroSection) return;

        for (let i = 0; i < 5; i++) {
            const particle = document.createElement('div');
            particle.className = 'absolute rounded-full opacity-20';
            particle.style.cssText = `
                width: ${Math.random() * 20 + 10}px;
                height: ${Math.random() * 20 + 10}px;
                background: ${i % 2 === 0 ? '#8b5cf6' : '#06b6d4'};
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                animation: float ${Math.random() * 10 + 8}s ease-in-out infinite;
                animation-delay: ${Math.random() * 5}s;
                z-index: 1;
            `;
            heroSection.appendChild(particle);
        }
    };

    // Initialize all enhanced animations
    const initEnhancedAnimations = () => {
        console.log('🎨 Initializing enhanced page animations...');
        
        initPageLoad();
        createScrollProgress();
        enhanceScrollIndicator();
        enhanceNavigation();
        enhanceCTASection();
        enhanceFooter();
        enhanceMobileMenu();
        enhanceScrollAnimations();
        createTextReveal();
        createBackgroundParticles();
        
        console.log('🚀 All enhanced animations loaded successfully!');
    };

    // Initialize all animations
    const initAnimations = () => {
        console.log('🚀 Initializing enhanced animations...');
        
        addRippleStyles();
        observeElements();
        enhanceCardInteractions();
        createTypingEffect();
        initEnhancedAnimations();
        
        // Event listeners
        window.addEventListener('scroll', handleParallax, { passive: true });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        console.log('✨ Enhanced animations loaded successfully!');
    };

    // Start animations after a short delay
    setTimeout(initAnimations, 100);

    // Re-run animations on dynamic content load
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.addedNodes.length) {
                enhanceCardInteractions();
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});
</script>
@endsection