<x-admin-layout>
    <x-slot name="header">Social Media</x-slot>
    <x-success-alert/>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.social-media.create') }}" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">+ Add Link</a>
    </div>
    <x-admin-card>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-gray-700 text-gray-400 text-xs uppercase tracking-wider">
                    <th class="pb-3 text-left">Platform</th>
                    <th class="pb-3 text-left">URL</th>
                    <th class="pb-3 text-center">Active</th>
                    <th class="pb-3 text-center">Order</th>
                    <th class="pb-3 text-right">Actions</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse($socials as $social)
                    <tr class="hover:bg-gray-700/30 transition-colors">
                        <td class="py-3">
                            <p class="font-medium text-white capitalize">{{ $social->platform }}</p>
                            <p class="text-xs text-gray-400">{{ $social->label }}</p>
                        </td>
                        <td class="py-3">
                            <a href="{{ $social->url }}" target="_blank" class="text-purple-400 hover:underline text-xs truncate max-w-xs block">{{ $social->url }}</a>
                        </td>
                        <td class="py-3 text-center">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $social->is_active ? 'bg-green-500/20 text-green-400' : 'bg-gray-600 text-gray-400' }}">
                                {{ $social->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 text-center text-gray-400">{{ $social->order }}</td>
                        <td class="py-3 text-right">
                            <a href="{{ route('admin.social-media.edit', $social) }}" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                            <form action="{{ route('admin.social-media.destroy', $social) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete?')" class="text-red-400 hover:text-red-300">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-10 text-center text-gray-500">No social media links yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin-card>
</x-admin-layout>
