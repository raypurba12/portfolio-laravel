<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order')->orderByDesc('start_year')->get();
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'institution'    => 'required|string|max:255',
            'degree'         => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'logo'           => 'nullable|image|max:2048',
            'start_year'     => 'required|digits:4|integer',
            'end_year'       => 'nullable|digits:4|integer|gte:start_year',
            'order'          => 'nullable|integer|min:0',
        ]);

        $data['is_current'] = $request->boolean('is_current');
        unset($data['logo']);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('uploads/education', 'public');
        }

        Education::create($data);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education created successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $data = $request->validate([
            'institution'    => 'required|string|max:255',
            'degree'         => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'logo'           => 'nullable|image|max:2048',
            'start_year'     => 'required|digits:4|integer',
            'end_year'       => 'nullable|digits:4|integer|gte:start_year',
            'order'          => 'nullable|integer|min:0',
        ]);

        $data['is_current'] = $request->boolean('is_current');
        unset($data['logo']);

        if ($request->hasFile('logo')) {
            if ($education->logo_path) Storage::disk('public')->delete($education->logo_path);
            $data['logo_path'] = $request->file('logo')->store('uploads/education', 'public');
        }

        $education->update($data);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        if ($education->logo_path) Storage::disk('public')->delete($education->logo_path);
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('success', 'Education deleted successfully.');
    }
}
