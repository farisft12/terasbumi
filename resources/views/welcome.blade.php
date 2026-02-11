<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teras Bumi Tour - Solusi Perjalanan yang Terencana dan Terpercaya</title>
    <meta name="description" content="Teras Bumi Tour - Travel agent profesional yang melayani perjalanan wisata, keluarga, grup, dan dinas dengan layanan terorganisir dan terpercaya.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Custom colors based on logo - Natural earthy tones */
        .earth-orange { color: #E07A5F; }
        .earth-tan { color: #D4A574; }
        .earth-olive { color: #8B956D; }
        .earth-green { color: #5D7A5D; }
        .earth-brown { color: #6B5B4F; }
        .earth-dark { color: #4A3F35; }
        
        .bg-earth-orange { background-color: #E07A5F; }
        .bg-earth-tan { background-color: #D4A574; }
        .bg-earth-olive { background-color: #8B956D; }
        .bg-earth-green { background-color: #5D7A5D; }
        .bg-earth-brown { background-color: #6B5B4F; }
        .bg-earth-dark { background-color: #4A3F35; }
    </style>
</head>
<body class="bg-cream text-earth-brown-dark antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-cream-dark shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <a href="/" class="flex items-center space-x-3">
                    <img src="{{ asset('img/b1g.png') }}" alt="Teras Bumi Tour" class="h-20 lg:h-24 w-auto object-contain">
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#about" class="text-earth-brown hover:text-earth-green transition-colors text-sm font-medium">Tentang Kami</a>
                    <a href="#services" class="text-earth-brown hover:text-earth-green transition-colors text-sm font-medium">Layanan</a>
                    <a href="#contact" class="text-earth-brown hover:text-earth-green transition-colors text-sm font-medium">Hubungi Kami</a>
                  
                </div>
                <button id="mobile-menu-button" class="md:hidden p-2 text-earth-brown hover:text-earth-green">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-cream-dark">
            <div class="px-4 py-3 space-y-2">
                <a href="#about" class="block py-2 text-earth-brown hover:text-earth-green font-medium">Tentang Kami</a>
                <a href="#services" class="block py-2 text-earth-brown hover:text-earth-green font-medium">Layanan</a>
                <a href="#contact" class="block py-2 text-earth-brown hover:text-earth-green font-medium">Hubungi Kami</a>
                
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative flex items-center justify-center pt-24 pb-12 overflow-hidden">
        <!-- Colorful Background Gradient -->
        <div class="absolute inset-0 bg-linear-to-br from-earth-orange/20 via-earth-green/15 via-earth-olive/20 to-earth-tan/25"></div>
        <div class="absolute inset-0 bg-linear-to-t from-cream/80 via-warm-white/60 to-transparent"></div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-earth-orange/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-earth-green/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-earth-olive/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Logo Display -->
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('img/b1g.png') }}" alt="Teras Bumi Tour" class="h-64 sm:h-72 lg:h-80 w-auto object-contain drop-shadow-2xl">
                </div>

                <!-- Tagline -->
                <p class="text-xl sm:text-2xl lg:text-3xl text-earth-green font-bold mb-2 drop-shadow-sm">
                    Solusi Perjalanan yang Terencana dan Terpercaya
                </p>

                <!-- Description -->
                <p class="text-lg sm:text-xl text-earth-brown leading-relaxed mb-8 max-w-3xl mx-auto font-medium">
                    Travel agent profesional yang melayani berbagai kebutuhan perjalanan dengan sistem yang rapi, terorganisir, dan terpercaya. Dari perencanaan hingga pelaksanaan, kami memastikan setiap detail perjalanan Anda tertata dengan baik.
                </p>

                <!-- CTA Button -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#contact" class="inline-flex items-center px-8 py-4 bg-earth-green hover:bg-earth-olive text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                    <a href="#services" class="inline-flex items-center px-8 py-4 border-2 border-earth-orange text-earth-orange hover:bg-earth-orange hover:text-white font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        Lihat Layanan
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <span class="inline-block px-4 py-1 bg-earth-olive/20 text-earth-green text-sm font-semibold rounded-full mb-4">
                        Tentang Kami
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-earth-dark mb-6">
                        Travel Agent Profesional
                    </h2>
                </div>
                
                <div class="prose prose-lg max-w-none text-earth-brown">
                    <p class="text-lg leading-relaxed mb-6">
                        Teras Bumi Tour adalah travel agent yang berdedikasi untuk memberikan solusi perjalanan lengkap dan terorganisir. Dengan pengalaman dan jaringan luas, kami siap melayani berbagai kebutuhan perjalanan Anda.
                    </p>
                    <p class="text-lg leading-relaxed mb-6">
                        Kami memahami bahwa setiap perjalanan memiliki tujuan dan kebutuhan yang berbeda. Oleh karena itu, kami menawarkan layanan yang disesuaikan dengan kebutuhan individual, keluarga, grup, maupun korporat.
                    </p>
                    <p class="text-lg leading-relaxed font-semibold text-earth-green">
                        Komitmen kami adalah memberikan pelayanan yang rapi, sistematis, dan profesional dari tahap perencanaan hingga perjalanan selesai.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 lg:py-24 bg-linear-to-b from-cream via-warm-white to-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
                <!-- Stat 1 - Pelanggan Puas -->
                <div class="bg-linear-to-br from-earth-orange/10 to-earth-orange/5 rounded-2xl p-6 lg:p-8 text-center border border-earth-orange/20 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-earth-orange/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-earth-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="text-4xl sm:text-5xl lg:text-6xl font-bold text-earth-orange mb-2">500+</div>
                    <div class="text-sm sm:text-base text-earth-brown font-semibold">Pelanggan Puas</div>
                </div>

                <!-- Stat 2 - Destinasi -->
                <div class="bg-linear-to-br from-earth-green/10 to-earth-green/5 rounded-2xl p-6 lg:p-8 text-center border border-earth-green/20 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-earth-green/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-earth-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-4xl sm:text-5xl lg:text-6xl font-bold text-earth-green mb-2">50+</div>
                    <div class="text-sm sm:text-base text-earth-brown font-semibold">Destinasi</div>
                </div>

                <!-- Stat 3 - Layanan Utama -->
                <div class="bg-linear-to-br from-earth-olive/10 to-earth-olive/5 rounded-2xl p-6 lg:p-8 text-center border border-earth-olive/20 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-earth-olive/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-earth-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <div class="text-4xl sm:text-5xl lg:text-6xl font-bold text-earth-olive mb-2">4</div>
                    <div class="text-sm sm:text-base text-earth-brown font-semibold">Layanan Utama</div>
                </div>

                <!-- Stat 4 - Dukungan -->
                <div class="bg-linear-to-br from-earth-tan/10 to-earth-tan/5 rounded-2xl p-6 lg:p-8 text-center border border-earth-tan/20 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-earth-tan/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-earth-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-4xl sm:text-5xl lg:text-6xl font-bold text-earth-orange mb-2">24/7</div>
                    <div class="text-sm sm:text-base text-earth-brown font-semibold">Dukungan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 lg:py-10 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1 bg-earth-orange/20 text-earth-orange text-sm font-semibold rounded-full mb-4">
                    Layanan Kami
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-earth-dark mb-4">
                    Jenis Perjalanan yang Kami Layani
                </h2>
                <p class="text-lg text-earth-brown max-w-2xl mx-auto">
                    Berbagai pilihan layanan perjalanan yang dapat disesuaikan dengan kebutuhan Anda
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Service Card 1 -->
                <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition-all duration-300 border border-cream-dark">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-earth-orange/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-earth-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-earth-dark mb-2">Perjalanan Wisata</h3>
                            <p class="text-earth-brown leading-relaxed">
                                Paket wisata lengkap ke berbagai destinasi menarik. Kami mengatur itinerary, akomodasi, transportasi, dan panduan profesional untuk pengalaman berwisata yang nyaman.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition-all duration-300 border border-cream-dark">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-earth-green/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-earth-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-earth-dark mb-2">Perjalanan Keluarga</h3>
                            <p class="text-earth-brown leading-relaxed">
                                Solusi perjalanan khusus untuk keluarga dengan berbagai kebutuhan khusus. Kami memastikan kenyamanan dan keamanan untuk setiap anggota keluarga.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition-all duration-300 border border-cream-dark">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-earth-olive/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-earth-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-earth-dark mb-2">Perjalanan Grup</h3>
                            <p class="text-earth-brown leading-relaxed">
                                Layanan khusus untuk grup besar seperti komunitas, sekolah, atau perusahaan. Kami mengelola logistik grup dengan sistematis dan terorganisir.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Service Card 4 -->
                <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition-all duration-300 border border-cream-dark">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-earth-tan/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-earth-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-earth-dark mb-2">Perjalanan Dinas</h3>
                            <p class="text-earth-brown leading-relaxed">
                                Layanan perjalanan bisnis dan dinas dengan pendekatan profesional. Kami memahami pentingnya ketepatan waktu dan kenyamanan dalam perjalanan kerja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-10 lg:py-10 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1 bg-earth-green/20 text-earth-green text-sm font-semibold rounded-full mb-4">
                    Hubungi Kami
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-earth-dark mb-4">
                    Siap Melayani Perjalanan Anda
                </h2>
                <p class="text-lg text-earth-brown leading-relaxed">
                    Konsultasikan kebutuhan perjalanan Anda dengan tim kami. Kami siap membantu merencanakan perjalanan yang sesuai dengan kebutuhan dan anggaran Anda.
                </p>
            
    </section>

    <!-- Footer -->
    <footer class="bg-earth-brown py-8 text-center text-sm text-white/70">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} Teras Bumi Tour. All rights reserved.</p>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

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
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>