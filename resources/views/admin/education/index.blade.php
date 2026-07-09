<x-admin-layout>
    <x-slot name="header">Education</x-slot>
    <x-success-alert/>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.education.create') }}" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">+ Add Education</a>
    </div>
    <x-admin-card>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-gray-700 text-gray-400 text-xs uppercase tracking-wider">
                    <th class="pb-3 text-left">Institution</th>
                    <th class="pb-3 text-left">Degree / Field</th>
                    <th class="pb-3 text-left">Period</th>
                    <th class="pb-3 text-right">Actions</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse($educations as $edu)
                    <tr class="hover:bg-gray-700/30 transition-colors">
                        <td class="py-3">
                            <div class="flex items-center gap-3">
                                @if($edu->logo_path)
                                <img src="{{ asset('storage/' . str_replace('public/', '', $edu->logo_path)) }}" class="w-8 h-8 rounded object-contain bg-gray-700 p-1">
                                @else
                                <div class="w-8 h-8 rounded bg-blue-500/20 flex items-center justify-center text-blue-400 text-xs font-bold">{{ substr($edu->institution,0,2) }}</div>
                                @endif
                                <p class="font-medium text-white">{{ $edu->institution }}</p>
                            </div>
                        </td>
                        <td class="py-3 text-gray-300">{{ $edu->degree }} {{ $edu->field_of_study ? '— '.$edu->field_of_study : '' }}</td>
                        <td class="py-3 text-gray-400">{{ $edu->start_year }} — {{ $edu->is_current ? 'Present' : ($edu->end_year ?? '-') }}</td>
                        <td class="py-3 text-right">
                            <a href="{{ route('admin.education.edit', $edu) }}" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                            <form action="{{ route('admin.education.destroy', $edu) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-10 text-center text-gray-500">No education added yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin-card>
</x-admin-layout>
