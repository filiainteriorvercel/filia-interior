<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' : '' }}Filia Interior Design</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        .font-heading { font-family: 'Playfair Display', serif; }
        .font-body { font-family: 'Inter', sans-serif; }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-scale:hover {
            /* transform removed to prevent layout shift */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        
        .mobile-menu.active {
            max-height: 500px;
        }

        /* Enhanced Navigation Animations */
        @keyframes navSlideDown {
            from { 
                transform: translateY(-100%); 
                opacity: 0; 
            }
            to { 
                transform: translateY(0); 
                opacity: 1; 
            }
        }

        @keyframes navItemSlide {
            from { 
                transform: translateX(-20px); 
                opacity: 0; 
            }
            to { 
                transform: translateX(0); 
                opacity: 1; 
            }
        }

        .nav-animate {
            animation: navSlideDown 0.8s ease-out both;
        }

        .nav-item {
            animation: navItemSlide 0.6s ease-out both;
        }

        .nav-item:nth-child(1) { animation-delay: 0.1s; }
        .nav-item:nth-child(2) { animation-delay: 0.2s; }
        .nav-item:nth-child(3) { animation-delay: 0.3s; }
        .nav-item:nth-child(4) { animation-delay: 0.4s; }
        .nav-item:nth-child(5) { animation-delay: 0.5s; }

        .nav-logo {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: navItemSlide 0.6s ease-out both;
        }

        .nav-logo:hover {
            /* transform removed to prevent navigation shift */
            filter: drop-shadow(0 10px 20px rgba(139, 92, 246, 0.3));
        }

        .nav-link {
            /* Simplified - no position relative to prevent pseudo-element issues */
            transition: color 0.2s ease;
        }

        /* Underline animation removed to fix flickering bug */
        /* Using simple color change instead */

        .nav-link:hover {
            color: #8b5cf6;
        }

        .nav-btn {
            /* Simplified - removed pseudo-element shimmer effect to prevent issues */
            transition: box-shadow 0.3s ease, opacity 0.3s ease;
            display: inline-block;
        }

        .nav-btn:hover {
            box-shadow: 0 8px 16px rgba(139, 92, 246, 0.4);
            opacity: 0.9;
        }

        /* Mobile Menu Enhancements */
        .mobile-menu-item {
            transform: translateX(-20px);
            opacity: 0;
            transition: all 0.4s ease;
        }

        .mobile-menu.active .mobile-menu-item {
            transform: translateX(0);
            opacity: 1;
        }

        .mobile-menu-item:nth-child(1) { transition-delay: 0.1s; }
        .mobile-menu-item:nth-child(2) { transition-delay: 0.2s; }
        .mobile-menu-item:nth-child(3) { transition-delay: 0.3s; }
        .mobile-menu-item:nth-child(4) { transition-delay: 0.4s; }
        .mobile-menu-item:nth-child(5) { transition-delay: 0.5s; }
        .mobile-menu-item:nth-child(6) { transition-delay: 0.6s; }

        .mobile-menu-button {
            transition: all 0.3s ease;
        }

        .mobile-menu-button:hover {
            /* transform removed to prevent button jumping */
            background: rgba(139, 92, 246, 0.1);
        }

        /* Footer Animations */
        @keyframes footerSlideUp {
            from { 
                transform: translateY(50px); 
                opacity: 0; 
            }
            to { 
                transform: translateY(0); 
                opacity: 1; 
            }
        }

        @keyframes footerItemFloat {
            from { 
                transform: translateY(30px); 
                opacity: 0; 
            }
            to { 
                transform: translateY(0); 
                opacity: 1; 
            }
        }

        .footer-animate {
            animation: footerSlideUp 1s ease-out both;
        }

        .footer-section {
            animation: footerItemFloat 0.8s ease-out both;
        }

        .footer-section:nth-child(1) { animation-delay: 0.1s; }
        .footer-section:nth-child(2) { animation-delay: 0.3s; }
        .footer-section:nth-child(3) { animation-delay: 0.5s; }
        .footer-section:nth-child(4) { animation-delay: 0.7s; }

        .footer-social {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .footer-social:hover {
            transform: translateY(-5px) scale(1.15) rotate(5deg);
            background: linear-gradient(45deg, #8b5cf6, #06b6d4);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.4);
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

        .footer-icon {
            transition: all 0.3s ease;
        }

        .footer-link:hover .footer-icon {
            color: #8b5cf6;
            transform: scale(1.2);
        }

        /* Enhanced Scroll Effects */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #8b5cf6, #06b6d4);
            z-index: 1000;
            transition: width 0.1s ease;
        }

        /* Smooth Loading */
        .page-transition {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .page-transition.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* Button Ripple Effect */
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .ripple-effect {
            position: relative;
            overflow: hidden;
        }

        .ripple-effect::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        /* Enhanced Ripple Effect */
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Enhanced Page Transition */
        .page-transition {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .page-transition.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* Enhanced Link Transitions */
        .nav-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Button Styles */
        .nav-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        /* Footer Social Enhanced */
        .footer-social {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Responsive */
        @media (max-width: 768px) {
            .nav-btn:hover {
                transform: none;
                box-shadow: none;
            }
            
            .footer-social:hover {
                transform: scale(1.1) !important;
            }
        }
    </style>
</head>
<body class="font-body antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="glass-effect fixed w-full top-0 z-50 border-b border-gray-100 nav-animate">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="nav-logo flex items-center group">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="Company Logo" class="h-20 w-auto transition-opacity duration-300 group-hover:opacity-90">
                        </a>
                    </div>
                    
                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-3">
                        <a href="{{ route('home') }}" class="nav-link nav-item text-gray-700 hover:text-purple-600 px-4 py-2 text-sm font-medium rounded-lg hover:bg-purple-50 transition-colors duration-200 {{ request()->routeIs('home') ? 'text-purple-600 bg-purple-50' : '' }}">Home</a>
                        <a href="{{ route('history') }}" class="nav-link nav-item text-gray-700 hover:text-purple-600 px-4 py-2 text-sm font-medium rounded-lg hover:bg-purple-50 transition-colors duration-200 {{ request()->routeIs('history') ? 'text-purple-600 bg-purple-50' : '' }}">History</a>
                        <a href="{{ route('portfolio') }}" class="nav-link nav-item text-gray-700 hover:text-purple-600 px-4 py-2 text-sm font-medium rounded-lg hover:bg-purple-50 transition-colors duration-200 {{ request()->routeIs('portfolio') ? 'text-purple-600 bg-purple-50' : '' }}">Portfolio</a>
                        <a href="{{ route('location') }}" class="nav-link nav-item text-gray-700 hover:text-purple-600 px-4 py-2 text-sm font-medium rounded-lg hover:bg-purple-50 transition-colors duration-200 {{ request()->routeIs('location') ? 'text-purple-600 bg-purple-50' : '' }}">Location</a>
                        <a href="{{ route('contact') }}" class="nav-link nav-item text-gray-700 hover:text-purple-600 px-4 py-2 mr-2 text-sm font-medium rounded-lg hover:bg-purple-50 transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-purple-600 bg-purple-50' : '' }}">Contact</a>
                        
                        @auth
                            <div class="ml-8 pl-8 border-l-2 border-gray-300">
                                <a href="{{ route('dashboard') }}" class="nav-btn gradient-bg text-white px-6 py-2.5 rounded-xl font-medium block">Dashboard</a>
                            </div>
                        @else
                            <div class="ml-8 pl-8 border-l-2 border-gray-300">
                                <a href="{{ route('login') }}" class="nav-btn gradient-bg text-white px-6 py-2.5 rounded-xl font-medium block">Login</a>
                            </div>
                        @endauth
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="lg:hidden flex items-center">
                        <button type="button" class="mobile-menu-button text-gray-600 hover:text-purple-600 hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-purple-500 p-3 rounded-xl transition duration-300">
                            <svg class="hamburger-icon h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="close-icon h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Modern Mobile Menu -->
            <div class="mobile-menu lg:hidden glass-effect border-t border-gray-100">
                <div class="px-4 py-6 space-y-2">
                    <a href="{{ route('home') }}" class="mobile-menu-item text-gray-700 hover:text-purple-600 hover:bg-purple-50 flex items-center px-4 py-3 text-base font-medium rounded-xl transition duration-300 {{ request()->routeIs('home') ? 'text-purple-600 bg-purple-50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('history') }}" class="mobile-menu-item text-gray-700 hover:text-purple-600 hover:bg-purple-50 flex items-center px-4 py-3 text-base font-medium rounded-xl transition duration-300 {{ request()->routeIs('history') ? 'text-purple-600 bg-purple-50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        History
                    </a>
                    <a href="{{ route('portfolio') }}" class="mobile-menu-item text-gray-700 hover:text-purple-600 hover:bg-purple-50 flex items-center px-4 py-3 text-base font-medium rounded-xl transition duration-300 {{ request()->routeIs('portfolio') ? 'text-purple-600 bg-purple-50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Portfolio
                    </a>
                    <a href="{{ route('location') }}" class="mobile-menu-item text-gray-700 hover:text-purple-600 hover:bg-purple-50 flex items-center px-4 py-3 text-base font-medium rounded-xl transition duration-300 {{ request()->routeIs('location') ? 'text-purple-600 bg-purple-50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Location
                    </a>
                    <a href="{{ route('contact') }}" class="mobile-menu-item text-gray-700 hover:text-purple-600 hover:bg-purple-50 flex items-center px-4 py-3 text-base font-medium rounded-xl transition duration-300 {{ request()->routeIs('contact') ? 'text-purple-600 bg-purple-50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Contact
                    </a>
                    
                    <div class="pt-4 mt-4 border-t border-gray-200">
                        @auth
                            <a href="{{ route('dashboard') }}" class="mobile-menu-item gradient-bg text-white flex items-center px-4 py-3 text-base font-medium rounded-xl hover:shadow-lg transition duration-300">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="mobile-menu-item gradient-bg text-white flex items-center px-4 py-3 text-base font-medium rounded-xl hover:shadow-lg transition duration-300">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <main class="pt-20">
            @yield('content')
        </main>

        <!-- Modern Footer with Animations -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-heading font-bold">Filia Interior</h3>
                                <p class="text-sm text-gray-400">Design Studio</p>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-6 leading-relaxed">
                            Perusahaan desain interior terpercaya dengan pengalaman bertahun-tahun dalam menciptakan ruang yang indah, fungsional, dan mencerminkan kepribadian Anda.
                        </p>
                        {{-- <div class="flex space-x-4">
                            <a href="#" class="footer-social w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-purple-600 transition duration-300">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="footer-social w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-purple-600 transition duration-300">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="footer-social w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-purple-600 transition duration-300">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.294 1.198-.335 1.365-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                            <a href="#" class="footer-social w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-purple-600 transition duration-300">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.03 0C5.378 0 0 5.378 0 12.03s5.378 12.03 12.03 12.03 12.03-5.378 12.03-12.03S18.682 0 12.03 0zm5.99 8.428c0 .114-.009.226-.027.335-.465 2.896-2.411 5.044-5.229 5.771-.814.21-1.667.31-2.734.31-.466 0-.914-.025-1.342-.073a5.963 5.963 0 01-1.925-.547 7.432 7.432 0 01-1.763-1.133L5.99 12.88c-.014-.012-.028-.024-.04-.037L5.934 12.831a5.963 5.963 0 01-.547-1.925 7.432 7.432 0 01-.073-1.342c0-1.067.1-1.92.31-2.734.727-2.818 2.875-4.764 5.771-5.229.109-.018.221-.027.335-.027h.062c.114 0 .226.009.335.027 2.896.465 5.044 2.411 5.771 5.229.21.814.31 1.667.31 2.734 0 .466-.025.914-.073 1.342z"/>
                                </svg>
                            </a>
                        </div> --}}
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Quick Links</h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('home') }}" class="footer-link text-gray-300 hover:text-purple-400 transition duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Home
                            </a></li>
                            <li><a href="{{ route('history') }}" class="footer-link text-gray-300 hover:text-purple-400 transition duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                History
                            </a></li>
                            <li><a href="{{ route('portfolio') }}" class="footer-link text-gray-300 hover:text-purple-400 transition duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Portfolio
                            </a></li>
                                                        <li><a href="{{ route('location') }}" class="footer-link text-gray-300 hover:text-purple-400 transition duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Location
                            </a></li>
                            <li><a href="{{ route('contact') }}" class="footer-link text-gray-300 hover:text-purple-400 transition duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Contact
                            </a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Services</h4>
                        <ul class="space-y-3 text-gray-300">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Residential Design
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Commercial Space
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                3D Visualization
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Project Management
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Contact Info</h4>
                        <ul class="space-y-3 text-gray-300">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="font-medium">Email</p>
                                    <p class="text-sm">filiainterior@gmail.com</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <div>
                                    <p class="font-medium">Phone</p>
                                    <p class="text-sm">+62 123 456 7890</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="font-medium">Location</p>
                                    <p class="text-sm">Surabaya, Indonesia</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-700">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Filia Interior Design Studio. All rights reserved.</p>
                        {{-- <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-gray-400 hover:text-purple-400 text-sm transition duration-300">Privacy Policy</a>
                            <a href="#" class="text-gray-400 hover:text-purple-400 text-sm transition duration-300">Terms of Service</a>
                            <a href="#" class="text-gray-400 hover:text-purple-400 text-sm transition duration-300">Cookie Policy</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Enhanced Modern Mobile menu toggle with animations
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎨 Loading enhanced public layout animations...');

            // Create scroll progress bar
            const scrollProgress = document.createElement('div');
            scrollProgress.className = 'scroll-progress';
            document.body.appendChild(scrollProgress);

            // Update scroll progress
            window.addEventListener('scroll', () => {
                const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
                scrollProgress.style.width = scrolled + '%';
            });

            // Enhanced Mobile Menu
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            const hamburgerIcon = document.querySelector('.hamburger-icon');
            const closeIcon = document.querySelector('.close-icon');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    const isActive = mobileMenu.classList.contains('active');
                    
                    if (isActive) {
                        mobileMenu.classList.remove('active');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    } else {
                        mobileMenu.classList.add('active');
                        hamburgerIcon.classList.add('hidden');
                        closeIcon.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                });

                // Close mobile menu when clicking on links
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    });
                });
            }

            // Enhanced Footer Animations
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

            // Navigation links now use pure CSS hover effects
            // Removed JavaScript hover to prevent flickering issues

            // Enhanced Button Effects
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Create ripple effect
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

            // Page Load Animation
            document.body.classList.add('page-transition');
            setTimeout(() => {
                document.body.classList.add('loaded');
            }, 100);

            // Enhanced Footer Social Media Hover
            document.querySelectorAll('.footer-social').forEach(social => {
                social.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.15) rotate(5deg)';
                });
                
                social.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1) rotate(0deg)';
                });
            });

            console.log('✨ Enhanced public layout animations loaded successfully!');
        });

        // Smooth scrolling for anchor links
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
    </script>
</body>
</html>
