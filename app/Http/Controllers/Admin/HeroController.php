<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeroRequest;
use App\Http\Requests\UpdateHeroRequest;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero = Hero::first();
        return view('admin.hero.index', compact('hero'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Hero::count() > 0) {
            return redirect()->route('admin.hero.index');
        }
        return view('admin.hero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeroRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('uploads/hero', 'public');
        }
        if ($request->hasFile('background')) {
            $data['background_path'] = $request->file('background')->store('uploads/hero', 'public');
        }
        if ($request->hasFile('cv')) {
            $data['cv_path'] = $request->file('cv')->store('uploads/hero', 'public');
        }

        Hero::create($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not needed for a single-entry resource
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroRequest $request, Hero $hero)
    {
        $data = $request->validated();

        unset($data['photo'], $data['background'], $data['cv']);

        if ($request->hasFile('photo')) {
            if ($hero->photo_path) {
                Storage::disk('public')->delete($hero->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('uploads/hero', 'public');
        }
        if ($request->hasFile('background')) {
            if ($hero->background_path) {
                Storage::disk('public')->delete($hero->background_path);
            }
            $data['background_path'] = $request->file('background')->store('uploads/hero', 'public');
        }
        if ($request->hasFile('cv')) {
            if ($hero->cv_path) {
                Storage::disk('public')->delete($hero->cv_path);
            }
            $data['cv_path'] = $request->file('cv')->store('uploads/hero', 'public');
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        if ($hero->photo_path && !str_starts_with($hero->photo_path, 'http')) {
            Storage::delete($hero->photo_path);
        }
        if ($hero->background_path && !str_starts_with($hero->background_path, 'http')) {
            Storage::delete($hero->background_path);
        }
        if ($hero->cv_path && !str_starts_with($hero->cv_path, 'http')) {
            Storage::delete($hero->cv_path);
        }
        $hero->delete();
        return redirect()->route('admin.hero.index')->with('success', 'Hero section deleted successfully.');
    }
}
