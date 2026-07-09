@use('Illuminate\Support\Facades\Storage')

<x-frontend-layout :settings="$settings ?? []">
    <x-slot name="header">Projects</x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">All Projects</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-xl mx-auto">
                    A collection of work I've done across various domains.
                </p>
            </div>

            {{-- Projects Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $index => $project)
                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="block group"
                       data-aos="fade-up"
                       data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            {{-- Thumbnail --}}
                            <div class="overflow-hidden h-52">
                                @if($project->thumbnail_path)
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $project->thumbnail_path)) }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" width="416" height="208">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-indigo-300 dark:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-6 flex flex-col flex-1">
                                @if($project->category)
                                    <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-2">
                                        {{ $project->category->name }}
                                    </span>
                                @endif
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    {{ $project->title }}
                                </h3>
                                @if($project->technology_stack)
                                    <div class="mt-auto pt-4 flex flex-wrap gap-1">
                                        @foreach(array_slice(explode(',', $project->technology_stack), 0, 3) as $tech)
                                            <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-0.5 rounded-full">
                                                {{ trim($tech) }}
                                            </span>
                                        @endforeach
                                        @if(count(explode(',', $project->technology_stack)) > 3)
                                            <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-400 px-2 py-0.5 rounded-full">
                                                +{{ count(explode(',', $project->technology_stack)) - 3 }} more
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <svg class="w-20 h-20 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">No projects to display yet.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($projects->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </div>
</x-frontend-layout>
