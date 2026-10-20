<x-admin-layout>
    <x-slot name="header">Services</x-slot>
    <x-success-alert/>

    <div x-data="{ deleteModal: false, deleteId: null, deleteName: '' }">

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
                                <button type="button"
                                        @click="deleteModal = true; deleteId = {{ $service->id }}; deleteName = '{{ addslashes($service->name) }}'"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 rounded-lg transition-colors">Delete</button>
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
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Delete Service</h3>
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
                <form :action="'/admin/services/' + deleteId" method="POST">
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
