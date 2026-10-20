@use('Illuminate\Support\Str')

@php
    $seoDescription = !empty($project->description)
        ? Str::limit(strip_tags($project->description), 155)
        : ($settings['site_description'] ?? '');
    $seoKeywords = !empty($project->technology_stack)
        ? implode(', ', array_map('trim', explode(',', $project->technology_stack)))
        : '';
    $seoImage = $project->thumbnail_path
        ? asset('storage/' . str_replace('public/', '', $project->thumbnail_path))
        : null;
@endphp

<x-frontend-layout
    :settings="$settings ?? []"
    :seo-title="$project->title . ' - ' . ($settings['site_title'] ?? config('app.name', 'Portfolio'))"
    :seo-description="$seoDescription"
    :seo-keywords="$seoKeywords"
    :seo-image="$seoImage"
    seo-type="article"
>
    <section class="relative py-28 bg-gray-950 overflow-hidden">
        {{-- Ambient glows --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-3xl -translate-y-1/3 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-600/10 rounded-full blur-3xl -translate-x-1/4 translate-y-1/4 pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10 max-w-5xl">

            {{-- Breadcrumb --}}
            <nav class="mb-8 text-sm font-orbitron tracking-wider" aria-label="Breadcrumb" data-aos="fade-up">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-purple-400 transition-colors">{{ __('navigation.home') }}</a>
                <span class="mx-2 text-gray-700">/</span>
                <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-purple-400 transition-colors">{{ __('navigation.projects') }}</a>
                <span class="mx-2 text-gray-700">/</span>
                <span class="text-purple-400">{{ strtoupper(Str::limit($project->title, 30)) }}</span>
            </nav>

            {{-- Main Card --}}
            <div class="cyber-card relative overflow-hidden bg-gray-900/60 border border-purple-500/15 rounded-2xl" data-aos="fade-up">

                {{-- Corner accents --}}
                <div class="absolute top-4 left-4 w-2 h-2 border-t border-l border-purple-500/40 z-20"></div>
                <div class="absolute bottom-4 right-4 w-2 h-2 border-b border-r border-cyan-500/40 z-20"></div>

                {{-- Thumbnail --}}
                @if($project->thumbnail_path)
                    <div class="relative overflow-hidden">
                        @php $detailWebp = \App\Support\Img::webpVariant($project->thumbnail_path); @endphp
                        <picture>
                            @if($detailWebp)<source srcset="{{ $detailWebp }}" type="image/webp">@endif
                            <img src="{{ asset('storage/' . str_replace('public/', '', $project->thumbnail_path)) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-72 md:h-96 object-cover" loading="lazy" decoding="async" width="896" height="384">
                        </picture>
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent opacity-70"></div>
                    </div>
                @endif

                <div class="p-6 md:p-12">

                    {{-- Header --}}
                    <div class="mb-8">
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($project->category)
                                <span class="bg-purple-600/80 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $project->category->name }}
                                </span>
                            @endif
                            <span class="{{ $project->status === 'published' ? 'bg-cyan-500/80' : 'bg-gray-700/80' }} backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $project->status === 'published' ? __('projects.published') : __('projects.draft') }}
                            </span>
                        </div>

                        <h1 class="font-orbitron font-bold text-3xl md:text-4xl text-white leading-tight">
                            {{ $project->title }}
                        </h1>

                        <div class="mt-4 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-gray-400">
                            @if($project->date)
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $project->date->translatedFormat('d F Y') }}
                                </span>
                            @endif
                            @if($project->client)
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    {{ __('projects.client_label') }} <strong class="text-gray-200">{{ $project->client }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    @if($project->description)
                        <div class="project-prose mb-10 text-gray-300 leading-relaxed">
                            {!! $project->description !!}
                        </div>
                    @endif

                    {{-- Technology Stack --}}
                    @if($project->technology_stack)
                        <div class="mb-10">
                            <h3 class="font-orbitron text-sm text-purple-400 tracking-[.25em] uppercase mb-4">[ {{ __('projects.technology_stack') }} ]</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $project->technology_stack) as $tech)
                                    <span class="text-xs bg-gray-800 border border-purple-500/20 text-gray-300 px-3 py-1 rounded-md font-mono">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    @if($project->live_demo_url || $project->github_url)
                        <div class="flex flex-wrap items-center gap-4 mb-10">
                            @if($project->live_demo_url)
<a href="{{ $project->live_demo_url }}" target="_blank" rel="noopener"
   class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 text-white font-semibold py-2.5 px-6 rounded-xl transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_0_25px_rgba(103,107,198,0.35)]">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
    </svg>
    {{ __('projects.live_demo') }}
</a>
                            @endif
                            @if($project->github_url)
<a href="{{ $project->github_url }}" target="_blank" rel="noopener"
   class="inline-flex items-center gap-2 border border-purple-500/50 hover:border-purple-400 text-gray-300 hover:text-white font-semibold py-2.5 px-6 rounded-xl transition-all duration-300 hover:-translate-y-0.5">
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
    </svg>
    {{ __('projects.view_on_github') }}
</a>
                            @endif
                        </div>
                    @endif

                    {{-- Gallery --}}
                    @if($project->images->isNotEmpty())
                        <div>
                            <h3 class="font-orbitron text-sm text-purple-400 tracking-[.25em] uppercase mb-6">[ {{ __('projects.project_gallery') }} ]</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($project->images as $image)
                                    <div class="overflow-hidden rounded-xl border border-purple-500/10 hover:border-purple-400/50 shadow-lg hover:shadow-[0_0_25px_rgba(103,107,198,0.2)] transition-all duration-300 group">
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $image->image_path)) }}"
                                             alt="{{ __('projects.gallery_image') }}"
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" width="400" height="192">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mt-8" data-aos="fade-up">
<a href="{{ route('projects.index') }}"
   class="group inline-flex items-center gap-2 font-orbitron text-sm tracking-wider text-gray-400 hover:text-purple-400 transition-colors">
    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    {{ __('projects.back_to_projects') }}
</a>
            </div>
        </div>
    </section>

    {{-- Rich text styling for the raw HTML description (no typography plugin installed) --}}
    <style>
        .project-prose > *:first-child { margin-top: 0; }
        .project-prose p { margin: 0 0 1rem; }
        .project-prose h1, .project-prose h2, .project-prose h3, .project-prose h4 {
            color: #edf1f8;
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            margin: 1.75rem 0 .75rem;
            line-height: 1.3;
        }
        .project-prose h1 { font-size: 1.5rem; }
        .project-prose h2 { font-size: 1.25rem; }
        .project-prose h3, .project-prose h4 { font-size: 1.05rem; }
        .project-prose a { color: #8589d9; text-decoration: underline; text-underline-offset: 3px; }
        .project-prose a:hover { color: #a5a8e8; }
        .project-prose strong { color: #edf1f8; }
        .project-prose ul, .project-prose ol { margin: 0 0 1rem 1.25rem; display: grid; gap: .35rem; }
        .project-prose ul { list-style: disc; }
        .project-prose ol { list-style: decimal; }
        .project-prose li::marker { color: #676bc6; }
        .project-prose blockquote {
            border-left: 3px solid #676bc6;
            background: rgba(103,107,198,.08);
            padding: .75rem 1rem;
            border-radius: 0 .5rem .5rem 0;
            margin: 0 0 1rem;
            color: #c7cfdc;
        }
        .project-prose code {
            background: #1b2332;
            border: 1px solid rgba(103,107,198,.2);
            padding: .1rem .4rem;
            border-radius: .375rem;
            font-size: .85em;
            color: #82c4dd;
        }
        .project-prose pre {
            background: #111826;
            border: 1px solid rgba(103,107,198,.2);
            border-radius: .75rem;
            padding: 1rem;
            overflow-x: auto;
            margin: 0 0 1rem;
        }
        .project-prose pre code { background: transparent; border: 0; padding: 0; color: #c7cfdc; }
        .project-prose img { border-radius: .75rem; margin: 0 0 1rem; border: 1px solid rgba(103,107,198,.15); }
        .project-prose hr { border-color: rgba(103,107,198,.2); margin: 1.5rem 0; }
        .project-prose table { width: 100%; border-collapse: collapse; margin: 0 0 1rem; font-size: .9em; }
        .project-prose th, .project-prose td { border: 1px solid rgba(103,107,198,.2); padding: .5rem .75rem; text-align: left; }
        .project-prose th { background: rgba(103,107,198,.1); color: #edf1f8; }
    </style>
</x-frontend-layout>
