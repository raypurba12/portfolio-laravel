<x-admin-layout>
    <x-slot name="header">Skills</x-slot>

    <div x-data="{ deleteModal: false, deleteId: null, deleteName: '' }">

        <!-- Top bar -->
        <div class="flex items-center justify-between mb-5">
            <p class="text-sm text-slate-500 dark:text-slate-400">Manage all your skills here.</p>
            <a href="{{ route('admin.skills.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Skill
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80">
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Skill</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Category</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Level</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Order</th>
                        <th class="px-5 py-3.5 text-right text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                    @forelse ($skills as $skill)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-100">
                        <!-- Skill name + logo -->
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($skill->logo_path)
                                    <img src="{{ str_starts_with($skill->logo_path, 'http') ? $skill->logo_path : asset('storage/' . str_replace('public/', '', $skill->logo_path)) }}" alt="{{ $skill->name }}"
                                         class="w-8 h-8 object-contain rounded-lg bg-slate-100 dark:bg-slate-700 p-1 flex-shrink-0">
                                @else
                                    <div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400">{{ strtoupper(substr($skill->name, 0, 2)) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $skill->name }}</p>
                                    @if($skill->featured)
                                    <span class="text-[10px] font-medium text-indigo-600 dark:text-indigo-400">Featured</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="text-sm text-slate-600 dark:text-slate-400">{{ $skill->category->name }}</span>
                        </td>
                        <!-- Progress bar -->
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2">
                                <div class="flex-1 w-20 bg-slate-200 dark:bg-slate-700 rounded-full h-1.5">
                                    <div class="h-1.5 rounded-full bg-gradient-to-r from-indigo-500 to-violet-500"
                                         style="width: {{ $skill->percentage }}%"></div>
                                </div>
                                <span class="text-xs font-medium text-slate-600 dark:text-slate-400 w-9 flex-shrink-0">{{ $skill->percentage }}%</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="text-sm text-slate-500 dark:text-slate-400">{{ $skill->order }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.skills.edit', $skill->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 rounded-lg transition-colors duration-150">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <button type="button"
                                        @click="deleteModal = true; deleteId = {{ $skill->id }}; deleteName = '{{ $skill->name }}'"
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
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                </div>
                                <p class="text-sm text-slate-500 dark:text-slate-400">No skills found. Add your first skill!</p>
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
                        <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Delete Skill</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">This action cannot be undone.</p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                    Are you sure you want to delete <span class="font-semibold text-slate-800 dark:text-white" x-text="deleteName"></span>?
                </p>
                <div class="flex items-center justify-end gap-3">
                    <button type="button" @click="deleteModal = false"
                            class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                        Cancel
                    </button>
                    <form :action="'/admin/skills/' + deleteId" method="POST">
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
