<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Admin') - Teras Bumi Tour</title>
    <meta name="description" content="Dashboard Admin Teras Bumi Tour">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-earth-brown-dark antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-cream-dark flex-shrink-0 hidden md:flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-cream-dark">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-earth-brown rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">TB</span>
                    </div>
                    <div>
                        <span class="font-semibold text-earth-brown-dark block text-sm">Teras Bumi Tour</span>
                        <span class="text-xs text-earth-brown">Sistem Internal</span>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="{{ route('admin.paket-tour') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.paket-tour') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium text-sm">Paket Tour</span>
                </a>

                <a href="{{ route('admin.pesanan') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.pesanan') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    <span class="font-medium text-sm">Pesanan</span>
                </a>

                <a href="{{ route('admin.laporan') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.laporan') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium text-sm">Laporan</span>
                </a>

                <div class="pt-4 mt-4 border-t border-cream-dark">
                    <p class="px-4 py-2 text-xs font-semibold text-earth-brown uppercase tracking-wider">Pengaturan</p>
                </div>

                <a href="{{ route('admin.database.download') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-earth-brown hover:bg-cream transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span class="font-medium text-sm">Download Database</span>
                </a>

                <a href="{{ route('admin.settings.edit-welcome') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.settings.edit-welcome') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span class="font-medium text-sm">Edit Welcome Page</span>
                </a>

                <a href="{{ route('admin.settings.edit-logo') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.settings.edit-logo') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-medium text-sm">Edit Logo</span>
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-cream-dark">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-earth-brown hover:bg-red-50 hover:text-red-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-medium text-sm">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Mobile Header -->
            <header class="md:hidden bg-white border-b border-cream-dark p-4 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-earth-brown rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">TB</span>
                    </div>
                    <span class="font-semibold text-earth-brown-dark text-sm">Admin</span>
                </a>
                <button id="mobile-menu-toggle" class="p-2 text-earth-brown hover:text-natural-green">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </header>

            <!-- Mobile Menu Overlay -->
            <div id="mobile-menu" class="md:hidden fixed inset-0 z-50 hidden">
                <div class="absolute inset-0 bg-black/50" id="mobile-menu-backdrop"></div>
                <div class="absolute right-0 top-0 bottom-0 w-64 bg-white shadow-xl">
                    <div class="p-4 border-b border-cream-dark flex items-center justify-between">
                        <span class="font-semibold text-earth-brown-dark">Menu</span>
                        <button id="mobile-menu-close" class="p-2 text-earth-brown hover:text-natural-green">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <nav class="p-4 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }}">
                            <span class="font-medium text-sm">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.paket-tour') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.paket-tour') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }}">
                            <span class="font-medium text-sm">Paket Tour</span>
                        </a>
                        <a href="{{ route('admin.pesanan') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.pesanan') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }}">
                            <span class="font-medium text-sm">Pesanan</span>
                        </a>
                        <a href="{{ route('admin.laporan') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.laporan') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }}">
                            <span class="font-medium text-sm">Laporan</span>
                        </a>
                        <div class="pt-4 mt-4 border-t border-cream-dark">
                            <p class="px-4 py-2 text-xs font-semibold text-earth-brown uppercase tracking-wider">Pengaturan</p>
                        </div>
                        <a href="{{ route('admin.database.download') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-earth-brown hover:bg-cream">
                            <span class="font-medium text-sm">Download Database</span>
                        </a>
                        <a href="{{ route('admin.settings.edit-welcome') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.settings.edit-welcome') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }}">
                            <span class="font-medium text-sm">Edit Welcome Page</span>
                        </a>
                        <a href="{{ route('admin.settings.edit-logo') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.settings.edit-logo') ? 'bg-earth-brown text-white' : 'text-earth-brown hover:bg-cream' }}">
                            <span class="font-medium text-sm">Edit Logo</span>
                        </a>
                    </nav>
                    <div class="p-4 border-t border-cream-dark">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 font-medium text-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Desktop Header -->
            <header class="hidden md:flex bg-white border-b border-cream-dark px-8 py-4 items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-earth-brown-dark">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-sm text-earth-brown">{{ now()->format('l, d F Y') }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-earth-brown-dark">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-earth-brown">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-earth-brown rounded-full flex items-center justify-center text-white font-semibold">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');

        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = '';
        }

        mobileMenuToggle?.addEventListener('click', openMobileMenu);
        mobileMenuClose?.addEventListener('click', closeMobileMenu);
        mobileMenuBackdrop?.addEventListener('click', closeMobileMenu);
    </script>

    @stack('scripts')
</body>
</html>
