<x-admin-layout>
    <x-slot name="header">Contact Messages</x-slot>
    <x-success-alert/>

    <div x-data="{ deleteModal: false, deleteId: null, deleteName: '' }">

    {{-- Filter tabs --}}
    <div class="flex flex-wrap gap-2 mb-5">
        @foreach(['all' => 'All', 'unread' => 'Unread', 'read' => 'Read', 'replied' => 'Replied'] as $key => $label)
        <a href="{{ route('admin.contacts.index', ['status' => $key]) }}"
           class="px-4 py-1.5 rounded-full text-sm font-medium transition-colors
                  {{ $status === $key ? 'bg-indigo-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-800 dark:hover:text-slate-200' }}">
            {{ $label }}
            <span class="ml-1 text-xs opacity-75">({{ $counts[$key] }})</span>
        </a>
        @endforeach
    </div>

    <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
        <div class="divide-y divide-slate-100 dark:divide-slate-700/60">
            @forelse($contacts as $contact)
            <div class="flex flex-col sm:flex-row items-start gap-3 sm:gap-4 px-4 sm:px-5 py-4 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors {{ $contact->isUnread() ? 'bg-indigo-50/50 dark:bg-indigo-500/5' : '' }}">
                {{-- Avatar --}}
                <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                </div>
                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="font-semibold text-slate-800 dark:text-slate-100 text-sm">{{ $contact->name }}</p>
                        @if($contact->isUnread())
                        <span class="text-xs bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 px-2 py-0.5 rounded-full font-medium">Unread</span>
                        @elseif($contact->isReplied())
                        <span class="text-xs bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 px-2 py-0.5 rounded-full font-medium">Replied</span>
                        @else
                        <span class="text-xs bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 px-2 py-0.5 rounded-full">Read</span>
                        @endif
                        <p class="text-xs text-slate-400 dark:text-slate-500 ml-auto hidden sm:block">{{ $contact->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $contact->email }} {{ $contact->subject ? '· '.$contact->subject : '' }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-1 line-clamp-2">{{ $contact->message }}</p>
                </div>
                {{-- Actions --}}
                <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center mt-2 sm:mt-0">
                    <a href="{{ route('admin.contacts.show', $contact) }}"
                       class="text-xs font-medium bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 px-3 py-1.5 rounded-lg transition-colors">
                        View
                    </a>
                    <button type="button"
                            @click="deleteModal = true; deleteId = {{ $contact->id }}; deleteName = '{{ addslashes($contact->name) }}'"
                            class="text-xs font-medium bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-500/20 px-3 py-1.5 rounded-lg transition-colors">
                        Delete
                    </button>
                </div>
            </div>
            @empty
            <p class="py-16 text-center text-slate-500 dark:text-slate-400">No messages found.</p>
            @endforelse
        </div>

        @if($contacts->hasPages())
        <div class="p-4 border-t border-slate-200 dark:border-slate-700">
            {{ $contacts->appends(request()->query())->links() }}
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
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Delete Message</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">This action cannot be undone.</p>
                </div>
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">
                Are you sure you want to delete the message from <span class="font-semibold text-slate-800 dark:text-white" x-text="deleteName"></span>?
            </p>
            <div class="flex items-center justify-end gap-3">
                <button type="button" @click="deleteModal = false"
                        class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                    Cancel
                </button>
                <form :action="'/admin/contacts/' + deleteId" method="POST">
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
