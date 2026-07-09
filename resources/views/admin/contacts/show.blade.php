<x-admin-layout>
    <x-slot name="header">Message Detail</x-slot>
    <x-slot name="actions">
        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300">← Back to messages</a>
    </x-slot>
    <x-success-alert/>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Message --}}
        <div class="lg:col-span-2 space-y-5">
            <x-admin-card>
                <div class="flex items-start gap-4 mb-5">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-lg flex-shrink-0">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-slate-900 dark:text-white text-lg">{{ $contact->name }}</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $contact->email }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">{{ $contact->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="ml-auto flex-shrink-0">
                        @if($contact->isReplied())
                        <span class="bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs px-3 py-1 rounded-full font-medium">Replied</span>
                        @elseif($contact->isRead())
                        <span class="bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 text-xs px-3 py-1 rounded-full font-medium">Read</span>
                        @else
                        <span class="bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 text-xs px-3 py-1 rounded-full font-medium">Unread</span>
                        @endif
                    </div>
                </div>

                @if($contact->subject)
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Subject: {{ $contact->subject }}</p>
                @endif

                <div class="bg-slate-50 dark:bg-slate-700/40 rounded-xl p-4 text-slate-700 dark:text-slate-200 text-sm leading-relaxed whitespace-pre-line">
                    {{ $contact->message }}
                </div>
            </x-admin-card>

            {{-- Previous reply if any --}}
            @if($contact->reply)
            <x-admin-card>
                <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-3">Your Reply · {{ $contact->replied_at?->format('d M Y, H:i') }}</p>
                <div class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-xl p-4 text-slate-700 dark:text-slate-200 text-sm leading-relaxed whitespace-pre-line">
                    {{ $contact->reply }}
                </div>
            </x-admin-card>
            @endif

            {{-- Reply form --}}
            @unless($contact->isReplied())
            <x-admin-card>
                <p class="font-semibold text-slate-900 dark:text-white mb-4">Send Reply</p>
                <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}">
                    @csrf
                    <textarea name="reply" rows="5" required
                        class="block w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-3 text-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:outline-none transition-colors placeholder-slate-400 dark:placeholder-slate-500"
                        placeholder="Type your reply here...">{{ old('reply') }}</textarea>
                    <x-input-error :messages="$errors->get('reply')" class="mt-2"/>
                    <div class="flex gap-3 mt-4">
                        <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Send Reply
                        </button>
                        <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 text-sm text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Back</a>
                    </div>
                </form>
            </x-admin-card>
            @else
            <div class="text-center">
                <a href="{{ route('admin.contacts.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">← Back to messages</a>
            </div>
            @endunless
        </div>

        {{-- Sidebar info --}}
        <div>
            <x-admin-card>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-4">Sender Info</p>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-slate-400 dark:text-slate-500 text-xs">Name</p>
                        <p class="text-slate-800 dark:text-slate-200">{{ $contact->name }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 dark:text-slate-500 text-xs">Email</p>
                        <a href="mailto:{{ $contact->email }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ $contact->email }}</a>
                    </div>
                    @if($contact->ip_address)
                    <div>
                        <p class="text-slate-400 dark:text-slate-500 text-xs">IP Address</p>
                        <p class="text-slate-800 dark:text-slate-200 font-mono text-xs">{{ $contact->ip_address }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-slate-400 dark:text-slate-500 text-xs">Received</p>
                        <p class="text-slate-800 dark:text-slate-200">{{ $contact->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="mt-5 pt-5 border-t border-slate-200 dark:border-slate-700 space-y-2">
                    <a href="mailto:{{ $contact->email }}"
                       class="flex items-center justify-center gap-2 w-full bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 text-sm font-medium py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Open in Email App
                    </a>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this message permanently?')"
                                class="flex items-center justify-center gap-2 w-full bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 text-rose-600 dark:text-rose-400 text-sm font-medium py-2 rounded-lg transition-colors">
                            Delete Message
                        </button>
                    </form>
                </div>
            </x-admin-card>
        </div>
    </div>
</x-admin-layout>
