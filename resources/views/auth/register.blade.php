<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Setup Admin - Teras Bumi Tour</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="w-14 h-14 bg-natural-green rounded-xl flex items-center justify-center mx-auto mb-3 shadow-md">
                <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-earth-brown-dark">Setup Admin</h1>
            <p class="text-earth-brown text-sm">Buat akun admin pertama</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-md border border-cream-dark p-6">
            <!-- Warning -->
            <div class="mb-4 p-2.5 bg-amber-50 border border-amber-200 rounded-lg text-amber-700 text-xs">
                Setup awal - Pendaftaran ditutup setelah admin dibuat.
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Nama Lengkap</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}"
                        required 
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        placeholder="Nama Admin"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        placeholder="admin@terasbumitour.com"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        minlength="8"
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        placeholder="Minimal 8 karakter"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        minlength="8"
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        placeholder="Ulangi password"
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full py-2.5 bg-natural-green hover:bg-natural-green-dark text-white font-medium rounded-lg transition-colors shadow-sm text-sm"
                >
                    Buat Admin
                </button>
            </form>
        </div>

        <p class="text-center text-earth-brown-light text-xs mt-5">
            <a href="{{ route('login') }}" class="hover:text-natural-green transition-colors">← Sudah punya akun? Login</a>
        </p>
    </div>
</body>
</html>
