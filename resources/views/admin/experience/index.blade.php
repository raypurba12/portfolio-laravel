<x-admin-layout>
    <x-slot name="header">Experience</x-slot>
    <x-success-alert/>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.experience.create') }}"
           class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
            + Add Experience
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80">
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Company / Position</th>
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Period</th>
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Location</th>
                    <th class="px-5 py-3.5 text-right text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                @forelse($experiences as $exp)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-100">
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            @if($exp->logo_path)
                            <img src="{{ asset('storage/' . str_replace('public/', '', $exp->logo_path)) }}" class="w-8 h-8 rounded object-contain bg-slate-100 dark:bg-slate-700 p-1 flex-shrink-0">
                            @else
                            <div class="w-8 h-8 rounded bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400 text-xs font-bold flex-shrink-0">{{ substr($exp->company,0,2) }}</div>
                            @endif
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $exp->company }}</p>
                                <p class="text-slate-500 dark:text-slate-400 text-xs">{{ $exp->position }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 text-sm text-slate-600 dark:text-slate-400">
                        {{ $exp->start_date->format('M Y') }} —
                        {{ $exp->is_current ? 'Present' : ($exp->end_date?->format('M Y') ?? '-') }}
                    </td>
                    <td class="px-5 py-3.5 text-sm text-slate-500 dark:text-slate-400">{{ $exp->location ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.experience.edit', $exp) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 rounded-lg transition-colors duration-150">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.experience.destroy', $exp) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 rounded-lg transition-colors duration-150"
                                        onclick="return confirm('Delete this experience?')">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2 2v2M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-sm text-slate-500 dark:text-slate-400">No experience added yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
