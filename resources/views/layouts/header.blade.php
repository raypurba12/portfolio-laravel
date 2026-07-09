<header class="flex items-center justify-between h-16 px-4 sm:px-6 bg-white border-b border-slate-200">

    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors duration-150 lg:hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        @isset($header)
        <div class="hidden sm:flex items-center gap-1.5 text-sm text-slate-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Admin</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-800 font-medium">{{ $header }}</span>
        </div>
        @endisset
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('home') }}" target="_blank"
           class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-colors duration-150">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Site
        </a>

        <div class="w-px h-6 bg-slate-200 mx-1"></div>

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-100 transition-colors duration-150">
                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
