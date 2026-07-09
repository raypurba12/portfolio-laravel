<x-admin-layout>
    <x-slot name="header">Add Background</x-slot>
    <x-admin-card class="max-w-xl">
        <form method="POST" action="{{ route('admin.hero-backgrounds.store') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="type" value="Type *"/>
                <select id="type" name="type" required
                        class="mt-1 block w-full rounded-lg border border-gray-600 bg-gray-700 text-white px-3 py-2 text-sm focus:border-purple-500 focus:outline-none">
                    <option value="image" {{ old('type') === 'image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ old('type') === 'video' ? 'selected' : '' }}>Video</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-1"/>
            </div>

            <div>
                <x-input-label for="url" value="URL *"/>
                <x-text-input id="url" name="url" type="url" class="mt-1 block w-full"
                    :value="old('url')" placeholder="https://example.com/background.jpg" required/>
                <p class="text-xs text-gray-400 mt-1">Direct URL to image (jpg, png, webp) or video (mp4).</p>
                <x-input-error :messages="$errors->get('url')" class="mt-1"/>
            </div>

            <div>
                <x-input-label for="poster" value="Poster URL (for video only)"/>
                <x-text-input id="poster" name="poster" type="url" class="mt-1 block w-full"
                    :value="old('poster')" placeholder="https://example.com/poster.jpg"/>
                <p class="text-xs text-gray-400 mt-1">Fallback image shown while video loads. Only needed for video type.</p>
                <x-input-error :messages="$errors->get('poster')" class="mt-1"/>
            </div>

            <div>
                <x-input-label for="duration" value="Duration (seconds)"/>
                <x-text-input id="duration" name="duration" type="number" step="0.1" class="mt-1 block w-full"
                    :value="old('duration', 6.5)" min="0.5" max="60"/>
                <p class="text-xs text-gray-400 mt-1">How long this slide stays before switching (6.5s default).</p>
                <x-input-error :messages="$errors->get('duration')" class="mt-1"/>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="order" value="Order"/>
                    <x-text-input id="order" name="order" type="number" class="mt-1 block w-full"
                        :value="old('order', 0)" min="0"/>
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-2">
                        <input id="is_active" name="is_active" type="checkbox" value="1" checked
                               class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-purple-600 focus:ring-purple-500">
                        <span class="text-sm text-gray-300">Active</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <x-primary-button>Save</x-primary-button>
                <a href="{{ route('admin.hero-backgrounds.index') }}" class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
