<x-admin-layout>
    <x-slot name="header">Projects</x-slot>

    <div x-data="{ deleteModal: false, deleteId: null, deleteTitle: '' }">

        <!-- Top bar -->
        <div class="flex items-center justify-between mb-5">
            <p class="text-sm text-slate-500 dark:text-slate-400">Manage all your portfolio projects.</p>
            <a href="{{ route('admin.projects.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Project
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80">
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Project</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Category</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Featured</th>
                        <th class="px-5 py-3.5 text-right text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                    @forelse ($projects as $project)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-100">
                        <!-- Project title + thumbnail -->
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($project->thumbnail_path)
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $project->thumbnail_path)) }}" alt="{{ $project->title }}"
                                         class="w-10 h-10 object-cover rounded-lg flex-shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                <span class="text-sm font-semibold text-slate-800 dark:text-slate-100 line-clamp-1">{{ $project->title }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="text-sm text-slate-600 dark:text-slate-400">{{ $project->category->name ?? '—' }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $project->status === 'published'
                                    ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400'
                                    : 'bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400' }}">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $project->status === 'published' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                {{ ucfirst($project->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($project->featured)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-400">
                                    ★ Featured
                                </span>
                            @else
                                <span class="text-xs text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.projects.edit', $project->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 rounded-lg transition-colors duration-150">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <button type="button"
                                        @click="deleteModal = true; deleteId = {{ $project->id }}; deleteTitle = '{{ addslashes($project->title) }}'"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 rounded-lg transition-colors duration-150">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <p class="text-sm text-slate-500 dark:text-slate-400">No projects yet. Create your first project!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="deleteModal"
             x-cloak
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div x-show="deleteModal"
                 x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-2xl p-6 w-full max-w-md">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-rose-100 dark:bg-rose-500/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Delete Project</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">This action cannot be undone.</p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                    Are you sure you want to delete <span class="font-semibold text-slate-800 dark:text-white" x-text="deleteTitle"></span>?
                </p>
                <div class="flex items-center justify-end gap-3">
                    <button type="button" @click="deleteModal = false"
                            class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                        Cancel
                    </button>
                    <form :action="'/admin/projects/' + deleteId" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-lg transition-colors duration-150">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
