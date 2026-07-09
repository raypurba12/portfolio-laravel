<x-admin-layout>
    <x-slot name="header">Add Social Media</x-slot>
    <x-admin-card class="max-w-xl">
        <form method="POST" action="{{ route('admin.social-media.store') }}" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="platform" value="Platform *"/>
                    <select id="platform" name="platform" required
                            class="mt-1 block w-full rounded-lg border border-gray-600 bg-gray-700 text-white px-3 py-2 text-sm focus:border-purple-500 focus:outline-none">
                        <option value="">Select platform</option>
                        @foreach(['github','linkedin','instagram','facebook','tiktok','youtube','whatsapp','twitter','website'] as $p)
                        <option value="{{ $p }}" {{ old('platform') === $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('platform')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="label" value="Label *"/>
                    <x-text-input id="label" name="label" type="text" class="mt-1 block w-full" :value="old('label')" placeholder="e.g. GitHub Profile" required/>
                    <x-input-error :messages="$errors->get('label')" class="mt-1"/>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="url" value="URL *"/>
                    <x-text-input id="url" name="url" type="url" class="mt-1 block w-full" :value="old('url')" placeholder="https://..." required/>
                    <x-input-error :messages="$errors->get('url')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="order" value="Order"/>
                    <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', 0)" min="0"/>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input id="is_active" name="is_active" type="checkbox" value="1" checked class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-purple-600 focus:ring-purple-500">
                <x-input-label for="is_active" value="Active"/>
            </div>
            <div class="flex gap-3 pt-2">
                <x-primary-button>Save</x-primary-button>
                <a href="{{ route('admin.social-media.index') }}" class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
