<x-admin-layout>
    <x-slot name="header">Hero Section</x-slot>

    <div class="mb-4 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800/50 rounded-xl px-4 py-3 border border-slate-200 dark:border-slate-700">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Background slideshow dikelola di <a href="{{ route('admin.hero-backgrounds.index') }}" class="text-indigo-500 dark:text-indigo-400 font-semibold hover:underline">Hero Backgrounds</a></span>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        @if($hero)
            <!-- Header bar -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                <h2 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Hero Info</h2>
                <a href="{{ route('admin.hero.edit', $hero->id) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-colors duration-150">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
            </div>

            <!-- Photo preview -->
            @if($hero->photo_path)
            <div class="px-6 pt-5">
                <img src="{{ $hero->photo_url }}" alt="Hero Photo"
                     class="w-20 h-20 object-cover rounded-xl border-2 border-indigo-200 dark:border-indigo-800 shadow">
            </div>
            @endif

            <!-- Data grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 divide-y md:divide-y-0 md:divide-x divide-slate-200 dark:divide-slate-700 px-6 py-5">
                <div class="space-y-4 md:pr-6">
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Name</p>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $hero->name }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Title</p>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $hero->title }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Typing Text</p>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $hero->typing_text }}</p>
                    </div>
                </div>
                <div class="space-y-4 pt-4 md:pt-0 md:pl-6">
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">GitHub URL</p>
                        @if($hero->github_url)
                            <a href="{{ $hero->github_url }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline break-all">{{ $hero->github_url }}</a>
                        @else
                            <span class="text-sm text-slate-400">—</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">LinkedIn URL</p>
                        @if($hero->linkedin_url)
                            <a href="{{ $hero->linkedin_url }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline break-all">{{ $hero->linkedin_url }}</a>
                        @else
                            <span class="text-sm text-slate-400">—</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Instagram</p>
                        @if($hero->instagram_url)
                            <a href="{{ $hero->instagram_url }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline break-all">{{ $hero->instagram_url }}</a>
                        @else
                            <span class="text-sm text-slate-400">—</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">WhatsApp</p>
                        @if($hero->whatsapp_url)
                            <a href="{{ $hero->whatsapp_url }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline break-all">{{ $hero->whatsapp_url }}</a>
                        @else
                            <span class="text-sm text-slate-400">—</span>
                        @endif
                    </div>
                    @if($hero->cv_path)
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">CV</p>
                        <a href="{{ $hero->cv_url }}" target="_blank"
                           class="inline-flex items-center gap-1.5 text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            View CV
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        @else
            <!-- Empty state -->
            <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-4">No Hero section data yet.</p>
                <a href="{{ route('admin.hero.create') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Create Hero Section
                </a>
            </div>
        @endif
    </div>
</x-admin-layout>
