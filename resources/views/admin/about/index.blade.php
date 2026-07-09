<x-admin-layout>
    <x-slot name="header">About Section</x-slot>

    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        @if($about)
            <!-- Header bar -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                <h2 class="text-sm font-semibold text-slate-700 dark:text-slate-200">About Info</h2>
                <a href="{{ route('admin.about.edit', $about->id) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-colors duration-150">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
            </div>

            <!-- Photo -->
            @if($about->photo_path ?? false)
            <div class="px-6 pt-5">
                <img src="{{ $about->photo_url }}" alt="About Photo"
                     class="w-20 h-20 object-cover rounded-xl border-2 border-indigo-200 dark:border-indigo-800 shadow">
            </div>
            @endif

            <!-- Data -->
            <div class="p-6 space-y-5">
                <!-- Description -->
                <div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Description</p>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $about->description }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Birth Date</p>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $about->birth_date->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Location</p>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $about->location }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Email</p>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $about->email }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Phone</p>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $about->phone }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Language</p>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $about->language }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Hobbies</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $about->hobbies) as $hobby)
                        <span class="px-2.5 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 text-xs font-medium rounded-full">{{ trim($hobby) }}</span>
                        @endforeach
                    </div>
                </div>

                @if($about->cv_path ?? false)
                <div>
                    <a href="{{ $about->cv_url }}" target="_blank"
                       class="inline-flex items-center gap-1.5 text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        View CV
                    </a>
                </div>
                @endif
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-4">No About section data yet.</p>
                <a href="{{ route('admin.about.create') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Create About Section
                </a>
            </div>
        @endif
    </div>
</x-admin-layout>
