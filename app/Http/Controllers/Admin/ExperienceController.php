<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order')->orderByDesc('start_date')->get();
        return view('admin.experience.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experience.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company'     => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'logo'        => 'nullable|image|max:2048',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'order'       => 'nullable|integer|min:0',
        ]);

        $data['is_current'] = $request->boolean('is_current');

        unset($data['logo']);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('uploads/experience', 'public');
        }

        Experience::create($data);

        return redirect()->route('admin.experience.index')
            ->with('success', 'Experience created successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experience.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'company'     => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'logo'        => 'nullable|image|max:2048',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'order'       => 'nullable|integer|min:0',
        ]);

        $data['is_current'] = $request->boolean('is_current');

        unset($data['logo']);

        if ($request->hasFile('logo')) {
            if ($experience->logo_path) Storage::disk('public')->delete($experience->logo_path);
            $data['logo_path'] = $request->file('logo')->store('uploads/experience', 'public');
        }

        $experience->update($data);

        return redirect()->route('admin.experience.index')
            ->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        if ($experience->logo_path) Storage::disk('public')->delete($experience->logo_path);
        $experience->delete();

        return redirect()->route('admin.experience.index')
            ->with('success', 'Experience deleted successfully.');
    }
}
