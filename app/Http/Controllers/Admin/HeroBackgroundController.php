<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBackground;
use Illuminate\Http\Request;

class HeroBackgroundController extends Controller
{
    public function index()
    {
        $backgrounds = HeroBackground::ordered()->get();
        return view('admin.hero-backgrounds.index', compact('backgrounds'));
    }

    public function create()
    {
        return view('admin.hero-backgrounds.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'     => 'required|in:image,video',
            'url'      => 'required|string|max:500',
            'poster'   => 'nullable|string|max:500',
            'duration' => 'nullable|numeric|min:0.5|max:60',
            'order'    => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        if (isset($data['duration'])) {
            $data['duration'] = (int) round($data['duration'] * 1000);
        }

        HeroBackground::create($data);

        return redirect()->route('admin.hero-backgrounds.index')
            ->with('success', 'Background added successfully.');
    }

    public function edit(HeroBackground $heroBackground)
    {
        return view('admin.hero-backgrounds.edit', compact('heroBackground'));
    }

    public function update(Request $request, HeroBackground $heroBackground)
    {
        $data = $request->validate([
            'type'     => 'required|in:image,video',
            'url'      => 'required|string|max:500',
            'poster'   => 'nullable|string|max:500',
            'duration' => 'nullable|numeric|min:0.5|max:60',
            'order'    => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if (isset($data['duration'])) {
            $data['duration'] = (int) round($data['duration'] * 1000);
        }

        $heroBackground->update($data);

        return redirect()->route('admin.hero-backgrounds.index')
            ->with('success', 'Background updated successfully.');
    }

    public function destroy(HeroBackground $heroBackground)
    {
        $heroBackground->delete();

        return redirect()->route('admin.hero-backgrounds.index')
            ->with('success', 'Background deleted successfully.');
    }
}
