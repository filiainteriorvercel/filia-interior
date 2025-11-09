@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 30% 70%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 70% 30%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-6">
            <span class="inline-flex items-center glass-bg rounded-full px-6 py-3 text-white text-sm font-medium border border-white border-opacity-20">
                <svg class="w-4 h-4 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Sejarah Perusahaan
            </span>
        </div>
        
        <h1 class="text-5xl md:text-6xl font-heading font-bold mb-6 text-white leading-tight">
            Perjalanan
            <span class="block bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">
                Filia Interior
            </span>
        </h1>
        
        <p class="text-xl text-purple-100 max-w-4xl mx-auto leading-relaxed">
            Dari visi sederhana hingga menjadi studio desain interior mewah terpercaya di Indonesia
        </p>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Kisah Kami</span>
            <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2 mb-6">
                Misi Menciptakan Ruang Impian
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Perjalanan kami dimulai dari passion untuk menciptakan ruang yang tidak hanya indah, tetapi juga fungsional dan mencerminkan kepribadian unik setiap klien.
            </p>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="py-20 bg-gray-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Milestone</span>
            <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2">
                Pencapaian Bersejarah
            </h2>
        </div>
        
        <div class="relative">
            <!-- Timeline Line for Desktop -->
            <div class="hidden lg:block absolute left-1/2 transform -translate-x-px h-full w-1 bg-gradient-to-b from-purple-400 to-blue-500"></div>
            
            <!-- Timeline Items -->
            <div class="space-y-12 lg:space-y-16">
                
                <!-- 1992 - Foundation -->
                <div class="relative flex flex-col lg:flex-row items-center">
                    <!-- Content Left (Desktop) / Center (Mobile) -->
                    <div class="w-full lg:w-5/12 lg:pr-8">
                        <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-lg border border-gray-100 lg:text-right text-center">
                            <div class="inline-block bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                1992
                            </div>
                            <h3 class="text-xl lg:text-2xl font-heading font-bold text-gray-900 mb-3">Awal Mula</h3>
                            <p class="text-gray-600 leading-relaxed mb-4 text-sm lg:text-base">
                                Mimpi yang dimulai dari garasi. Dimulai dengan membuka kantor di garasi milik teman.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Timeline Dot -->
                    <div class="hidden lg:flex w-2/12 justify-center my-4 lg:my-0">
                        <div class="w-16 h-16 bg-white border-4 border-purple-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Empty Space Right -->
                    <div class="hidden lg:block w-5/12"></div>
                </div>

                <!-- 1995 - Expansion -->
                <div class="relative flex flex-col lg:flex-row items-center">
                    <!-- Empty Space Left -->
                    <div class="hidden lg:block w-5/12"></div>
                    
                    <!-- Timeline Dot -->
                    <div class="hidden lg:flex w-2/12 justify-center my-4 lg:my-0">
                        <div class="w-16 h-16 bg-white border-4 border-blue-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Content Right (Desktop) / Center (Mobile) -->
                    <div class="w-full lg:w-5/12 lg:pl-8">
                        <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-lg border border-gray-100 text-center lg:text-left">
                            <div class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                1995
                            </div>
                            <h3 class="text-xl lg:text-2xl font-heading font-bold text-gray-900 mb-3">Berpindah Kantor</h3>
                            <p class="text-gray-600 leading-relaxed mb-4 text-sm lg:text-base">
                                Memiliki kantor baru di jalan raya Dukuh Kupang.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 1999 - Recognition -->
                <div class="relative flex flex-col lg:flex-row items-center">
                    <!-- Content Left (Desktop) / Center (Mobile) -->
                    <div class="w-full lg:w-5/12 lg:pr-8">
                        <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-lg border border-gray-100 lg:text-right text-center">
                            <div class="inline-block bg-gradient-to-r from-green-600 to-emerald-600 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                1999
                            </div>
                            <h3 class="text-xl lg:text-2xl font-heading font-bold text-gray-900 mb-3">Krisis keuangan</h3>
                            <p class="text-gray-600 leading-relaxed mb-4 text-sm lg:text-base">
                                Akibat krisis tahun 1998, membuat harus berpindah lokasi kembali di jalan Buduran
                            </p>
                        </div>
                    </div>
                    
                    <!-- Timeline Dot -->
                    <div class="hidden lg:flex w-2/12 justify-center my-4 lg:my-0">
                        <div class="w-16 h-16 bg-white border-4 border-green-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Empty Space Right -->
                    <div class="hidden lg:block w-5/12"></div>
                </div>

                <!-- 2005 - Innovation -->
                <div class="relative flex flex-col lg:flex-row items-center">
                    <!-- Empty Space Left -->
                    <div class="hidden lg:block w-5/12"></div>
                    
                    <!-- Timeline Dot -->
                    <div class="hidden lg:flex w-2/12 justify-center my-4 lg:my-0">
                        <div class="w-16 h-16 bg-white border-4 border-orange-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Content Right (Desktop) / Center (Mobile) -->
                    <div class="w-full lg:w-5/12 lg:pl-8">
                        <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-lg border border-gray-100 text-center lg:text-left">
                            <div class="inline-block bg-gradient-to-r from-orange-600 to-red-600 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                2005
                            </div>
                            <h3 class="text-xl lg:text-2xl font-heading font-bold text-gray-900 mb-3">Perpindahan kantor terakhir</h3>
                            <p class="text-gray-600 leading-relaxed mb-4 text-sm lg:text-base">
                                Memutuskan untuk memiliki tempat usaha sendiri, tidak lagi menyewa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Nilai-Nilai Kami</span>
            <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2 mb-6">
                Prinsip Yang Kami Pegang
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Setiap desain yang kami ciptakan didasarkan pada nilai-nilai fundamental yang telah memandu perjalanan kami selama bertahun-tahun.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Kualitas Premium</h3>
                <p class="text-gray-600">Setiap detail dikerjakan dengan standar operasional yang ketat serta material berkualitas tinggi.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-20 h-20 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Kepuasan Klien</h3>
                <p class="text-gray-600">Prioritas utama kami adalah memastikan setiap klien mendapatkan hasil yang melebihi ekspektasi.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-20 h-20 bg-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Inovasi Berkelanjutan</h3>
                <p class="text-gray-600">Selalu mengikuti tren global dan menghadirkan inovasi terbaru dalam setiap project.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-20 h-20 bg-yellow-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">Ketepatan Waktu</h3>
                <p class="text-gray-600">Komitmen kuat untuk menyelesaikan setiap project sesuai timeline yang disepakati.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-6">
                Jadilah Bagian dari Sejarah Kami
            </h2>
            <p class="text-xl text-purple-100 mb-10">
                Mari bergabung dengan ratusan klien yang telah mempercayakan ruang impian mereka kepada kami. Saatnya mewujudkan visi desain anda bersama Filia Interior.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="group bg-white text-purple-900 px-8 py-4 rounded-2xl font-semibold hover:bg-opacity-90 transition-all duration-300 transform hover:scale-105 shadow-2xl inline-flex items-center justify-center">
                    <svg class="mr-2 h-5 w-5 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Konsultasi Sekarang
                </a>
                
                <a href="{{ route('portfolio') }}" class="group glass-bg text-white px-8 py-4 rounded-2xl font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center">
                    <svg class="mr-2 h-5 w-5 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Lihat Karya Kami
                </a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced scroll animations for timeline and sections
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeInUp');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Timeline items animation
    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateX(0)';
                
                // Add pulse effect to timeline dots
                const dot = entry.target.querySelector('.timeline-dot');
                if (dot) {
                    dot.style.animation = 'pulse 2s infinite';
                }
            }
        });
    }, {
        threshold: 0.3
    });

    // Values cards staggered animation
    const valuesObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const cards = entry.target.querySelectorAll('.value-card');
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0) scale(1)';
                    }, index * 200);
                });
            }
        });
    }, {
        threshold: 0.2
    });

    // Initialize animations
    const animatedElements = document.querySelectorAll('h1, h2, h3, p, .timeline-item, .achievement-card');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        observer.observe(el);
    });

    // Timeline specific animations
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = index % 2 === 0 ? 'translateX(-50px)' : 'translateX(50px)';
        item.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        timelineObserver.observe(item);
    });

    // Values section
    const valuesSection = document.querySelector('.values-section');
    if (valuesSection) {
        const valueCards = valuesSection.querySelectorAll('.value-card');
        valueCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px) scale(0.9)';
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        valuesObserver.observe(valuesSection);
    }

    // Parallax effect for floating elements
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const floatingElements = document.querySelectorAll('.animate-blob');
        
        floatingElements.forEach((element, index) => {
            const speed = 0.3 + (index * 0.1);
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Enhanced hover effects
    const hoverElements = document.querySelectorAll('.timeline-item, .achievement-card, .value-card');
    hoverElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = this.style.transform + ' scale(1.02)';
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });

        element.addEventListener('mouseleave', function() {
            this.style.transform = this.style.transform.replace(' scale(1.02)', '');
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });
});
</script>
@endsection