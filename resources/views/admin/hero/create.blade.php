<x-admin-layout>
    <x-slot name="header">Create Hero Section</x-slot>

    <div class="max-w-3xl">
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Hero Information</h2>
                <a href="{{ route('admin.hero.index') }}" class="text-xs text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
            </div>

            <form method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="title" :value="__('Title / Role')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="typing_text" :value="__('Typing Text (comma separated)')" />
                    <x-textarea-input id="typing_text" class="block mt-1 w-full" name="typing_text" required>{{ old('typing_text') }}</x-textarea-input>
                    <p class="mt-1 text-xs text-slate-500">Example: Web Developer, UI Designer, Freelancer</p>
                    <x-input-error :messages="$errors->get('typing_text')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="photo" :value="__('Profile Photo')" />
                        <x-file-input id="photo" class="block mt-1 w-full" name="photo" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="background" :value="__('Background Image')" />
                        <x-file-input id="background" class="block mt-1 w-full" name="background" />
                        <x-input-error :messages="$errors->get('background')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="cv" :value="__('CV / Resume (PDF)')" />
                        <x-file-input id="cv" class="block mt-1 w-full" name="cv" />
                        <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-700">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Social Links</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="github_url" :value="__('GitHub URL')" />
                            <x-text-input id="github_url" class="block mt-1 w-full" type="url" name="github_url" :value="old('github_url')" />
                        </div>
                        <div>
                            <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
                            <x-text-input id="linkedin_url" class="block mt-1 w-full" type="url" name="linkedin_url" :value="old('linkedin_url')" />
                        </div>
                        <div>
                            <x-input-label for="instagram_url" :value="__('Instagram URL')" />
                            <x-text-input id="instagram_url" class="block mt-1 w-full" type="url" name="instagram_url" :value="old('instagram_url')" />
                        </div>
                        <div>
                            <x-input-label for="whatsapp_url" :value="__('WhatsApp URL')" />
                            <x-text-input id="whatsapp_url" class="block mt-1 w-full" type="url" name="whatsapp_url" :value="old('whatsapp_url')" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700">
                    <a href="{{ route('admin.hero.index') }}"
                       class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors duration-150">
                        Cancel
                    </a>
                    <x-primary-button>Create Hero Section</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
