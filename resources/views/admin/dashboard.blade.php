<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>

{{-- Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @php
        $cards = [
            ['label'=>'Projects',     'value'=>$totalProjects,       'color'=>'indigo', 'icon'=>'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            ['label'=>'Skills',       'value'=>$totalSkills,         'color'=>'violet', 'icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
            ['label'=>'Certificates', 'value'=>$totalCerts,          'color'=>'emerald','icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            ['label'=>'Services',     'value'=>$totalServices,       'color'=>'amber',  'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label'=>'Messages',     'value'=>$totalMessages,       'color'=>'blue',   'icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ['label'=>'Unread',       'value'=>$unreadMessages,      'color'=>'red',    'icon'=>'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
            ['label'=>'Visitor Notes', 'value'=>$totalVisitorNotes,   'color'=>'violet','icon'=>'M16 3h4a1 1 0 011 1v4M3 5a2 2 0 012-2h4m8 18h4a1 1 0 001-1v-4M6 19a2 2 0 01-2-2v-4m4-6h.01m3.99 0h.01M12 17h.01M8 17h.01M13 7h.01M17 7h.01M7 12h.01M17 12h.01'],
            ['label'=>'Pending Notes', 'value'=>$pendingVisitorNotes, 'color'=>'amber', 'icon'=>'M12 6v6m0 0l3-3m-3 3l-3-3m3 3v6M12 3a9 9 0 100 18 9 9 0 000-18z'],
        ];
        $colors = [
            'indigo'  => 'bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 border-indigo-200 dark:border-indigo-900',
            'violet'  => 'bg-violet-50 dark:bg-violet-950/50 text-violet-600 dark:text-violet-400 border-violet-200 dark:border-violet-900',
            'emerald' => 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-900',
            'amber'   => 'bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 border-amber-200 dark:border-amber-900',
            'blue'    => 'bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-900',
            'red'     => 'bg-red-50 dark:bg-red-950/50 text-red-600 dark:text-red-400 border-red-200 dark:border-red-900',
        ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl border flex items-center justify-center flex-shrink-0 {{ $colors[$card['color']] }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $card['value'] }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $card['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Recent Visitor Notes --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden mb-6">
        <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800 dark:text-white">Recent Visitor Notes</h3>
            <a href="{{ route('admin.visitor-notes.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Moderate →</a>
        </div>
        <div class="divide-y divide-slate-100 dark:divide-slate-800">
            @forelse($recentVisitorNotes as $note)
            <div class="flex items-start gap-3 px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-100 to-cyan-100 dark:from-indigo-900/40 dark:to-cyan-900/40 border border-indigo-200 dark:border-indigo-500/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm flex-shrink-0 mt-0.5">
                    {{ strtoupper(substr($note->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-200 truncate">{{ $note->name }}</p>
                        @if($note->isPending())
                        <span class="text-[10px] font-semibold bg-amber-100 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 px-2 py-0.5 rounded-full">Pending</span>
                        @elseif($note->isApproved())
                        <span class="text-[10px] font-semibold bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 px-2 py-0.5 rounded-full">Approved</span>
                        @else
                        <span class="text-[10px] font-semibold bg-rose-100 dark:bg-rose-500/20 text-rose-700 dark:text-rose-400 px-2 py-0.5 rounded-full">Rejected</span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">{{ $note->message }}</p>
                </div>
                <p class="text-xs text-slate-400 dark:text-slate-500 flex-shrink-0 mt-0.5">
                    {{ $note->created_at->diffForHumans() }}
                </p>
            </div>
            @empty
            <p class="px-5 py-10 text-center text-sm text-slate-400 dark:text-slate-500">No visitor notes yet.</p>
            @endforelse
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Messages --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="font-semibold text-slate-800 dark:text-white">Recent Messages</h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">View all →</a>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($recentContacts as $contact)
                <a href="{{ route('admin.contacts.show', $contact) }}"
                   class="flex items-start gap-3 px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm flex-shrink-0 mt-0.5">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-medium text-slate-800 dark:text-slate-200 truncate">{{ $contact->name }}</p>
                            @if($contact->status === 'unread')
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full flex-shrink-0"></span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">
                            {{ $contact->subject ?? Str::limit($contact->message, 50) }}
                        </p>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500 flex-shrink-0 mt-0.5">
                        {{ $contact->created_at->diffForHumans() }}
                    </p>
                </a>
                @empty
                <p class="px-5 py-10 text-center text-sm text-slate-400 dark:text-slate-500">No messages yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800">
                <h3 class="font-semibold text-slate-800 dark:text-white">Quick Actions</h3>
            </div>
            <div class="grid grid-cols-2 gap-px bg-slate-100 dark:bg-slate-800">
                @php
                $actions = [
                    ['label'=>'Add Project',    'href'=>route('admin.projects.create'),     'color'=>'text-indigo-600 dark:text-indigo-400',  'bg'=>'hover:bg-indigo-50 dark:hover:bg-indigo-950/40'],
                    ['label'=>'Add Skill',      'href'=>route('admin.skills.create'),       'color'=>'text-violet-600 dark:text-violet-400',  'bg'=>'hover:bg-violet-50 dark:hover:bg-violet-950/40'],
                    ['label'=>'Add Experience', 'href'=>route('admin.experience.create'),   'color'=>'text-emerald-600 dark:text-emerald-400','bg'=>'hover:bg-emerald-50 dark:hover:bg-emerald-950/40'],
                    ['label'=>'Add Certificate','href'=>route('admin.certificates.create'), 'color'=>'text-amber-600 dark:text-amber-400',   'bg'=>'hover:bg-amber-50 dark:hover:bg-amber-950/40'],
                    ['label'=>'Add Service',    'href'=>route('admin.services.create'),     'color'=>'text-blue-600 dark:text-blue-400',     'bg'=>'hover:bg-blue-50 dark:hover:bg-blue-950/40'],
                    ['label'=>'Moderate Notes', 'href'=>route('admin.visitor-notes.index'),'color'=>'text-amber-600 dark:text-amber-400',    'bg'=>'hover:bg-amber-50 dark:hover:bg-amber-950/40'],
                    ['label'=>'Site Settings',  'href'=>route('admin.settings.index'),      'color'=>'text-slate-600 dark:text-slate-400',   'bg'=>'hover:bg-slate-50 dark:hover:bg-slate-800/60'],
                ];
                @endphp
                @foreach($actions as $action)
                <a href="{{ $action['href'] }}"
                   class="bg-white dark:bg-slate-900 px-5 py-4 flex items-center gap-3 transition-colors {{ $action['bg'] }}">
                    <svg class="w-4 h-4 {{ $action['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="text-sm font-medium {{ $action['color'] }}">{{ $action['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-admin-layout>
