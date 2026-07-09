<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#6366f1">
    <title>{{ isset($header) ? $header . ' - ' : '' }}{{ config('app.name', 'Laravel') }} Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        #page-loading-bar {
            position: fixed; top: 0; left: 0; height: 3px; width: 0%;
            background: linear-gradient(90deg, #6366f1, #818cf8, #a5b4fc);
            z-index: 9999; transition: width 0.3s ease, opacity 0.3s ease;
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-enter { animation: fadeSlideUp 0.45s ease-out; }

        .sidebar-link {
            @apply flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200 text-slate-500 hover:text-slate-900 hover:bg-slate-100;
        }
        .sidebar-link.active {
            @apply bg-indigo-50 text-indigo-700 font-semibold;
        }
        .sidebar-link svg {
            @apply flex-shrink-0;
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800">

    <div id="page-loading-bar"></div>

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden bg-slate-50">

        <div x-show="sidebarOpen"
             x-cloak
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-sm lg:hidden">
        </div>

        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            @include('layouts.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-slate-50 to-white">
                <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">

                    @isset($header)
                        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 page-enter">
                            <div>
                                <h3 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900">
                                    {{ $header }}
                                </h3>
                                @isset($subheader)
                                    <p class="mt-1 text-sm text-slate-500">{{ $subheader }}</p>
                                @endisset
                            </div>
                            @isset($actions)
                                <div class="flex items-center gap-3">
                                    {{ $actions }}
                                </div>
                            @endisset
                        </div>
                    @endisset

                    @if (session('success'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 4000)"
                             x-transition
                             class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                            <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                            <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700">✕</button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-transition
                             class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 shadow-sm">
                            <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span>{{ session('error') }}</span>
                            <button @click="show = false" class="ml-auto text-red-500 hover:text-red-700">✕</button>
                        </div>
                    @endif

                    <div class="page-enter">
                        {{ $slot }}
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const bar = document.getElementById('page-loading-bar');
            bar.style.width = '70%';
            setTimeout(() => {
                bar.style.width = '100%';
                setTimeout(() => { bar.style.opacity = '0'; }, 200);
            }, 150);
        });
    </script>
</body>
</html>