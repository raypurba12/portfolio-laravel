<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'icon'              => 'nullable|string|max:255',
            'short_description' => 'required|string|max:500',
            'description'       => 'nullable|string',
            'price'             => 'nullable|numeric|min:0',
            'order'             => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'icon'              => 'nullable|string|max:255',
            'short_description' => 'required|string|max:500',
            'description'       => 'nullable|string',
            'price'             => 'nullable|numeric|min:0',
            'order'             => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}
