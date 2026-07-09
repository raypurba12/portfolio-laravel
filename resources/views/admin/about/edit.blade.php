<x-admin-layout>
    <x-slot name="header">Edit About Section</x-slot>

    <div class="max-w-3xl">
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Edit About Information</h2>
                <a href="{{ route('admin.about.index') }}" class="text-xs text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
            </div>

            <form method="POST" action="{{ route('admin.about.update', $about->id) }}" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea-input id="description" class="block mt-1 w-full" name="description" required>{{ old('description', $about->description) }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="birth_date" :value="__('Birth Date')" />
                        <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date', $about->birth_date->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $about->location)" required />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $about->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $about->phone)" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="language" :value="__('Language')" />
                        <x-text-input id="language" class="block mt-1 w-full" type="text" name="language" :value="old('language', $about->language)" required />
                        <x-input-error :messages="$errors->get('language')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="hobbies" :value="__('Hobbies (comma separated)')" />
                    <x-textarea-input id="hobbies" class="block mt-1 w-full" name="hobbies" required>{{ old('hobbies', $about->hobbies) }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('hobbies')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="photo" :value="__('Profile Photo')" />
                        @if($about->photo_path ?? false)
                        <div class="mt-2 mb-2">
                            <img src="{{ $about->photo_url }}" alt="Current Photo" class="h-16 w-16 object-cover rounded-xl border border-slate-200 dark:border-slate-600">
                        </div>
                        @endif
                        <x-file-input id="photo" class="block mt-1 w-full" name="photo" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="cv" :value="__('CV / Resume (PDF)')" />
                        @if($about->cv_path ?? false)
                        <div class="mt-2 mb-2">
                            <a href="{{ $about->cv_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                View Current CV
                            </a>
                        </div>
                        @endif
                        <x-file-input id="cv" class="block mt-1 w-full" name="cv" />
                        <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700">
                    <a href="{{ route('admin.about.index') }}"
                       class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                        Cancel
                    </a>
                    <x-primary-button>Update About Section</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
