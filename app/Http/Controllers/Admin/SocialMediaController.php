<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socials = SocialMedia::orderBy('order')->get();
        return view('admin.social-media.index', compact('socials'));
    }

    public function create()
    {
        return view('admin.social-media.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform'  => 'required|string|max:100',
            'label'     => 'required|string|max:100',
            'url'       => 'required|url|max:500',
            'icon'      => 'nullable|string|max:1000',
            'order'     => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        SocialMedia::create($data);
        return redirect()->route('admin.social-media.index')->with('success', 'Social media added.');
    }

    public function edit(SocialMedia $socialMedium)
    {
        return view('admin.social-media.edit', compact('socialMedium'));
    }

    public function update(Request $request, SocialMedia $socialMedium)
    {
        $data = $request->validate([
            'platform'  => 'required|string|max:100',
            'label'     => 'required|string|max:100',
            'url'       => 'required|url|max:500',
            'icon'      => 'nullable|string|max:1000',
            'order'     => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $socialMedium->update($data);
        return redirect()->route('admin.social-media.index')->with('success', 'Social media updated.');
    }

    public function destroy(SocialMedia $socialMedium)
    {
        $socialMedium->delete();
        return redirect()->route('admin.social-media.index')->with('success', 'Social media deleted.');
    }
}
