<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    // Display the list of settings
    public function index()
    {
        
        $settings = settings::all();

        return view('pages.admin.settings', ['settings' => $settings]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'heroImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $heroImagePath = $request->file('heroImage')->store('HeroImage', 'public');

        $setting = Settings::first();
        if ($setting) {
            // If a setting exists, update it
            if ($setting->heroImage) {
                // Delete the old image
                Storage::disk('public')->delete($setting->heroImage);
            }
            $setting->update([
                'heroImage' => $heroImagePath
            ]);
        } else {
            // If no setting exists, create a new one
            Settings::create([
                'heroImage' => $heroImagePath
            ]);
        }
        toastr()->success('Hero image updated successfully!', 'Success', ['timeOut' => 3500]);
        return redirect()->route('settings');
    }
}
