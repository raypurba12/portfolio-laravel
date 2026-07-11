<x-admin-layout>
    <x-slot name="header">Social Media</x-slot>
    <x-success-alert/>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.social-media.create') }}" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">+ Add Link</a>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80">
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Platform</th>
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">URL</th>
                    <th class="px-5 py-3.5 text-center text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Active</th>
                    <th class="px-5 py-3.5 text-center text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Order</th>
                    <th class="px-5 py-3.5 text-right text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                @forelse($socials as $social)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-100">
                    <td class="px-5 py-3.5">
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 capitalize">{{ $social->platform }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $social->label }}</p>
                    </td>
                    <td class="px-5 py-3.5">
                        <a href="{{ $social->url }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline truncate max-w-xs block">{{ $social->url }}</a>
                    </td>
                    <td class="px-5 py-3.5 text-center">
                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full {{ $social->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-slate-100 text-slate-500 dark:bg-slate-700 dark:text-slate-400' }}">
                            {{ $social->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-center text-sm text-slate-500 dark:text-slate-400">{{ $social->order }}</td>
                    <td class="px-5 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.social-media.edit', $social) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 rounded-lg transition-colors duration-150">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.social-media.destroy', $social) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 rounded-lg transition-colors duration-150"
                                        onclick="return confirm('Delete?')">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                            </div>
                            <p class="text-sm text-slate-500 dark:text-slate-400">No social media links yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
