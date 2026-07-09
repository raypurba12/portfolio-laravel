<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $query  = Contact::latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $contacts = $query->paginate(15);
        $counts = [
            'all'     => Contact::count(),
            'unread'  => Contact::where('status', 'unread')->count(),
            'read'    => Contact::where('status', 'read')->count(),
            'replied' => Contact::where('status', 'replied')->count(),
        ];

        return view('admin.contacts.index', compact('contacts', 'counts', 'status'));
    }

    public function show(Contact $contact)
    {
        // Mark as read when opened
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, Contact $contact)
    {
        $request->validate([
            'reply' => 'required|string|min:5',
        ]);

        $contact->update([
            'reply'      => $request->reply,
            'status'     => 'replied',
            'replied_at' => now(),
        ]);

        // Send reply email
        try {
            Mail::raw($request->reply, function ($message) use ($contact) {
                $message->to($contact->email, $contact->name)
                        ->subject('Re: ' . ($contact->subject ?? 'Your Message'));
            });
        } catch (\Exception $e) {
            // Log but don't fail
            logger()->error('Failed to send reply email: ' . $e->getMessage());
        }

        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'Reply sent successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted.');
    }
}
