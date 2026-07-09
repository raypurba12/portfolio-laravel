<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::with('category')->orderBy('order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = SkillCategory::all();
        return view('admin.skills.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        $data = $request->validated();

        unset($data['logo']);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('uploads/skills', 'public');
        }

        $data['featured'] = $request->has('featured');

        Skill::create($data);

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        $categories = SkillCategory::all();
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        $data = $request->validated();

        unset($data['logo']);

        if ($request->hasFile('logo')) {
            if ($skill->logo_path) {
                Storage::disk('public')->delete($skill->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('uploads/skills', 'public');
        }

        $data['featured'] = $request->has('featured');

        $skill->update($data);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        if ($skill->logo_path) {
            Storage::disk('public')->delete($skill->logo_path);
        }
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
