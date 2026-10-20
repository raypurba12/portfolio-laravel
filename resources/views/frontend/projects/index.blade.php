<x-frontend-layout
    :settings="$settings ?? []"
    :seo-title="'Projects - ' . ($settings['site_title'] ?? config('app.name', 'Portfolio'))"
    :seo-description="__('projects.seo_description')"
    :seo-keywords="'projects, portfolio, developer, web app, mobile, api'"
>
    <section class="relative py-28 bg-gray-950 overflow-hidden">
        {{-- Ambient glows --}}
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-3xl -translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-cyan-600/10 rounded-full blur-3xl translate-x-1/4 translate-y-1/4 pointer-events-none"></div>
        <div class="cyber-grid absolute inset-0 opacity-30 pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">

            {{-- Page Header --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ {{ __('projects.portfolio') }} ]</span>
                <h1 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="{{ __('projects.all_title_plain') }}">
                    {{ __('projects.all_title_pre') }} <span class="text-purple-400">{{ __('projects.all_title_accent') }}</span>
                </h1>
                <div class="w-24 h-0.5 bg-purple-500/70 mx-auto mb-5"></div>
                <p class="text-gray-400 max-w-xl mx-auto">
                    {{ __('projects.index_intro') }}
                </p>
            </div>

            {{-- Projects Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $index => $project)
                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="cyber-card block group relative overflow-hidden bg-gray-900/60 border border-purple-500/10 rounded-2xl transition-all duration-500 hover:border-purple-400/50 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(103,107,198,0.15)]"
                       data-aos="fade-up"
                       data-aos-delay="{{ ($index % 3) * 100 }}">

                        {{-- Gradient washes --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>

                        {{-- Corner accents --}}
                        <div class="absolute top-4 left-4 w-2 h-2 border-t border-l border-purple-500/30 group-hover:border-purple-400 transition-colors z-20"></div>
                        <div class="absolute bottom-4 right-4 w-2 h-2 border-b border-r border-cyan-500/30 group-hover:border-cyan-400 transition-colors z-20"></div>

                        {{-- Thumbnail --}}
                        <div class="relative overflow-hidden h-52">
                            @if($project->thumbnail_path)
                                @php $thumbWebp = \App\Support\Img::webpVariant($project->thumbnail_path); @endphp
                                <picture>
                                    @if($thumbWebp)<source srcset="{{ $thumbWebp }}" type="image/webp">@endif
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $project->thumbnail_path)) }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy" decoding="async" width="416" height="208">
                                </picture>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-900/40 to-cyan-900/40 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-purple-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent opacity-60"></div>

                            @if($project->category)
                                <span class="absolute top-3 left-3 bg-purple-600/80 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $project->category->name }}
                                </span>
                            @endif
                            @if($project->featured)
                                <span class="absolute top-3 right-3 bg-cyan-500/80 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">{{ __('projects.featured_badge') }}</span>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="relative p-6 flex flex-col flex-1">
                            <h3 class="font-orbitron text-lg font-bold text-white mb-2 group-hover:text-purple-400 transition-colors leading-snug">
                                {{ $project->title }}
                            </h3>

                            @if($project->technology_stack)
                                <div class="mt-auto pt-4 flex flex-wrap gap-1.5">
                                    @foreach(array_slice(explode(',', $project->technology_stack), 0, 3) as $tech)
                                        <span class="text-xs bg-gray-800 border border-purple-500/20 text-gray-400 px-2 py-0.5 rounded-md font-mono">{{ trim($tech) }}</span>
                                    @endforeach
                                    @if(count(explode(',', $project->technology_stack)) > 3)
                                        <span class="text-xs bg-gray-800 border border-purple-500/20 text-gray-500 px-2 py-0.5 rounded-md font-mono">+{{ __('projects.more', ['n' => count(explode(',', $project->technology_stack)) - 3]) }}</span>
                                    @endif
                                </div>
                            @endif

                            <div class="mt-5 inline-flex items-center gap-2 text-purple-400 text-sm font-orbitron tracking-wider group-hover:gap-3 transition-all">
                                <span>{{ __('projects.view_project_btn') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20" data-aos="fade-up">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-gray-800/80 border border-purple-500/20 flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="font-orbitron text-gray-500 tracking-wider">{{ __('projects.no_projects_found') }}</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($projects->hasPages())
                <nav class="mt-12 flex items-center justify-center gap-2 font-orbitron text-sm" aria-label="{{ __('projects.pagination_aria') }}">
                    @if($projects->onFirstPage())
                        <span class="px-4 py-2 rounded-lg border border-purple-500/10 text-gray-600 cursor-not-allowed select-none">&larr;</span>
                    @else
                        <a href="{{ $projects->previousPageUrl() }}" class="px-4 py-2 rounded-lg border border-purple-500/30 text-gray-300 hover:border-purple-400 hover:text-white transition-colors">&larr;</a>
                    @endif

                    @foreach($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                        @if($page == $projects->currentPage())
                            <span aria-current="page" class="px-4 py-2 rounded-lg bg-gradient-to-r from-purple-600 to-cyan-600 text-white font-bold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg border border-purple-500/20 text-gray-400 hover:text-white hover:border-purple-400 transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($projects->hasMorePages())
                        <a href="{{ $projects->nextPageUrl() }}" class="px-4 py-2 rounded-lg border border-purple-500/30 text-gray-300 hover:border-purple-400 hover:text-white transition-colors">&rarr;</a>
                    @else
                        <span class="px-4 py-2 rounded-lg border border-purple-500/10 text-gray-600 cursor-not-allowed select-none">&rarr;</span>
                    @endif
                </nav>
            @endif
        </div>
    </section>
</x-frontend-layout>
