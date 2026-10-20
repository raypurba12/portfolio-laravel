<x-admin-layout>
    <x-slot name="header">Visitor Notes</x-slot>
    <x-slot name="subheader">Approve notes before they appear on the public portfolio.</x-slot>
    <x-success-alert/>

    <div x-data="{ deleteModal: false, deleteId: null, deleteName: '' }">

    {{-- Filter tabs --}}
    <div class="flex flex-wrap gap-2 mb-5">
        @foreach([
            'all'      => 'All',
            'pending'  => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ] as $key => $label)
        <a href="{{ route('admin.visitor-notes.index', ['status' => $key]) }}"
           class="px-4 py-1.5 rounded-full text-sm font-medium transition-colors
                  {{ $status === $key ? 'bg-indigo-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-800 dark:hover:text-slate-200' }}">
            {{ $label }}
            <span class="ml-1 text-xs opacity-75">({{ $counts[$key] }})</span>
        </a>
        @endforeach
    </div>

    <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
        <div class="divide-y divide-slate-100 dark:divide-slate-700/60">
            @forelse($notes as $note)
            <div class="flex flex-col sm:flex-row items-start gap-3 sm:gap-4 px-4 sm:px-5 py-4 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors {{ $note->isPending() ? 'bg-amber-50/60 dark:bg-amber-500/5' : '' }}">
                {{-- Avatar --}}
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-cyan-100 dark:from-indigo-500/20 dark:to-cyan-500/20 border border-indigo-200 dark:border-indigo-500/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr($note->name, 0, 1)) }}
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="font-semibold text-slate-800 dark:text-slate-100 text-sm">{{ $note->name }}</p>
                        @if($note->isPending())
                        <span class="text-xs bg-amber-100 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 px-2 py-0.5 rounded-full font-medium">Pending</span>
                        @elseif($note->isApproved())
                        <span class="text-xs bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 px-2 py-0.5 rounded-full font-medium">Approved</span>
                        @else
                        <span class="text-xs bg-rose-100 dark:bg-rose-500/20 text-rose-700 dark:text-rose-400 px-2 py-0.5 rounded-full font-medium">Rejected</span>
                        @endif
                        <p class="text-xs text-slate-400 dark:text-slate-500 ml-auto hidden sm:block">{{ $note->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-1.5 leading-relaxed">{{ $note->message }}</p>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center mt-2 sm:mt-0">
                    @if(!$note->isApproved())
                    <form action="{{ route('admin.visitor-notes.approve', $note) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="text-xs font-medium bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-500/20 px-3 py-1.5 rounded-lg transition-colors inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Approve
                        </button>
                    </form>
                    @endif
                    @if(!$note->isRejected())
                    <form action="{{ route('admin.visitor-notes.reject', $note) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="text-xs font-medium bg-rose-50 dark:bg-rose-500/10 text-rose-700 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-500/20 px-3 py-1.5 rounded-lg transition-colors inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Reject
                        </button>
                    </form>
                    @endif
                    <button type="button"
                            @click="deleteModal = true; deleteId = {{ $note->id }}; deleteName = '{{ addslashes($note->name) }}'"
                            class="text-xs font-medium bg-slate-50 dark:bg-slate-700/40 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-600/40 hover:text-rose-600 dark:hover:text-rose-400 px-3 py-1.5 rounded-lg transition-colors">
                        Delete
                    </button>
                </div>
            </div>
            @empty
            <p class="py-16 text-center text-slate-500 dark:text-slate-400">No visitor notes found.</p>
            @endforelse
        </div>

        @if($notes->hasPages())
        <div class="p-4 border-t border-slate-200 dark:border-slate-700">
            {{ $notes->appends(request()->query())->links() }}
        </div>
        @endif
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
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Delete Visitor Note</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">This action cannot be undone.</p>
                </div>
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                Are you sure you want to delete the note from <span class="font-semibold text-slate-800 dark:text-white" x-text="deleteName"></span>?
            </p>
            <div class="flex items-center justify-end gap-3">
                <button type="button" @click="deleteModal = false"
                        class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                    Cancel
                </button>
                <form :action="'/admin/visitor-notes/' + deleteId" method="POST">
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