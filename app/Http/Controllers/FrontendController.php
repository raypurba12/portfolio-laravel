<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hero;
use App\Models\HeroBackground;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SocialMedia;
use App\Models\VisitorNote;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function home()
    {
        $data = Cache::remember('frontend.home', 3600, function () {
            return [
                'hero'         => Hero::first(),
                'about'        => About::first(),
                'skills'       => Skill::where('featured', true)->orderBy('order')->get(),
                'projects'     => Project::where('status', 'published')
                                    ->where('featured', true)
                                    ->with('category')
                                    ->latest('date')
                                    ->take(6)
                                    ->get(),
                'services'     => Service::where('is_active', true)->orderBy('order')->get(),
                'experiences'  => Experience::orderBy('order')->orderByDesc('start_date')->get(),
                'educations'   => Education::orderBy('order')->orderByDesc('start_year')->get(),
                'certificates' => Certificate::orderByDesc('issued_at')->take(6)->get(),
                'socialMedias' => SocialMedia::where('is_active', true)->orderBy('order')->get(),
                'settings'       => Setting::batchGet([
                    'site_title', 'site_description', 'site_keywords', 'site_twitter_username',
                    'site_footer', 'site_email', 'site_phone', 'site_address',
                    'google_analytics', 'google_maps_embed',
                    'logo_path', 'favicon_path', 'seo_og_image_path',
                ]),
                'heroBackgrounds' => HeroBackground::active()->ordered()->get(),
            ];
        });

        // Hanya notes berstatus approved yang ditampilkan publik.
        // Disengaja di luar cache agar note baru tampil segera setelah di-approve.
        $data['visitorNotes'] = VisitorNote::approved()->latest()->take(12)->get();

        return view('welcome', $data);
    }

    public function projects()
    {
        $projects = Project::where('status', 'published')
                        ->with('category')
                        ->latest('date')
                        ->paginate(9);

        $settings = Setting::batchGet([
            'site_title', 'site_description', 'site_keywords', 'site_twitter_username',
            'site_footer', 'google_analytics', 'logo_path', 'favicon_path', 'seo_og_image_path'
        ]);

        return view('frontend.projects.index', compact('projects', 'settings'));
    }

    public function projectDetail(Project $project)
    {
        abort_if($project->status !== 'published', 404);
        $project->load(['category', 'images']);

        $settings = Setting::batchGet([
            'site_title', 'site_description', 'site_keywords', 'site_twitter_username',
            'site_footer', 'google_analytics', 'logo_path', 'favicon_path', 'seo_og_image_path'
        ]);

        return view('frontend.projects.show', compact('project', 'settings'));
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Contact::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'status'     => 'unread',
            'ip_address' => $request->ip(),
        ]);

        Cache::forget('frontend.home');

        return redirect()->to(route('home') . '#contact')
            ->with('contact_success', __('contact.success_sent'));
    }

    public function visitorNoteStore(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:60',
            'message' => 'required|string|min:3|max:500',
        ]);

        VisitorNote::create([
            'name'    => $validated['name'],
            'message' => $validated['message'],
            'status'  => VisitorNote::STATUS_PENDING,
        ]);

        Cache::forget('frontend.home');

        return redirect()->to(route('home') . '#visitor-notes')
            ->with('visitor_note_success', $validated['name']);
    }
}
