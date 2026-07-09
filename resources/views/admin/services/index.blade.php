<x-admin-layout>
    <x-slot name="header">Services</x-slot>
    <x-success-alert/>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Service
        </a>
    </div>
    <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80">
                    <th class="px-4 sm:px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Name</th>
                    <th class="px-4 sm:px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden sm:table-cell">Short Description</th>
                    <th class="px-4 sm:px-5 py-3.5 text-left text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Price</th>
                    <th class="px-4 sm:px-5 py-3.5 text-center text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Active</th>
                    <th class="px-4 sm:px-5 py-3.5 text-center text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Order</th>
                    <th class="px-4 sm:px-5 py-3.5 text-right text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr></thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                    @forelse($services as $service)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                        <td class="px-4 sm:px-5 py-3.5 font-medium text-slate-800 dark:text-slate-100">{{ $service->name }}</td>
                        <td class="px-4 sm:px-5 py-3.5 text-slate-500 dark:text-slate-400 max-w-xs truncate hidden sm:table-cell">{{ $service->short_description }}</td>
                        <td class="px-4 sm:px-5 py-3.5 text-slate-600 dark:text-slate-300">{{ $service->price ? 'Rp '.number_format($service->price,0,',','.') : '-' }}</td>
                        <td class="px-4 sm:px-5 py-3.5 text-center">
                            <span class="inline-flex px-2.5 py-0.5 text-xs font-medium rounded-full {{ $service->is_active ? 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-5 py-3.5 text-center text-slate-500 dark:text-slate-400">{{ $service->order }}</td>
                        <td class="px-4 sm:px-5 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 rounded-lg transition-colors">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete?')" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 rounded-lg transition-colors">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-5 py-16 text-center text-slate-500 dark:text-slate-400">No services yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
