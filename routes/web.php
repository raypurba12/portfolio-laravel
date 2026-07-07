<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ─── Frontend ────────────────────────────────────────────────
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/projects', [FrontendController::class, 'projects'])->name('projects.index');
Route::get('/projects/{project:slug}', [FrontendController::class, 'projectDetail'])->name('projects.show');

// ─── Auth profile ─────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─── Admin ────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Content modules
    Route::resource('hero',         Admin\HeroController::class);
    Route::resource('about',        Admin\AboutController::class);
    Route::resource('skills',       Admin\SkillController::class);
    Route::resource('projects',     Admin\ProjectController::class);
    Route::resource('experience',   Admin\ExperienceController::class)->except(['show']);
    Route::resource('education',    Admin\EducationController::class)->except(['show']);
    Route::resource('certificates', Admin\CertificateController::class)->except(['show']);
    Route::resource('services',     Admin\ServiceController::class)->except(['show']);

    // Contact inbox
    Route::get('contacts',                    [Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}',          [Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/reply',   [Admin\ContactController::class, 'reply'])->name('contacts.reply');
    Route::delete('contacts/{contact}',       [Admin\ContactController::class, 'destroy'])->name('contacts.destroy');

    // Social Media
    Route::resource('social-media', Admin\SocialMediaController::class)->except(['show']);

    // Settings (single page form)
    Route::get('settings',  [Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
});

// Redirect /dashboard → /admin/dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
