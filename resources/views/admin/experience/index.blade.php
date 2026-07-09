<x-admin-layout>
    <x-slot name="header">Experience</x-slot>
    <x-success-alert/>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.experience.create') }}"
           class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
            + Add Experience
        </a>
    </div>

    <x-admin-card>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-700 text-gray-400 text-xs uppercase tracking-wider">
                        <th class="pb-3 text-left">Company / Position</th>
                        <th class="pb-3 text-left">Period</th>
                        <th class="pb-3 text-left">Location</th>
                        <th class="pb-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse($experiences as $exp)
                    <tr class="hover:bg-gray-700/30 transition-colors">
                        <td class="py-3">
                            <div class="flex items-center gap-3">
                                @if($exp->logo_path)
                                <img src="{{ asset('storage/' . str_replace('public/', '', $exp->logo_path)) }}" class="w-8 h-8 rounded object-contain bg-gray-700 p-1">
                                @else
                                <div class="w-8 h-8 rounded bg-purple-500/20 flex items-center justify-center text-purple-400 text-xs font-bold">{{ substr($exp->company,0,2) }}</div>
                                @endif
                                <div>
                                    <p class="font-medium text-white">{{ $exp->company }}</p>
                                    <p class="text-gray-400 text-xs">{{ $exp->position }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 text-gray-300">
                            {{ $exp->start_date->format('M Y') }} —
                            {{ $exp->is_current ? 'Present' : ($exp->end_date?->format('M Y') ?? '-') }}
                        </td>
                        <td class="py-3 text-gray-400">{{ $exp->location ?? '-' }}</td>
                        <td class="py-3 text-right">
                            <a href="{{ route('admin.experience.edit', $exp) }}" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                            <form action="{{ route('admin.experience.destroy', $exp) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Delete this experience?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-10 text-center text-gray-500">No experience added yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin-card>
</x-admin-layout>
