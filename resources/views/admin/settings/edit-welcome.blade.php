@extends('layouts.admin')

@section('title', 'Edit Welcome Page')
@section('page-title', 'Edit Welcome Page')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-earth-brown-dark">Edit Welcome Page</h2>
        <p class="text-sm text-earth-brown">Edit konten halaman welcome (homepage) website</p>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
        <form method="POST" action="{{ route('admin.settings.update-welcome') }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-earth-brown-dark mb-2">
                    Konten Welcome Page (Blade Template)
                </label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="30" 
                    class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm font-mono"
                    required
                >{{ old('content', $content ?? '') }}</textarea>
                <p class="mt-2 text-xs text-earth-brown">
                    Edit konten Blade template untuk halaman welcome. Pastikan format HTML dan Blade syntax benar.
                </p>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-earth-brown hover:text-earth-brown-dark transition-colors text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-natural-green hover:bg-natural-green-dark text-white rounded-lg transition-colors text-sm font-medium">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div class="text-sm text-yellow-800">
                <p class="font-semibold mb-1">Peringatan:</p>
                <p>Pastikan Anda memahami sintaks Blade sebelum mengedit. Kesalahan sintaks dapat menyebabkan halaman error. Disarankan untuk membuat backup terlebih dahulu.</p>
            </div>
        </div>
    </div>
</div>
@endsection
