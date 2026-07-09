<x-admin-layout>
    <x-slot name="header">Add Skill</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Skill Information</h2>
                <a href="{{ route('admin.skills.index') }}" class="text-xs text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
            </div>

            <form method="POST" action="{{ route('admin.skills.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="name" :value="__('Skill Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="skill_category_id" :value="__('Category')" />
                        <select id="skill_category_id" name="skill_category_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('skill_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('skill_category_id')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="percentage" :value="__('Proficiency (%)')" />
                        <x-text-input id="percentage" class="block mt-1 w-full" type="number" name="percentage" :value="old('percentage', 80)" required min="0" max="100" />
                        <x-input-error :messages="$errors->get('percentage')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="order" :value="__('Display Order')" />
                        <x-text-input id="order" class="block mt-1 w-full" type="number" name="order" :value="old('order', 0)" required />
                        <x-input-error :messages="$errors->get('order')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="color" :value="__('Color (Hex, e.g. #6366F1)')" />
                    <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')" placeholder="#6366F1" />
                    <x-input-error :messages="$errors->get('color')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="logo" :value="__('Skill Logo')" />
                    <x-file-input id="logo" class="block mt-1 w-full" name="logo" />
                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-1">
                    <input id="featured" type="checkbox"
                           class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500"
                           name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                    <label for="featured" class="text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                        Mark as Featured Skill
                    </label>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700">
                    <a href="{{ route('admin.skills.index') }}"
                       class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                        Cancel
                    </a>
                    <x-primary-button>Add Skill</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
