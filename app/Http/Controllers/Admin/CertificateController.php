<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderByDesc('issued_at')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'number'    => 'nullable|string|max:255',
            'issuer'    => 'required|string|max:255',
            'issued_at' => 'required|date',
            'image'     => 'nullable|image|max:4096',
            'pdf'       => 'nullable|mimes:pdf|max:10240',
        ]);

        unset($data['image'], $data['pdf']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('uploads/certificates', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('uploads/certificates', 'public');
        }

        Certificate::create($data);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'number'    => 'nullable|string|max:255',
            'issuer'    => 'required|string|max:255',
            'issued_at' => 'required|date',
            'image'     => 'nullable|image|max:4096',
            'pdf'       => 'nullable|mimes:pdf|max:10240',
        ]);

        unset($data['image'], $data['pdf']);

        if ($request->hasFile('image')) {
            if ($certificate->image_path) Storage::disk('public')->delete($certificate->image_path);
            $data['image_path'] = $request->file('image')->store('uploads/certificates', 'public');
        }
        if ($request->hasFile('pdf')) {
            if ($certificate->pdf_path) Storage::disk('public')->delete($certificate->pdf_path);
            $data['pdf_path'] = $request->file('pdf')->store('uploads/certificates', 'public');
        }

        $certificate->update($data);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image_path) Storage::disk('public')->delete($certificate->image_path);
        if ($certificate->pdf_path)   Storage::disk('public')->delete($certificate->pdf_path);
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted.');
    }
}
