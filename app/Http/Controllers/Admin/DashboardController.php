<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'     => Cache::remember('admin.total_projects', 300, fn() => Project::count()),
            'skills'       => Cache::remember('admin.total_skills', 300, fn() => Skill::count()),
            'certificates' => Cache::remember('admin.total_certificates', 300, fn() => Certificate::count()),
            'services'     => Cache::remember('admin.total_services', 300, fn() => Service::count()),
            'contacts'     => Cache::remember('admin.total_messages', 300, fn() => Contact::count()),
            'unread'       => Cache::remember('admin.unread_messages', 300, fn() => Contact::where('status', 'unread')->count()),
        ];

        $recentContacts = Contact::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentContacts'));
    }
}
