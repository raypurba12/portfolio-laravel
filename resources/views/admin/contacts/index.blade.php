<x-admin-layout>
    <x-slot name="header">Contact Messages</x-slot>
    <x-success-alert/>

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
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this message?')"
                                class="text-xs font-medium bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-500/20 px-3 py-1.5 rounded-lg transition-colors">
                            Delete
                        </button>
                    </form>
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
</x-admin-layout>
