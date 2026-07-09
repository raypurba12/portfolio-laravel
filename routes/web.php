<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\HeroBackgroundController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Api\ChatbotController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Models\Project;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/sitemap.xml', function () {
    $projects = Project::where('status', 'published')->get();
    return response()->view('sitemap', compact('projects'))->header('Content-Type', 'text/xml');
});
Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml') . "\n")
        ->header('Content-Type', 'text/plain');
});
Route::get('/projects', [FrontendController::class, 'projects'])->name('projects.index');
Route::get('/projects/{project:slug}', [FrontendController::class, 'projectDetail'])->name('projects.show');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');
Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send')->middleware('throttle:30,1');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('about', AboutController::class)->except('show');
    Route::resource('certificates', CertificateController::class)->except('show');
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('contacts.reply');
    Route::resource('education', EducationController::class)->except('show');
    Route::resource('experience', ExperienceController::class)->except('show');
    Route::resource('hero', HeroController::class)->except('show');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('hero-backgrounds', HeroBackgroundController::class)->except('show');
    Route::resource('services', ServiceController::class)->except('show');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('skills', SkillController::class)->except('show');
    Route::resource('social-media', SocialMediaController::class)->except('show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
