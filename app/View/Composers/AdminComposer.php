<?php

namespace App\View\Composers;

use App\Models\Contact;
use App\Models\VisitorNote;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdminComposer
{
    public function compose(View $view): void
    {
        $unreadCount = Cache::remember('admin.unread_contact_count', 300, function () {
            return Contact::where('status', 'unread')->count();
        });

        $pendingNotesCount = Cache::remember('admin.pending_notes_count', 60, function () {
            return VisitorNote::where('status', VisitorNote::STATUS_PENDING)->count();
        });

        $view->with('unreadContactCount', $unreadCount);
        $view->with('pendingVisitorNoteCount', $pendingNotesCount);
    }
}
