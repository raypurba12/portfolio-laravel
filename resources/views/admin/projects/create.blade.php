<x-admin-layout>
    <x-slot name="header">Create Project</x-slot>

    <div class="max-w-4xl">
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Project Information</h2>
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
            </div>

            <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="title" :value="__('Project Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="project_category_id" :value="__('Category')" />
                        <select id="project_category_id" name="project_category_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('project_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_category_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="client" :value="__('Client')" />
                        <x-text-input id="client" class="block mt-1 w-full" type="text" name="client" :value="old('client')" />
                        <x-input-error :messages="$errors->get('client')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="date" :value="__('Project Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea-input id="description" class="block mt-1 w-full" name="description">{{ old('description') }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="technology_stack" :value="__('Technology Stack (comma separated)')" />
                    <x-text-input id="technology_stack" class="block mt-1 w-full" type="text" name="technology_stack" :value="old('technology_stack')" placeholder="Laravel, Vue.js, Tailwind CSS" />
                    <x-input-error :messages="$errors->get('technology_stack')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="github_url" :value="__('GitHub URL')" />
                        <x-text-input id="github_url" class="block mt-1 w-full" type="url" name="github_url" :value="old('github_url')" />
                        <x-input-error :messages="$errors->get('github_url')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="live_demo_url" :value="__('Live Demo URL')" />
                        <x-text-input id="live_demo_url" class="block mt-1 w-full" type="url" name="live_demo_url" :value="old('live_demo_url')" />
                        <x-input-error :messages="$errors->get('live_demo_url')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="video_url" :value="__('Video URL (YouTube, etc.)')" />
                        <x-text-input id="video_url" class="block mt-1 w-full" type="url" name="video_url" :value="old('video_url')" />
                        <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="thumbnail" :value="__('Thumbnail Image')" />
                        <x-file-input id="thumbnail" class="block mt-1 w-full" name="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="gallery_images" :value="__('Gallery Images (multiple)')" />
                        <x-file-input id="gallery_images" class="block mt-1 w-full" name="gallery_images[]" multiple />
                        <x-input-error :messages="$errors->get('gallery_images.*')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="flex items-end pb-1">
                        <div class="flex items-center gap-3">
                            <input id="featured" type="checkbox"
                                   class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500"
                                   name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                            <label for="featured" class="text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                                Featured Project
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700">
                    <a href="{{ route('admin.projects.index') }}"
                       class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                        Cancel
                    </a>
                    <x-primary-button>Create Project</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
