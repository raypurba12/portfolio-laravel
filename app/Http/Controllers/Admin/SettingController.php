<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    private array $keys = [
        'site_title', 'site_description', 'site_email', 'site_address',
        'site_phone', 'site_footer', 'google_analytics', 'google_maps_embed',
        'logo_path', 'favicon_path',
    ];

    public function index()
    {
        $settings = Setting::batchGet($this->keys);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title'       => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_email'       => 'nullable|email|max:255',
            'site_address'     => 'nullable|string|max:500',
            'site_phone'       => 'nullable|string|max:50',
            'site_footer'      => 'nullable|string|max:500',
            'google_analytics' => 'nullable|string|max:50',
            'google_maps_embed'=> 'nullable|string',
            'logo'             => 'nullable|image|max:2048',
            'favicon'          => 'nullable|image|max:512',
        ]);

        // Text settings
        $textKeys = ['site_title','site_description','site_email','site_address',
                     'site_phone','site_footer','google_analytics','google_maps_embed'];
        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // Logo upload
        if ($request->hasFile('logo')) {
            $old = Setting::get('logo_path');
            if ($old) Storage::disk('public')->delete($old);
            $path = $request->file('logo')->store('uploads/settings', 'public');
            Setting::set('logo_path', $path);
        }

        if ($request->hasFile('favicon')) {
            $old = Setting::get('favicon_path');
            if ($old) Storage::disk('public')->delete($old);
            $path = $request->file('favicon')->store('uploads/settings', 'public');
            Setting::set('favicon_path', $path);
        }

        Cache::forget('frontend.home');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved successfully.');
    }
}
