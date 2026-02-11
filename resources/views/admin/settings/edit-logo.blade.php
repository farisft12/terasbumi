@extends('layouts.admin')

@section('title', 'Edit Logo')
@section('page-title', 'Edit Logo')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-earth-brown-dark">Edit Logo</h2>
        <p class="text-sm text-earth-brown">Unggah logo baru untuk website (format: PNG, JPG, atau JPEG, maksimal 2MB)</p>
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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Current Logo -->
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h3 class="text-lg font-semibold text-earth-brown-dark mb-4">Logo Saat Ini</h3>
            @if($logoExists)
                <div class="bg-cream rounded-lg p-4 flex items-center justify-center">
                    <img src="{{ asset('img/b1g.png') }}?v={{ time() }}" alt="Current Logo" class="max-w-full h-auto max-h-64">
                </div>
                <p class="mt-4 text-xs text-earth-brown text-center">
                    Logo saat ini: <code class="bg-cream px-2 py-1 rounded">public/img/b1g.png</code>
                </p>
            @else
                <div class="bg-cream rounded-lg p-8 flex items-center justify-center">
                    <p class="text-earth-brown text-sm">Logo belum diunggah</p>
                </div>
            @endif
        </div>

        <!-- Upload New Logo -->
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h3 class="text-lg font-semibold text-earth-brown-dark mb-4">Unggah Logo Baru</h3>
            
            <form method="POST" action="{{ route('admin.settings.update-logo') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="logo" class="block text-sm font-medium text-earth-brown-dark mb-2">
                        Pilih File Logo
                    </label>
                    <input 
                        type="file" 
                        id="logo" 
                        name="logo" 
                        accept="image/png,image/jpeg,image/jpg"
                        class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        required
                    >
                    <p class="mt-2 text-xs text-earth-brown">
                        Format yang didukung: PNG, JPG, JPEG. Ukuran maksimal: 2MB. Logo akan disimpan sebagai <code class="bg-cream px-1 py-0.5 rounded">b1g.png</code>
                    </p>
                </div>

                <div class="mb-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Catatan:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Logo akan menggantikan logo yang ada saat ini</li>
                                    <li>Disarankan menggunakan format PNG dengan background transparan</li>
                                    <li>Ukuran optimal: tinggi 200-300px</li>
                                    <li>Logo akan otomatis digunakan di semua halaman</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-earth-brown hover:text-earth-brown-dark transition-colors text-sm font-medium">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-natural-green hover:bg-natural-green-dark text-white rounded-lg transition-colors text-sm font-medium">
                        Unggah Logo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Section -->
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-cream-dark p-6">
        <h3 class="text-lg font-semibold text-earth-brown-dark mb-4">Preview Logo</h3>
        <div class="bg-cream rounded-lg p-6 flex items-center justify-center">
            @if($logoExists)
                <img src="{{ asset('img/b1g.png') }}?v={{ time() }}" alt="Logo Preview" id="logo-preview" class="max-w-full h-auto max-h-32">
            @else
                <p class="text-earth-brown text-sm">Unggah logo untuk melihat preview</p>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('logo');
    const logoPreview = document.getElementById('logo-preview');
    
    if (logoInput && logoPreview) {
        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                    logoPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection
