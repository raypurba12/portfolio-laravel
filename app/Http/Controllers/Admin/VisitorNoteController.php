<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorNote;
use Illuminate\Http\Request;

class VisitorNoteController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $query  = VisitorNote::latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $notes  = $query->paginate(15);
        $counts = [
            'all'      => VisitorNote::count(),
            'pending'  => VisitorNote::where('status', VisitorNote::STATUS_PENDING)->count(),
            'approved' => VisitorNote::where('status', VisitorNote::STATUS_APPROVED)->count(),
            'rejected' => VisitorNote::where('status', VisitorNote::STATUS_REJECTED)->count(),
        ];

        return view('admin.visitor-notes.index', compact('notes', 'counts', 'status'));
    }

    public function approve(VisitorNote $visitorNote)
    {
        $visitorNote->update(['status' => VisitorNote::STATUS_APPROVED]);

        return redirect()->route('admin.visitor-notes.index', ['status' => 'approved'])
            ->with('success', "Note from \"{$visitorNote->name}\" approved and shown on the public page.");
    }

    public function reject(VisitorNote $visitorNote)
    {
        $visitorNote->update(['status' => VisitorNote::STATUS_REJECTED]);

        return redirect()->route('admin.visitor-notes.index', ['status' => 'rejected'])
            ->with('success', "Note from \"{$visitorNote->name}\" rejected.");
    }

    public function destroy(VisitorNote $visitorNote)
    {
        $visitorNote->delete();

        return redirect()->route('admin.visitor-notes.index')
            ->with('success', 'Visitor note deleted.');
    }
}