<?php

namespace App\View\Composers;

use App\Models\Contact;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdminComposer
{
    public function compose(View $view): void
    {
        $unreadCount = Cache::remember('admin.unread_contact_count', 300, function () {
            return Contact::where('status', 'unread')->count();
        });

        $view->with('unreadContactCount', $unreadCount);
    }
}
