<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $header ?? ($settings['site_title'] ?? config('app.name', 'Portfolio')) }}</title>
    <meta property="og:title" content="{{ $header ?? ($settings['site_title'] ?? config('app.name', 'Portfolio')) }}">
    <meta name="twitter:title" content="{{ $header ?? ($settings['site_title'] ?? config('app.name', 'Portfolio')) }}">
    @if(!empty($settings['favicon_path']))
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($settings['favicon_path']) }}">
    <link rel="apple-touch-icon" href="{{ Storage::url($settings['favicon_path']) }}">
    @endif
    @if(!empty($settings['site_description']))
    <meta name="description" content="{{ $settings['site_description'] }}">
    <meta property="og:description" content="{{ $settings['site_description'] }}">
    <meta name="twitter:description" content="{{ $settings['site_description'] }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Orbitron:wght@400;700;900&display=swap&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Orbitron:wght@400;700;900&display=swap&display=swap" rel="stylesheet"></noscript>
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"></noscript>
    @if(!empty($settings['google_analytics']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics'] }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $settings['google_analytics'] }}');</script>
    @endif
    <style>
        :root { color-scheme: dark; }
        body { font-family: 'Space Grotesk', sans-serif; background: #030712; color: #f3f4f6; }
        @media (pointer:fine) { body { cursor: none; } }
        .font-orbitron { font-family: 'Orbitron', monospace; }

        /* ── Glitch ── */
        .glitch { position: relative; }
        .glitch::before, .glitch::after {
            content: attr(data-text);
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
        }
        .glitch::before {
            animation: glitch-1 3s infinite;
            color: #a855f7;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
        }
        .glitch::after {
            animation: glitch-2 3s infinite;
            color: #06b6d4;
            clip-path: polygon(0 55%, 100% 55%, 100% 100%, 0 100%);
        }
        @keyframes glitch-1 {
            0%,100%{transform:translateX(-3px);opacity:1}
            20%{transform:translateX(3px);opacity:.8}
            40%{transform:translateX(-2px)}
            60%{transform:translateX(2px);opacity:.9}
            80%{transform:translateX(0)}
        }
        @keyframes glitch-2 {
            0%,100%{transform:translateX(3px);opacity:1}
            20%{transform:translateX(-3px);opacity:.8}
            40%{transform:translateX(2px)}
            60%{transform:translateX(-2px);opacity:.9}
            80%{transform:translateX(0)}
        }

        /* ── Cyber Grid ── */
        .cyber-grid {
            background-image:
                linear-gradient(rgba(168,85,247,.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(168,85,247,.07) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* ── Particles ── */
        .particle {
            position: absolute; border-radius: 50%;
            animation: float-particle linear infinite;
            pointer-events: none;
            will-change: transform;
        }
        @keyframes float-particle {
            0%   { transform: translateY(100vh) rotate(0deg);   opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 1; }
            100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
        }

        /* ── Hologram rings ── */
        .hologram-ring   { animation: rotate-ring 8s linear infinite; }
        .hologram-ring-2 { animation: rotate-ring 12s linear infinite reverse; }
        @keyframes rotate-ring { to { transform: rotate(360deg); } }

        /* ── Cyber card ── */
        .cyber-card { position: relative; overflow: hidden; transition: all .4s cubic-bezier(.175,.885,.32,1.275); }
        .cyber-card::before {
            content:''; position: absolute; inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(168,85,247,.1) 100%);
            opacity: 0; transition: opacity .3s;
        }
        .cyber-card:hover::before { opacity: 1; }
        .cyber-card::after {
            content:''; position: absolute; top: 0; left: -100%; width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.08), transparent);
            transition: left .5s;
        }
        .cyber-card:hover::after { left: 150%; }
        .cyber-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(168,85,247,.2); }

        /* ── Scanlines ── */
        .scanlines::after {
            content:''; position: absolute; inset: 0; pointer-events: none; z-index: 1;
            background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,.03) 2px, rgba(0,0,0,.03) 4px);
        }

        /* ── Cyber divider ── */
        .cyber-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #a855f7, #06b6d4, transparent);
        }

        /* ── Robot pulse ── */
        @keyframes robot-pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(168,85,247,.7); }
            50%      { box-shadow: 0 0 0 14px rgba(168,85,247,0); }
        }
        .robot-pulse { animation: robot-pulse 2s infinite; }

        /* ── Scrollbar ── */
        .chat-scroll { scrollbar-width: thin; scrollbar-color: #7c3aed #1f2937; }
        .chat-scroll::-webkit-scrollbar { width: 4px; }
        .chat-scroll::-webkit-scrollbar-track { background: #1f2937; }
        .chat-scroll::-webkit-scrollbar-thumb { background: #7c3aed; border-radius: 4px; }

        /* ── Custom Cursor ── */
        .cyber-cursor-dot, .cyber-cursor-ring {
            position: fixed; top: 0; left: 0; pointer-events: none; z-index: 99999;
            border-radius: 50%; will-change: transform;
            transition: width .25s, height .25s, background .25s, border-color .25s;
        }
        .cyber-cursor-dot {
            width: 6px; height: 6px; background: #a855f7;
            box-shadow: 0 0 10px #a855f7, 0 0 20px rgba(168,85,247,.4);
        }
        .cyber-cursor-ring {
            width: 36px; height: 36px; border: 2px solid rgba(168,85,247,.6);
            box-shadow: 0 0 15px rgba(168,85,247,.2), inset 0 0 10px rgba(168,85,247,.1);
        }
        .cyber-cursor-dot.is-hover { width: 10px; height: 10px; background: #06b6d4; box-shadow: 0 0 15px #06b6d4; }
        .cyber-cursor-ring.is-hover { width: 52px; height: 52px; border-color: #06b6d4; background: rgba(6,182,212,.08); }

        /* ── Preloader Boot-up ── */
        .boot-preloader {
            position: fixed; inset: 0; z-index: 99998;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            background: #030712; color: #a855f7;
            font-family: 'Orbitron', monospace;
            transition: opacity .6s ease, visibility .6s ease;
        }
        .boot-preloader.is-hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        .boot-logo { font-size: 1.8rem; font-weight: 900; letter-spacing: 4px; margin-bottom: 2rem;
            background: linear-gradient(90deg,#a855f7,#06b6d4,#a855f7); background-size: 200% auto;
            -webkit-background-clip: text; background-clip: text; color: transparent; animation: shimmer 3s linear infinite; }
        .boot-lines { width: 320px; max-width: 80vw; }
        .boot-line { font-size: .75rem; color: rgba(168,85,247,.7); opacity: 0;
            animation: bootType .4s ease forwards; animation-delay: var(--d); }
        .boot-line::after { content: '▌'; animation: blinkCursor .7s step-end infinite; }
        @keyframes bootType { to { opacity: 1; } }
        @keyframes blinkCursor { 0%,100% { opacity: 1; } 50% { opacity: 0; } }
        .boot-bar { margin-top: 1.5rem; width: 320px; max-width: 80vw; height: 3px;
            background: rgba(168,85,247,.2); border-radius: 3px; overflow: hidden; }
        .boot-bar-fill { height: 100%; width: 0; border-radius: 3px;
            background: linear-gradient(90deg,#a855f7,#06b6d4);
            animation: bootFill 2.2s ease forwards; }
        @keyframes bootFill { 0% { width: 0; } 30% { width: 30%; } 70% { width: 75%; } 100% { width: 100%; } }

        /* ── Glitch-in Heading ── */
        .glitch-heading { position: relative; }
        .glitch-heading::before, .glitch-heading::after {
            content: attr(data-text); position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: 0; transition: opacity .3s;
        }
        .glitch-heading.in-view::before {
            opacity: 1; color: #a855f7;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
            animation: glitchBefore .6s ease forwards;
        }
        .glitch-heading.in-view::after {
            opacity: 1; color: #06b6d4;
            clip-path: polygon(0 55%, 100% 55%, 100% 100%, 0 100%);
            animation: glitchAfter .6s ease forwards;
        }
        @keyframes glitchBefore {
            0% { transform: translateX(-8px); opacity: 0; }
            30% { transform: translateX(4px); opacity: .8; }
            60% { transform: translateX(-2px); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }
        @keyframes glitchAfter {
            0% { transform: translateX(8px); opacity: 0; }
            30% { transform: translateX(-4px); opacity: .8; }
            60% { transform: translateX(2px); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

{{-- ══════════════════════════════════════════════════════
     PRELOADER BOOT-UP
╘═════════════════════════════════════════════════════════ --}}
<div class="boot-preloader"
     x-data="{ hidden: false }"
     x-init="window.addEventListener('load', () => { setTimeout(() => hidden = true, 2200); })"
     :class="{ 'is-hidden': hidden }">
    <div class="boot-logo">{{ strtoupper($settings['site_title'] ?? 'PORTFOLIO') }}</div>
    <div class="boot-lines">
        <div class="boot-line" style="--d:0s">&gt; initializing system core...</div>
        <div class="boot-line" style="--d:.6s">&gt; loading assets &amp; modules...</div>
        <div class="boot-line" style="--d:1.2s">&gt; access granted. welcome.</div>
    </div>
    <div class="boot-bar"><div class="boot-bar-fill"></div></div>
</div>

<!-- ═══════════════════════════════════════════
     NAVBAR
════════════════════════════════════════════ -->
<header x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
        :class="scrolled ? 'bg-gray-950/90 backdrop-blur-xl border-b border-purple-500/20 shadow-lg shadow-purple-500/10' : 'bg-transparent'"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-500">

    <nav class="container mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
            @if(!empty($settings['logo_path']))
            <img src="{{ Storage::url($settings['logo_path']) }}" alt="{{ $settings['site_title'] ?? 'Portfolio' }}"
                 class="h-8 w-auto object-contain drop-shadow-lg group-hover:scale-105 transition-transform duration-300">
            @else
            <span class="font-orbitron text-xl font-black tracking-wider">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">PORT</span><!--
             --><span class="text-white group-hover:text-purple-200 transition-colors">FOLIO</span>
            </span>
            @endif
        </a>

        <!-- Desktop links -->
        <div class="hidden md:flex items-center gap-1">
            @foreach(['home' => '#home', 'about' => '#about','services' => '#services','skills' => '#skills', 'projects' => '#projects', 'contact' => '#contact'] as $label => $target)
            <a href="{{ route('home').$target }}"
               class="relative px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition-colors group capitalize">
                {{ $label }}
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-purple-400 to-cyan-400 group-hover:w-3/4 transition-all duration-300 rounded-full"></span>
            </a>
            @endforeach
        </div>

        <!-- Mobile hamburger -->
        <button @click="open = !open" class="md:hidden p-2 text-gray-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </nav>

    <!-- Mobile menu -->
    <div x-show="open"
         x-transition:enter="transition duration-200 ease-out"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition duration-150 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="md:hidden bg-gray-950/98 backdrop-blur-xl border-t border-purple-500/20 px-6 py-4 space-y-1">
        <a href="{{ route('home') }}#home"    @click="open=false" class="block py-2 px-3 text-gray-300 hover:text-purple-400 hover:bg-purple-500/10 rounded-lg transition-all">Home</a>
        <a href="{{ route('home') }}#about"   @click="open=false" class="block py-2 px-3 text-gray-300 hover:text-purple-400 hover:bg-purple-500/10 rounded-lg transition-all">About</a>
        <a href="{{ route('home') }}#services"   @click="open=false" class="block py-2 px-3 text-gray-300 hover:text-purple-400 hover:bg-purple-500/10 rounded-lg transition-all">My services</a>
        <a href="{{ route('home') }}#skills"  @click="open=false" class="block py-2 px-3 text-gray-300 hover:text-purple-400 hover:bg-purple-500/10 rounded-lg transition-all">Skills</a>
        <a href="{{ route('home') }}#projects" @click="open=false" class="block py-2 px-3 text-gray-300 hover:text-purple-400 hover:bg-purple-500/10 rounded-lg transition-all">Projects</a>
        <a href="{{ route('home') }}#contact" @click="open=false" class="block py-2 px-3 text-gray-300 hover:text-purple-400 hover:bg-purple-500/10 rounded-lg transition-all">Contact</a>
    </div>
</header>

<!-- Page Content -->
<main>{{ $slot }}</main>

<!-- ═══════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ -->
<footer class="relative bg-gray-950 border-t border-purple-500/20 py-10 overflow-hidden">
    <div class="cyber-grid absolute inset-0 opacity-30 pointer-events-none"></div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <p class="font-orbitron text-sm text-gray-500 tracking-wider">
            &copy; {{ date('Y') }} &mdash; {{ $settings['site_footer'] ?? 'Built with' }}
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400 font-bold">♥ Laravel</span>
        </p>
    </div>
</footer>

<!-- ═══════════════════════════════════════════
     AI CHATBOT — fixed bottom-right
════════════════════════════════════════════ -->
<div x-data="chatbot()" class="fixed bottom-6 right-6 z-[9999] flex flex-col items-end gap-3">

    <!-- ── Chat Window ── -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
         style="display:none"
         class="w-80 sm:w-96 rounded-2xl overflow-hidden border border-purple-500/30 shadow-2xl shadow-purple-900/40"
         @click.away="open = false">

        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-700 to-cyan-700 px-4 py-3 flex items-center gap-3">
            <div class="relative flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 text-2xl select-none">🤖</span>
                <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full bg-green-400 ring-2 ring-gray-900"></span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-orbitron text-white text-sm font-bold truncate">AI Assistant</p>
                <p class="text-white/70 text-xs">Online · Siap membantu</p>
            </div>
            <!-- Close button — stops propagation so @click.away doesn't re-fire -->
            <button @click.stop="open = false"
                    class="flex-shrink-0 text-white/70 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Messages -->
        <div x-ref="chatBody"
             class="chat-scroll h-72 overflow-y-auto bg-gray-900 p-4 flex flex-col gap-3">

            <template x-for="(msg, idx) in messages" :key="idx">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.role === 'user'
                            ? 'bg-gradient-to-br from-purple-600 to-purple-800 text-white rounded-2xl rounded-tr-sm'
                            : 'bg-gray-800 border border-purple-500/20 text-gray-200 rounded-2xl rounded-tl-sm'"
                         class="max-w-[85%] px-4 py-2.5 text-sm leading-relaxed">
                        <p x-text="msg.text" class="break-words whitespace-pre-line"></p>
                        <p class="text-xs mt-1 opacity-60" x-text="msg.time"></p>
                    </div>
                </div>
            </template>

            <!-- Typing indicator -->
            <div x-show="loading" class="flex justify-start">
                <div class="bg-gray-800 border border-purple-500/20 rounded-2xl rounded-tl-sm px-4 py-3">
                    <div class="flex gap-1.5 items-center h-4">
                        <span class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay:0ms"></span>
                        <span class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay:150ms"></span>
                        <span class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay:300ms"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input -->
        <div class="bg-gray-900 border-t border-purple-500/20 p-3">
            <form @submit.prevent="send()" class="flex gap-2">
                <input x-model="input"
                       @keydown.enter.prevent="send()"
                       type="text"
                       placeholder="Ketik pesan..."
                       autocomplete="off"
                       class="flex-1 bg-gray-800 border border-purple-500/30 focus:border-purple-400 rounded-xl px-3 py-2 text-sm text-gray-200 placeholder-gray-500 outline-none transition-colors">
                <button type="submit"
                        :disabled="loading || !input.trim()"
                        class="bg-gradient-to-r from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 disabled:opacity-40 disabled:cursor-not-allowed text-white p-2.5 rounded-xl transition-all duration-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                    </svg>
                </button>
            </form>
            <p class="text-center text-xs text-gray-600 mt-2 font-orbitron tracking-widest">AI PORTFOLIO ASSISTANT</p>
        </div>
    </div>

    <!-- ── FAB Toggle Button ── -->
    <button @click="open = !open"
            class="robot-pulse relative w-14 h-14 rounded-full bg-gradient-to-br from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 flex items-center justify-center shadow-xl shadow-purple-500/30 transition-all duration-300 hover:scale-110 select-none focus:outline-none">

        <!-- Robot icon (closed state) -->
        <svg x-show="!open"
             xmlns="http://www.w3.org/2000/svg"
             class="w-7 h-7 text-white pointer-events-none"
             fill="none" viewBox="0 0 640 512">
            <path fill="currentColor" d="M320 0c17.7 0 32 14.3 32 32V96H472c39.8 0 72 32.2 72 72V440c0 39.8-32.2 72-72 72H168c-39.8 0-72-32.2-72-72V168c0-39.8 32.2-72 72-72H288V32c0-17.7 14.3-32 32-32zM208 352c-17.7 0-32 14.3-32 32s14.3 32 32 32h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H208zm192 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H400zM264 224a40 40 0 1 0 -80 0 40 40 0 1 0 80 0zm152 40a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/>
        </svg>

        <!-- X icon (open state) -->
        <svg x-show="open"
             xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 text-white pointer-events-none"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>

        <!-- Online dot -->
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-gray-950 animate-pulse pointer-events-none"></span>
    </button>
</div>



<div class="cyber-cursor-dot" id="cyberCursorDot"></div>
<div class="cyber-cursor-ring" id="cyberCursorRing"></div>

<script>
(function(){
    if (!window.matchMedia('(pointer:fine)').matches) return;
    const dot = document.getElementById('cyberCursorDot');
    const ring = document.getElementById('cyberCursorRing');
    let mx = 0, my = 0, rx = 0, ry = 0;
    window.addEventListener('mousemove', e => {
        mx = e.clientX; my = e.clientY;
        dot.style.transform = `translate(${mx}px, ${my}px) translate(-50%,-50%)`;
    });
    function loop(){
        rx += (mx - rx) * 0.18;
        ry += (my - ry) * 0.18;
        ring.style.transform = `translate(${rx}px, ${ry}px) translate(-50%,-50%)`;
        requestAnimationFrame(loop);
    }
    loop();
    document.addEventListener('mouseover', e => {
        if (e.target.closest('a, button, .cyber-card, [role="button"], input, textarea')) {
            dot.classList.add('is-hover');
            ring.classList.add('is-hover');
        }
    });
    document.addEventListener('mouseout', e => {
        if (e.target.closest('a, button, .cyber-card, [role="button"], input, textarea')) {
            dot.classList.remove('is-hover');
            ring.classList.remove('is-hover');
        }
    });
})();
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });
    document.querySelectorAll('.glitch-heading').forEach(el => io.observe(el));
});
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
<script defer>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({ once: true, duration: 800, easing: 'ease-out-cubic' });
    });
</script>
</body>
</html>
