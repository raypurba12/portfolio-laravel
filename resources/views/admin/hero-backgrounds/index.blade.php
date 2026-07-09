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

    <x-admin-card>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">
                        <th class="pb-3 text-left">Preview</th>
                        <th class="pb-3 text-left">Type</th>
                        <th class="pb-3 text-left">URL</th>
                        <th class="pb-3 text-center">Active</th>
                        <th class="pb-3 text-center">Order</th>
                        <th class="pb-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700/50">
                    @forelse($backgrounds as $bg)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="py-3">
                            @if($bg->type === 'video')
                            <span class="text-xs text-purple-600 dark:text-purple-400 font-mono">[video]</span>
                            @else
                            <img src="{{ $bg->url }}" alt="" class="w-16 h-10 object-cover rounded border border-gray-300 dark:border-gray-600"
                                 onerror="this.style.display='none'">
                            @endif
                        </td>
                        <td class="py-3">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $bg->type === 'video' ? 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400' : 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400' }}">
                                {{ $bg->type }}
                            </span>
                        </td>
                        <td class="py-3">
                            <a href="{{ $bg->url }}" target="_blank" class="text-indigo-600 dark:text-purple-400 hover:underline text-xs truncate max-w-xs block">{{ $bg->url }}</a>
                            @if($bg->poster)
                            <span class="text-[10px] text-gray-500 dark:text-gray-500">poster: {{ $bg->poster }}</span>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $bg->is_active ? 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400' : 'bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-400' }}">
                                {{ $bg->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 text-center text-gray-600 dark:text-gray-400">{{ $bg->order }}</td>
                        <td class="py-3 text-right">
                            <a href="{{ route('admin.hero-backgrounds.edit', $bg) }}" class="text-indigo-600 dark:text-blue-400 hover:text-indigo-800 dark:hover:text-blue-300 mr-3">Edit</a>
                            <form action="{{ route('admin.hero-backgrounds.destroy', $bg) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this background?')" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="py-10 text-center text-gray-500 dark:text-gray-400">No backgrounds yet. Add one to enable the hero slideshow.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin-card>

    <div class="mt-6 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
        <h4 class="text-sm font-semibold text-gray-800 dark:text-white mb-2">Tips</h4>
        <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1 list-disc list-inside">
            <li>Use <strong>16:9</strong> landscape images/videos for best results (1920×1080 recommended).</li>
            <li>Videos must be in <strong>MP4</strong> format and should be optimized for web.</li>
            <li>For video backgrounds, you can optionally set a <strong>poster</strong> image URL as a fallback.</li>
            <li>Use <strong>Order</strong> to control slide sequence. Lower numbers appear first.</li>
            <li>Free anime-style backgrounds: <a href="https://pexels.com/search/anime%20city/" target="_blank" class="text-indigo-600 dark:text-purple-400 hover:underline">Pexels</a>, <a href="https://unsplash.com/s/photos/anime-background" target="_blank" class="text-indigo-600 dark:text-purple-400 hover:underline">Unsplash</a>, <a href="https://www.vecteezy.com/free-videos/anime-city" target="_blank" class="text-indigo-600 dark:text-purple-400 hover:underline">Vecteezy</a></li>
        </ul>
    </div>
</x-admin-layout>
