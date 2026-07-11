<x-admin-layout>
    <x-slot name="header">Hero Backgrounds</x-slot>
    <x-slot name="subheader">Manage slideshow backgrounds for the hero section (images &amp; videos).</x-slot>
    <x-success-alert/>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.hero-backgrounds.create') }}"
           class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
            + Add Background
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80">
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Preview</th>
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Type</th>
                    <th class="px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">URL</th>
                    <th class="px-5 py-3.5 text-center text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Active</th>
                    <th class="px-5 py-3.5 text-center text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Order</th>
                    <th class="px-5 py-3.5 text-right text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                @forelse($backgrounds as $bg)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-100">
                    <td class="px-5 py-3.5">
                        @if($bg->type === 'video')
                        <div class="w-16 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        @else
                        <img src="{{ $bg->url }}" alt="" class="w-16 h-10 object-cover rounded-lg border border-slate-200 dark:border-slate-600 flex-shrink-0"
                             onerror="this.style.display='none'">
                        @endif
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full {{ $bg->type === 'video' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-400' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400' }}">
                            {{ ucfirst($bg->type) }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5">
                        <a href="{{ $bg->url }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline truncate max-w-xs block">{{ $bg->url }}</a>
                        @if($bg->poster)
                        <span class="text-[10px] text-slate-400 dark:text-slate-500">poster: {{ $bg->poster }}</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-center">
                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full {{ $bg->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-slate-100 text-slate-500 dark:bg-slate-700 dark:text-slate-400' }}">
                            {{ $bg->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-center text-sm text-slate-500 dark:text-slate-400">{{ $bg->order }}</td>
                    <td class="px-5 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.hero-backgrounds.edit', $bg) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 rounded-lg transition-colors duration-150">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.hero-backgrounds.destroy', $bg) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 rounded-lg transition-colors duration-150"
                                        onclick="return confirm('Delete this background?')">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-sm text-slate-500 dark:text-slate-400">No backgrounds yet. Add one to enable the hero slideshow.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-5">
        <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-2">Tips</h4>
        <ul class="text-xs text-slate-600 dark:text-slate-400 space-y-1 list-disc list-inside">
            <li>Use <strong>16:9</strong> landscape images/videos for best results (1920×1080 recommended).</li>
            <li>Videos must be in <strong>MP4</strong> format and should be optimized for web.</li>
            <li>For video backgrounds, you can optionally set a <strong>poster</strong> image URL as a fallback.</li>
            <li>Use <strong>Order</strong> to control slide sequence. Lower numbers appear first.</li>
            <li>Free anime-style backgrounds: <a href="https://pexels.com/search/anime%20city/" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">Pexels</a>, <a href="https://unsplash.com/s/photos/anime-background" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">Unsplash</a>, <a href="https://www.vecteezy.com/free-videos/anime-city" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">Vecteezy</a></li>
        </ul>
    </div>
</x-admin-layout>
