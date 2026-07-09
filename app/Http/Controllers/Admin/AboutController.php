<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (About::count() > 0) {
            return redirect()->route('admin.about.index');
        }
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('uploads/about', 'public');
        }
        if ($request->hasFile('cv')) {
            $data['cv_path'] = $request->file('cv')->store('uploads/about', 'public');
        }

        About::create($data);

        return redirect()->route('admin.about.index')->with('success', 'About section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        $data = $request->validated();

        unset($data['photo'], $data['cv']);

        if ($request->hasFile('photo')) {
            if ($about->photo_path) {
                Storage::disk('public')->delete($about->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('uploads/about', 'public');
        }
        if ($request->hasFile('cv')) {
            if ($about->cv_path) {
                Storage::disk('public')->delete($about->cv_path);
            }
            $data['cv_path'] = $request->file('cv')->store('uploads/about', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'About section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        if ($about->photo_path) {
            Storage::delete($about->photo_path);
        }
        if ($about->cv_path) {
            Storage::delete($about->cv_path);
        }
        $about->delete();
        return redirect()->route('admin.about.index')->with('success', 'About section deleted successfully.');
    }
}
