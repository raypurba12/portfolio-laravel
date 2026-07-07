<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'     => Project::count(),
            'skills'       => Skill::count(),
            'certificates' => Certificate::count(),
            'services'     => Service::count(),
            'contacts'     => Contact::count(),
            'unread'       => Contact::where('status', 'unread')->count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentContacts'));
    }
}
