<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $metaTitle = $seoTitle ?? ($header ?? ($settings['site_title'] ?? config('app.name', 'Portfolio')));
        $metaDescription = $seoDescription ?? ($settings['site_description'] ?? '');
        $metaKeywords = $seoKeywords ?? ($settings['site_keywords'] ?? '');

        // Canonical URL
        $canonicalUrl = $canonicalUrl ?? request()->url();

        // Open Graph / Social Sharing Image
        $ogImage = null;
        if (!empty($seoImage)) {
            $ogImage = $seoImage;
        } elseif (!empty($settings['seo_og_image_path'])) {
            $ogImage = Storage::url($settings['seo_og_image_path']);
        } elseif (!empty($settings['logo_path'])) {
            $ogImage = Storage::url($settings['logo_path']);
        }

        if ($ogImage && !str_starts_with($ogImage, 'http')) {
            $ogImage = asset($ogImage);
        }

        $metaType = $seoType ?? 'website';
        $twitterUser = $settings['site_twitter_username'] ?? null;
    @endphp

    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    @if(!empty($metaKeywords))
    <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    {{-- Google Search Site Name Structured Data --}}
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@type": "WebSite",
      "name": "{{ $settings['site_title'] ?? config('app.name', 'Ray Purba') }}",
      "url": "{{ url('/') }}"
    }
    </script>

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="{{ $metaType }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:site_name" content="{{ $settings['site_title'] ?? config('app.name', 'Portfolio') }}">
    @if($ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $canonicalUrl }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    @if($ogImage)
    <meta name="twitter:image" content="{{ $ogImage }}">
    @endif
    @if($twitterUser)
    <meta name="twitter:site" content="{{ $twitterUser }}">
    <meta name="twitter:creator" content="{{ $twitterUser }}">
    @endif

    @if(!empty($settings['favicon_path']))
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($settings['favicon_path']) }}">
    <link rel="apple-touch-icon" href="{{ Storage::url($settings['favicon_path']) }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Variable fonts: 1 file per keluarga (menggantikan 8 file statis) --}}
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Orbitron:wght@400..900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Orbitron:wght@400..900&display=swap" rel="stylesheet"></noscript>
    @stack('preload')
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if(!empty($settings['google_analytics']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics'] }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $settings['google_analytics'] }}');</script>
    @endif
    <style>
        :root { color-scheme: dark; }
        body { font-family: 'Space Grotesk', sans-serif; background: #070b13; color: #e4e8ef; }
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
            color: #676bc6;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
        }
        .glitch::after {
            animation: glitch-2 3s infinite;
            color: #3d8fb0;
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
                linear-gradient(rgba(103,107,198,.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(103,107,198,.07) 1px, transparent 1px);
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
            background: linear-gradient(135deg, transparent 40%, rgba(103,107,198,.1) 100%);
            opacity: 0; transition: opacity .3s;
        }
        .cyber-card:hover::before { opacity: 1; }
        .cyber-card::after {
            content:''; position: absolute; top: 0; left: -100%; width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.08), transparent);
            transition: left .5s;
        }
        .cyber-card:hover::after { left: 150%; }
        .cyber-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(103,107,198,.2); }

        /* ── Scanlines ── */
        .scanlines::after {
            content:''; position: absolute; inset: 0; pointer-events: none; z-index: 1;
            background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,.03) 2px, rgba(0,0,0,.03) 4px);
        }

        /* ── Cyber divider ── */
        .cyber-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #676bc6, #3d8fb0, transparent);
        }

        /* ── Robot pulse ── (ring ::after — hanya transform+opacity, tanpa repaint box-shadow) */
        .robot-pulse { position: relative; isolation: isolate; }
        .robot-pulse::after {
            content: ''; position: absolute; inset: 0; border-radius: 9999px;
            border: 2px solid rgba(103,107,198,.7);
            pointer-events: none;
            z-index: -1; /* di atas bg tombol, di bawah ikon */
            animation: robot-pulse-ring 2s ease-out infinite;
        }
        @keyframes robot-pulse-ring {
            0%   { transform: scale(1);    opacity: .8; }
            70%,100% { transform: scale(1.55); opacity: 0; }
        }
        @media (prefers-reduced-motion: reduce) {
            .robot-pulse::after { animation: none; opacity: 0; }
            .glitch::before, .glitch::after { animation: none; opacity: 0; }
        }

        /* ── Scrollbar ── */
        .chat-scroll { scrollbar-width: thin; scrollbar-color: #5052ad #1b2332; }
        .chat-scroll::-webkit-scrollbar { width: 4px; }
        .chat-scroll::-webkit-scrollbar-track { background: #1b2332; }
        .chat-scroll::-webkit-scrollbar-thumb { background: #5052ad; border-radius: 4px; }

        /* ── Custom Cursor ── (transform-only: tanpa animasi width/height) */
        .cyber-cursor-dot, .cyber-cursor-ring {
            position: fixed; top: 0; left: 0; pointer-events: none; z-index: 99999;
            border-radius: 50%; will-change: transform;
            opacity: 0; visibility: hidden;
            transition: opacity .2s ease, visibility .2s ease, background .25s, border-color .25s;
        }
        .cyber-cursor-dot.is-live, .cyber-cursor-ring.is-live { opacity: 1; visibility: visible; }
        .cyber-cursor-dot {
            width: 8px; height: 8px; margin: -4px 0 0 -4px; background: #676bc6;
            box-shadow: 0 0 10px #676bc6, 0 0 20px rgba(103,107,198,.4);
        }
        .cyber-cursor-ring {
            width: 36px; height: 36px; margin: -18px 0 0 -18px;
            border: 2px solid rgba(103,107,198,.6);
            box-shadow: 0 0 15px rgba(103,107,198,.2), inset 0 0 10px rgba(103,107,198,.1);
        }
        .cyber-cursor-dot.is-hover { background: #3d8fb0; box-shadow: 0 0 15px #3d8fb0; --cs: 1.66; }
        .cyber-cursor-ring.is-hover { border-color: #3d8fb0; background: rgba(61,143,176,.08); --cs: 1.44; }

        /* ── Preloader Boot-up ── */
        .boot-preloader {
            position: fixed; inset: 0; z-index: 99998;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            background: #070b13; color: #676bc6;
            font-family: 'Orbitron', monospace;
            transition: opacity .6s ease, visibility .6s ease;
        }
        .boot-preloader.is-hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        .boot-logo { font-size: 1.8rem; font-weight: 900; letter-spacing: 4px; margin-bottom: 2rem;
            background: linear-gradient(90deg,#676bc6,#3d8fb0,#676bc6); background-size: 200% auto;
            -webkit-background-clip: text; background-clip: text; color: transparent; animation: shimmer 3s linear infinite; }
        .boot-lines { width: 320px; max-width: 80vw; }
        .boot-line { font-size: .75rem; color: rgba(103,107,198,.7); opacity: 0;
            animation: bootType .4s ease forwards; animation-delay: var(--d); }
        .boot-line::after { content: '▌'; animation: blinkCursor .7s step-end infinite; }
        @keyframes bootType { to { opacity: 1; } }
        @keyframes blinkCursor { 0%,100% { opacity: 1; } 50% { opacity: 0; } }
        .boot-bar { margin-top: 1.5rem; width: 320px; max-width: 80vw; height: 3px;
            background: rgba(103,107,198,.2); border-radius: 3px; overflow: hidden; }
        .boot-bar-fill { height: 100%; width: 0; border-radius: 3px;
            background: linear-gradient(90deg,#676bc6,#3d8fb0);
            animation: bootFill 2.2s ease forwards; }
        @keyframes bootFill { 0% { width: 0; } 30% { width: 30%; } 70% { width: 75%; } 100% { width: 100%; } }

        /* ── Glitch-in Heading ── */
        .glitch-heading { position: relative; }
        .glitch-heading::before, .glitch-heading::after {
            content: attr(data-text); position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: 0; transition: opacity .3s;
        }
        .glitch-heading.in-view::before {
            opacity: 1; color: #676bc6;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
            animation: glitchBefore .6s ease forwards;
        }
        .glitch-heading.in-view::after {
            opacity: 1; color: #3d8fb0;
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
<div class="boot-preloader" id="boot-preloader">
    <div class="boot-logo">{{ strtoupper($settings['site_title'] ?? 'PORTFOLIO') }}</div>
    <div class="boot-lines">
        <div class="boot-line" style="--d:0s">{{ __('preloader.line_1') }}</div>
        <div class="boot-line" style="--d:.6s">{{ __('preloader.line_2') }}</div>
        <div class="boot-line" style="--d:1.2s">{{ __('preloader.line_3') }}</div>
    </div>
    <div class="boot-bar"><div class="boot-bar-fill"></div></div>
</div>
<script>
(function () {
    'use strict';
    var el = document.getElementById('boot-preloader');
    if (!el) return;

    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var hidden = false;
    function hide() {
        if (hidden) return;
        hidden = true;
        el.classList.add('is-hidden');
    }
    if (reduced) { hide(); return; }

    // 1. Hilang segera setelah resource inti selesai (dipercepat dari 600ms).
    function onLoad() { setTimeout(hide, 150); }
    if (document.readyState === 'complete') onLoad();
    else window.addEventListener('load', onLoad);

    // 2. Jaring pengaman: DOMContentLoaded + jeda singkat.
    function onDomReady() { setTimeout(hide, 400); }
    if (document.readyState !== 'loading') onDomReady();
    else document.addEventListener('DOMContentLoaded', onDomReady);

    // 3. Batas keras lebih ketat agar konten cepat terlihat.
    setTimeout(hide, 1500);
})();
</script>

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
                {{ __('navigation.'.$label) }}
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-purple-400 to-cyan-400 group-hover:w-3/4 transition-all duration-300 rounded-full"></span>
            </a>
            @endforeach

            <!-- Language switcher -->
            @php
                $currentLocale = app()->getLocale();
                $localeFlags = ['id' => '🇮🇩', 'en' => '🇬🇧'];
            @endphp
            <div class="ml-2 inline-flex items-center rounded-full border border-purple-500/40 bg-purple-500/10 p-0.5 text-xs font-orbitron font-bold tracking-widest"
                 role="group" aria-label="{{ __('navigation.language') }}">
                <svg class="w-3.5 h-3.5 shrink-0 ml-2 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c2.39 0 4.68-4.03 4.68-9S14.39 3 12 3m0 18c-2.39 0-4.68-4.03-4.68-9S9.61 3 12 3m0 0a9 9 0 010 18"/>
                </svg>
                @foreach(['id', 'en'] as $loc)
                    @if($loc === $currentLocale)
                    <span aria-current="true"
                          class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 leading-none whitespace-nowrap text-white bg-gradient-to-r from-purple-500/60 to-cyan-500/50 shadow-[0_0_12px_rgba(192,132,252,0.45)]">
                        {{ $localeFlags[$loc] }} {{ strtoupper($loc) }}
                    </span>
                    @else
                    <a href="{{ route('locale.switch', $loc) }}"
                       title="{{ $loc === 'en' ? 'Switch to English' : 'Ganti ke Bahasa Indonesia' }}"
                       class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 leading-none whitespace-nowrap text-gray-500 hover:text-gray-100 hover:bg-white/5 transition-all duration-300">
                        {{ $localeFlags[$loc] }} {{ strtoupper($loc) }}
                    </a>
                    @endif
                    @if(! $loop->last)
                    <span class="w-px h-3 bg-purple-500/30 shrink-0" aria-hidden="true"></span>
                    @endif
                @endforeach
            </div>
        </div>

            <!-- Mobile hamburger — HIDDEN, replaced by bottom nav -->
            <div class="md:hidden inline-flex items-center rounded-full border border-purple-500/40 bg-purple-500/10 p-0.5 text-[11px] font-orbitron font-bold tracking-widest"
                 role="group" aria-label="{{ __('navigation.language') }}">
                <svg class="w-3 h-3 shrink-0 ml-1.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c2.39 0 4.68-4.03 4.68-9S14.39 3 12 3m0 18c-2.39 0-4.68-4.03-4.68-9S9.61 3 12 3m0 0a9 9 0 010 18"/>
                </svg>
                @foreach(['id', 'en'] as $loc)
                    @if($loc === $currentLocale)
                    <span aria-current="true"
                          class="inline-flex items-center gap-0.5 rounded-full px-2 py-0.5 leading-none whitespace-nowrap text-white bg-gradient-to-r from-purple-500/60 to-cyan-500/50 shadow-[0_0_10px_rgba(192,132,252,0.5)]">
                        {{ $localeFlags[$loc] }} {{ strtoupper($loc) }}
                    </span>
                    @else
                    <a href="{{ route('locale.switch', $loc) }}"
                       title="{{ $loc === 'en' ? 'Switch to English' : 'Ganti ke Bahasa Indonesia' }}"
                       class="inline-flex items-center gap-0.5 rounded-full px-2 py-0.5 leading-none whitespace-nowrap text-gray-500 active:text-gray-100 active:bg-white/10 active:scale-90 transition-all duration-300">
                        {{ $localeFlags[$loc] }} {{ strtoupper($loc) }}
                    </a>
                    @endif
                    @if(! $loop->last)
                    <span class="w-px h-2.5 bg-purple-500/30 shrink-0" aria-hidden="true"></span>
                    @endif
                @endforeach
            </div>
    </nav>

    <!-- Mobile dropdown menu — HIDDEN on mobile, bottom nav replaces it -->
</header>

<!-- ═══════════════════════════════════════════════════════════
     MOBILE BOTTOM NAVIGATION — floating rounded bar
     Visible only on mobile (md:hidden)
     Single sliding active bubble + rising active icon + label below
═══════════════════════════════════════════════════════════ -->
<nav id="mobile-bottom-nav"
     class="md:hidden fixed bottom-0 inset-x-0 z-[60] pointer-events-none"
     aria-label="{{ __('navigation.mobile_navigation') }}">

    <div class="pointer-events-auto relative mx-auto max-w-[400px] px-5 pt-3"
         style="padding-bottom: max(0.75rem, env(safe-area-inset-bottom, 0.75rem))">

        {{-- Compact floating rounded bar --}}
        <div class="relative rounded-full bg-gray-950/85 backdrop-blur-xl
                    border border-purple-500/20
                    shadow-[0_8px_24px_rgba(0,0,0,0.5)]">

            {{-- Single floating active bubble (moves between items, pops above bar) --}}
            <div id="mobile-nav-indicator"
                 class="absolute z-0 w-12 h-12 rounded-full pointer-events-none opacity-0
                        transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]"></div>

            {{-- Track --}}
            <div id="mobile-nav-track" class="relative z-10 flex items-end justify-around">

                @php
                $mobileNav = [
                    ['section' => 'home',     'label' => __('navigation.home'),     'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                    ['section' => 'about',    'label' => __('navigation.about'),    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>'],
                       ['section' => 'skills',   'label' => __('navigation.skills'),   'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>'],
                    ['section' => 'projects', 'label' => __('navigation.projects'), 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>'],
                    ['section' => 'contact',  'label' => __('navigation.contact'),  'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                ];
                @endphp

                @foreach($mobileNav as $item)
                <a href="{{ route('home') }}#{{ $item['section'] }}"
                   data-section="{{ $item['section'] }}"
                   class="mobile-nav-item relative flex-1 flex flex-col items-center justify-center pt-2 pb-1.5 gap-1 active:scale-90">

                    {{-- Icon (rises so its bubble pops out of the bar when active) --}}
                    <span class="mobile-nav-icon relative flex items-center justify-center w-11 h-11">
                        <svg class="relative z-10 w-5 h-5 transition-all duration-300 text-gray-400"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $item['icon'] !!}
                        </svg>
                    </span>

                    {{-- Label --}}
                    <span class="mobile-nav-label text-[10px] font-medium leading-none font-orbitron tracking-wide text-gray-500 transition-colors duration-300">
                        {{ $item['label'] }}
                    </span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 767px) {
        :root {
            --mobile-navbar-h: calc(5.5rem + env(safe-area-inset-bottom, 0px));
        }

        /* Content never hidden behind the fixed bottom nav */
        main { padding-bottom: calc(var(--mobile-navbar-h) + 1.25rem); }
        footer { padding-bottom: calc(var(--mobile-navbar-h) + 0.5rem) !important; }

        /* ── Compact floating active bubble (hovers above the bar) ── */
        #mobile-nav-indicator {
            top: 0;
            transform: translate(-50%, -50%);
            background:
                radial-gradient(circle at 35% 30%, rgba(200,202,242,0.95), rgba(103,107,198,0.92) 60%, rgba(61,143,176,0.9));
            box-shadow:
                0 5px 14px rgba(103,107,198,0.45),
                inset 0 1px 0 rgba(255,255,255,0.3);
        }
        #mobile-nav-indicator::after {
            content: '';
            position: absolute; inset: 0; border-radius: 9999px;
            border: 1px solid rgba(255,255,255,0.2);
            pointer-events: none;
        }
        #mobile-nav-indicator.is-visible { opacity: 1; }

        /* ── Active item: icon rises out of the bar, subtle glow ── */
        .mobile-nav-item.is-active .mobile-nav-icon { transform: translateY(-20px); }
        .mobile-nav-item.is-active svg {
            color: #fff;
            filter: drop-shadow(0 0 5px rgba(103,107,198,0.85));
            transform: scale(1.15);
        }
        .mobile-nav-item.is-active .mobile-nav-label {
            color: #a5a8e8;
            text-shadow: 0 0 8px rgba(103,107,198,0.4);
        }
    }
</style>

<script>
(function () {
    'use strict';

    function initMobileNav() {
        // Only run on mobile
        if (window.innerWidth >= 768) return;

        const items = document.querySelectorAll('.mobile-nav-item');
        const indicator = document.getElementById('mobile-nav-indicator');
        const track = document.getElementById('mobile-nav-track');
        if (!items.length || !indicator || !track) return;

        const sections = [];
        items.forEach(item => {
            const id = item.dataset.section;
            const el = document.getElementById(id);
            if (el) sections.push({ item, el, id });
        });
        if (!sections.length) return;

        // Move the single floating bubble to the active item's icon center
        function positionIndicator(activeId) {
            let target = null;
            items.forEach(it => {
                if (it.dataset.section === activeId) target = it;
            });
            if (!target) return;

            const icon = target.querySelector('.mobile-nav-icon');
            const trackRect = track.getBoundingClientRect();
            const iconRect = icon.getBoundingClientRect();

            const cx = iconRect.left - trackRect.left + iconRect.width / 2;
            const cy = iconRect.top - trackRect.top + iconRect.height / 2;

            indicator.style.left = cx + 'px';
            indicator.style.top = cy + 'px';
            indicator.classList.add('is-visible');
        }

        let activeId = null;
        function setActive(id) {
            if (id === activeId) return;
            activeId = id;
            items.forEach(item => {
                item.classList.toggle('is-active', item.dataset.section === id);
            });
            positionIndicator(id);
        }

        // Scroll-spy with IntersectionObserver: a section becomes active when
        // its top crosses a thin probe line at 35% of the viewport height.
        let observer = null;
        function buildObserver() {
            if (observer) observer.disconnect();
            const probe = window.innerHeight * 0.35;
            const rootMargin = `-${probe}px 0px -${window.innerHeight - probe - 1}px 0px`;
            observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) setActive(entry.target.id);
                });
            }, { rootMargin, threshold: 0 });
            sections.forEach(s => observer.observe(s.el));
        }
        buildObserver();

        // Smooth-scroll on tap and activate immediately
        items.forEach(item => {
            item.addEventListener('click', e => {
                const section = item.dataset.section;
                const el = document.getElementById(section);
                if (el) {
                    e.preventDefault();
                    setActive(section);
                    const headerOffset = 72;
                    const y = el.getBoundingClientRect().top + window.scrollY - headerOffset;
                    window.scrollTo({ top: Math.max(y, 0), behavior: 'smooth' });
                }
            });
        });

        // Reposition once images/fonts settle
        window.addEventListener('load', () => positionIndicator(activeId));

        // Rebuild the observer and reposition on resize / orientation change
        window.addEventListener('resize', () => { buildObserver(); positionIndicator(activeId); });

        // Initial state
        setActive('home');
    }

    // Wait until the DOM (including <main> sections) is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileNav);
    } else {
        initMobileNav();
    }
})();
</script>

<!-- Page Content -->
<main>{{ $slot }}</main>

<!-- ═══════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ -->
<footer class="relative bg-gray-950 border-t border-purple-500/20 py-10 overflow-hidden">
    <div class="cyber-grid absolute inset-0 opacity-30 pointer-events-none"></div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <p class="font-orbitron text-sm text-gray-500 tracking-wider">
            &copy; {{ date('Y') }} &mdash; {{ $settings['site_footer'] ?? __('footer.built_with') }}
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400 font-bold">♥ Laravel</span>
        </p>
    </div>
</footer>

<!-- ═══════════════════════════════════════════
     AI CHATBOT — fixed bottom-right
════════════════════════════════════════════ -->
<div x-data="chatbot(@js(__('chatbot.script')))" class="fixed right-4 z-[9999] flex flex-col items-end gap-3
     bottom-6 md:bottom-6"
     style="bottom: calc(1.5rem + 0px)"
     x-init="$el.style.bottom = window.innerWidth < 768
         ? 'calc(6.25rem + env(safe-area-inset-bottom, 0px) + 0.75rem)'
         : '1.5rem'">

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
                <p class="font-orbitron text-white text-sm font-bold truncate">{{ __('chatbot.title') }}</p>
                <p class="text-white/70 text-xs">{{ __('chatbot.status') }}</p>
            </div>
            <!-- Close button — stops propagation so @click.away doesn't re-fire -->
            <button @click.stop="open = false"
                    aria-label="{{ __('chatbot.close') }}"
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
                       placeholder="{{ __('chatbot.placeholder') }}"
                       autocomplete="off"
                       class="flex-1 bg-gray-800 border border-purple-500/30 focus:border-purple-400 rounded-xl px-3 py-2 text-sm text-gray-200 placeholder-gray-500 outline-none transition-colors">
                <button type="submit"
                        aria-label="{{ __('chatbot.send') }}"
                        :disabled="loading || !input.trim()"
                        class="bg-gradient-to-r from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 disabled:opacity-40 disabled:cursor-not-allowed text-white p-2.5 rounded-xl transition-all duration-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                    </svg>
                </button>
            </form>
            <p class="text-center text-xs text-gray-600 mt-2 font-orbitron tracking-widest">{{ __('chatbot.badge') }}</p>
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
    'use strict';
    if (!window.matchMedia('(pointer:fine)').matches) return;
    const dot = document.getElementById('cyberCursorDot');
    const ring = document.getElementById('cyberCursorRing');
    if (!dot || !ring) return;

    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let mx = -100, my = -100, rx = -100, ry = -100;
    let dotS = 1, ringS = 1, ringST = 1;
    let raf = null;

    function apply(el, x, y, s) {
        el.style.transform = 'translate(' + x + 'px,' + y + 'px) scale(' + s + ')';
    }
    function show() {
        if (!dot.classList.contains('is-live')) {
            dot.classList.add('is-live');
            ring.classList.add('is-live');
        }
    }

    function loop() {
        raf = null;
        rx += (mx - rx) * 0.18;
        ry += (my - ry) * 0.18;
        ringS += (ringST - ringS) * 0.2;
        apply(ring, rx, ry, ringS);
        // Hentikan loop saat sudah konvergen (hemat CPU saat idle).
        if (Math.abs(mx - rx) > 0.05 || Math.abs(my - ry) > 0.05 || Math.abs(ringST - ringS) > 0.002) {
            raf = requestAnimationFrame(loop);
        } else {
            rx = mx; ry = my; ringS = ringST;
        }
    }

    function wake() { if (raf === null && !reduced) raf = requestAnimationFrame(loop); }

    window.addEventListener('mousemove', (e) => {
        mx = e.clientX; my = e.clientY;
        show();
        if (reduced) {
            apply(dot, mx, my, 1);
            apply(ring, mx, my, 1);
            return;
        }
        apply(dot, mx, my, dotS);
        wake();
    }, { passive: true });

    document.addEventListener('mouseover', (e) => {
        if (e.target.closest('a, button, .cyber-card, [role="button"], input, textarea')) {
            dot.classList.add('is-hover');
            ring.classList.add('is-hover');
            dotS = 1.66; ringST = 1.44;
            wake();
        }
    });
    document.addEventListener('mouseout', (e) => {
        if (e.target.closest('a, button, .cyber-card, [role="button"], input, textarea')) {
            dot.classList.remove('is-hover');
            ring.classList.remove('is-hover');
            dotS = 1; ringST = 1;
            wake();
        }
    });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden && raf !== null) {
            cancelAnimationFrame(raf);
            raf = null;
        } else if (!document.hidden) {
            wake();
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
</body>
</html>
