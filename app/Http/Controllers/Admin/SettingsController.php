<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function editWelcome(): View
    {
        $welcomePath = resource_path('views/welcome.blade.php');
        $content = File::exists($welcomePath) ? File::get($welcomePath) : '';

        return view('admin.settings.edit-welcome', compact('content'));
    }

    public function updateWelcome(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => ['required', 'string'],
        ]);

        $welcomePath = resource_path('views/welcome.blade.php');
        
        try {
            File::put($welcomePath, $request->content);
            
            return redirect()->route('admin.settings.edit-welcome')
                ->with('success', 'Welcome page berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.edit-welcome')
                ->with('error', 'Gagal memperbarui welcome page: ' . $e->getMessage());
        }
    }

    public function editLogo(): View
    {
        $logoPath = public_path('img/b1g.png');
        $logoExists = File::exists($logoPath);

        return view('admin.settings.edit-logo', compact('logoExists'));
    }

    public function updateLogo(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        try {
            // Ensure directory exists
            $logoDir = public_path('img');
            if (!File::exists($logoDir)) {
                File::makeDirectory($logoDir, 0755, true);
            }

            // Delete old logo if exists
            $oldLogoPath = public_path('img/b1g.png');
            if (File::exists($oldLogoPath)) {
                File::delete($oldLogoPath);
            }

            // Save new logo
            $request->file('logo')->move($logoDir, 'b1g.png');

            return redirect()->route('admin.settings.edit-logo')
                ->with('success', 'Logo berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.edit-logo')
                ->with('error', 'Gagal memperbarui logo: ' . $e->getMessage());
        }
    }
}
