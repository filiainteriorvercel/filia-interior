@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 70% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 right-20 w-64 h-64 bg-white bg-opacity-10 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
    <div class="absolute bottom-20 left-20 w-64 h-64 bg-blue-300 bg-opacity-20 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-6">
            <span class="inline-flex items-center glass-bg rounded-full px-6 py-3 text-white text-sm font-medium border border-white border-opacity-20">
                <svg class="w-4 h-4 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Kunjungi Kami
            </span>
        </div>
        
        <h1 class="text-5xl md:text-6xl font-heading font-bold mb-6 text-white leading-tight">
            Lokasi
            <span class="block bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">
                Showroom Premium
            </span>
        </h1>
        
        <p class="text-xl text-purple-100 max-w-4xl mx-auto leading-relaxed">
            Kunjungi showroom luxury kami dan rasakan langsung kualitas material premium serta konsep desain terdepan. Tim expert kami siap memberikan konsultasi personal untuk mewujudkan desain interior impian Anda.
        </p>
    </div>
</section>

<!-- Main Location Section -->
<section class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Contact Information -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-2xl p-8 lg:p-10 border border-gray-100">
                    <h2 class="text-3xl font-heading font-bold text-gray-900 mb-8 flex items-center">
                        <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Filia Interior Design Studio
                    </h2>
                    
                    <!-- Address Card -->
                    <div class="glass-bg rounded-xl p-6 mb-8 border border-white border-opacity-20">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat Showroom</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Jl. Filia Interior No. 66<br>
                                    Surabaya, Jawa Timur 60226<br>
                                    Indonesia
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Phone -->
                        <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors duration-300 group">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Telepon</p>
                                <p class="text-gray-900 font-semibold">+62 123 456 7890</p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-xl hover:bg-green-100 transition-colors duration-300 group">
                            <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">WhatsApp</p>
                                <p class="text-gray-900 font-semibold">+62 812 3456 7890</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center space-x-3 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition-colors duration-300 group">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Email</p>
                                <p class="text-gray-900 font-semibold">filiainterior@gmail.com</p>
                            </div>
                        </div>

                        <!-- Website -->
                        <div class="flex items-center space-x-3 p-4 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors duration-300 group">
                            <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Website</p>
                                <p class="text-gray-900 font-semibold">www.filiainterior.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Operating Hours -->
                    <div class="glass-bg rounded-xl p-6 border border-purple-200 border-opacity-20">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 text-purple-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Jam Operasional
                        </h3>
                        <div class="space-y-3 text-gray-700">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200 border-opacity-50">
                                <span class="font-medium">Senin - Jumat</span>
                                <span class="text-purple-600 font-semibold">08:00 - 17:00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200 border-opacity-50">
                                <span class="font-medium">Sabtu</span>
                                <span class="text-purple-600 font-semibold">08:00 - 12:00</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="font-medium">Minggu</span>
                                <span class="text-orange-600 font-semibold">Closed</span>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                            <p class="text-sm text-yellow-800">
                                <span class="font-medium">Note:</span> Konsultasi di luar jam operasional dapat dijadwalkan terlebih dahulu melalui WhatsApp.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <!-- Map Section -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                    <div class="p-6 pb-0">
                        <h3 class="text-2xl font-heading font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Interactive Map
                        </h3>
                    </div> --}}
                    
                    {{-- <!-- Map Container -->
                    <div class="relative">
                        <div class="aspect-video bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-purple-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p class="text-purple-600 font-semibold text-lg">Google Maps Integration</p>
                                <p class="text-purple-400 text-sm">Surabaya, Jawa Timur</p>
                            </div>
                        </div>
                        <!-- Google Maps would be embedded here -->
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                    </div> --}}
{{--                     
                    <div class="p-6 pt-4">
                        <a href="https://goo.gl/maps/xyz123" 
                           target="_blank" 
                           class="w-full gradient-bg text-white py-3 px-6 rounded-xl font-semibold hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Buka di Google Maps
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <!-- Visit Showroom Features -->
<section class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Luxury Experience</span>
            <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 mt-2 mb-6">
                Apa yang Bisa Anda Lihat di Showroom
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Nikmati pengalaman luxury shopping dengan koleksi material premium dan konsep ruang yang menginspirasi
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Material Premium -->
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Material Premium</h3>
                <p class="text-gray-600 text-sm">Koleksi lengkap marble, granite, kayu solid, dan material import terbaik</p>
            </div>
            
            <!-- Furniture Display -->
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Furniture Display</h3>
                <p class="text-gray-600 text-sm">Furniture custom dan branded dari designer ternama dunia</p>
            </div>
            
            <!-- Room Concepts -->
            <div class="text-center">
                <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21l4-4 4 4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Room Concepts</h3>
                <p class="text-gray-600 text-sm">Living room, bedroom, kitchen set ups dalam berbagai tema luxury</p>
            </div>
            
            <!-- VR Experience -->
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">VR Experience</h3>
                <p class="text-gray-600 text-sm">Virtual reality untuk preview 3D design sebelum eksekusi</p>
            </div>
        </div>
    </div>
</section> --}}

<!-- Contact CTA Section -->
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-6">
                Siap untuk Kunjungan VIP?
            </h2>
            <p class="text-xl text-purple-100 mb-10 leading-relaxed">
                Jadwalkan private consultation dengan tim expert kami.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('contact') }}" class="group glass-bg text-white px-10 py-4 rounded-2xl font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center shadow-2xl">
                    <svg class="mr-3 h-5 w-5 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8m-8 0v1a3 3 0 006 3h0a3 3 0 006-3V8a3 3 0 00-3-3h-5m-8 3v9a4 4 0 008 0V8"/>
                    </svg>
                    Jadwalkan Konsultasi
                </a>
                
                <a href="https://wa.me/6281234567890" class="group bg-green-500 text-white px-10 py-4 rounded-2xl font-semibold hover:bg-green-600 transition-all duration-300 transform hover:scale-105 shadow-2xl inline-flex items-center justify-center">
                    <svg class="mr-3 h-5 w-5 group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                    </svg>
                    WhatsApp Sekarang
                </a>
            </div>
            
            <div class="mt-8 flex items-center justify-center space-x-8 text-purple-100">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-sm">Konsultasi Gratis</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-sm">Fast Response</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-sm">Harga Kompetitif</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection