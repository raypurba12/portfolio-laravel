<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\VisitorNote;

class DashboardController extends Controller
{
    public function index()
    {
        // Variable names that match admin/dashboard.blade.php
        $totalMessages       = Contact::count();
        $unreadMessages      = Contact::where('status', 'unread')->count();
        $totalProjects       = Project::count();
        $totalSkills         = Skill::count();
        $totalCerts          = Certificate::count();
        $totalServices       = Service::count();
        $recentContacts      = Contact::latest()->take(5)->get();
        $totalVisitorNotes   = VisitorNote::count();
        $pendingVisitorNotes = VisitorNote::where('status', VisitorNote::STATUS_PENDING)->count();
        $recentVisitorNotes  = VisitorNote::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalMessages', 'unreadMessages',
            'totalProjects', 'totalSkills',
            'totalCerts', 'totalServices',
            'recentContacts',
            'totalVisitorNotes', 'pendingVisitorNotes', 'recentVisitorNotes'
        ));
    }
}
