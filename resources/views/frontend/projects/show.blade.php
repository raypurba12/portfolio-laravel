@use('Illuminate\Support\Facades\Storage')

<x-frontend-layout :settings="$settings ?? []">
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="mb-6 text-sm text-gray-500 dark:text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('projects.index') }}" class="hover:text-indigo-600">Projects</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 dark:text-white">{{ $project->title }}</span>
            </nav>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl">
                {{-- Thumbnail --}}
                @if($project->thumbnail_path)
                    <img src="{{ asset('storage/' . str_replace('public/', '', $project->thumbnail_path)) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-80 md:h-96 object-cover" loading="lazy" width="896" height="384">
                @endif

                <div class="p-6 md:p-12">
                    {{-- Header --}}
                    <div class="mb-8">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($project->category)
                                <span class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $project->category->name }}
                                </span>
                            @endif
                            <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $project->status === 'published' ? 'Published' : 'Draft' }}
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $project->title }}
                        </h1>

                        <div class="mt-3 flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                            @if($project->date)
                                <span>📅 {{ $project->date->format('d F Y') }}</span>
                            @endif
                            @if($project->client)
                                <span>👤 Client: <strong>{{ $project->client }}</strong></span>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    @if($project->description)
                        <div class="prose prose-gray dark:prose-invert max-w-none mb-10">
                            {!! $project->description !!}
                        </div>
                    @endif

                    {{-- Technology Stack --}}
                    @if($project->technology_stack)
                        <div class="mb-10">
                            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Technology Stack</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $project->technology_stack) as $tech)
                                    <span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap items-center gap-4 mb-10">
                        @if($project->live_demo_url)
                            <a href="{{ $project->live_demo_url }}" target="_blank"
                               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-lg transition duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Live Demo
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank"
                               class="inline-flex items-center gap-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:border-indigo-500 hover:text-indigo-600 font-semibold py-2.5 px-6 rounded-lg transition duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                                </svg>
                                View on GitHub
                            </a>
                        @endif
                    </div>

                    {{-- Gallery --}}
                    @if($project->images->isNotEmpty())
                        <div>
                            <h3 class="text-xl font-bold mb-6 text-gray-900 dark:text-gray-100">Project Gallery</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($project->images as $image)
                                    <div class="overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $image->image_path)) }}"
                                             alt="Project gallery image"
                                             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300" loading="lazy" width="400" height="192">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mt-8">
                <a href="{{ route('projects.index') }}"
                   class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Projects
                </a>
            </div>
        </div>
    </div>
</x-frontend-layout>
