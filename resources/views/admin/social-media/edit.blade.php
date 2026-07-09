<x-admin-layout>
    <x-slot name="header">Edit Social Media</x-slot>
    <x-admin-card class="max-w-xl">
        <form method="POST" action="{{ route('admin.social-media.update', $socialMedium) }}" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="platform" value="Platform *"/>
                    <select id="platform" name="platform" required
                            class="mt-1 block w-full rounded-lg border border-gray-600 bg-gray-700 text-white px-3 py-2 text-sm focus:border-purple-500 focus:outline-none">
                        @foreach(['github','linkedin','instagram','facebook','tiktok','youtube','whatsapp','twitter','website'] as $p)
                        <option value="{{ $p }}" {{ old('platform', $socialMedium->platform) === $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="label" value="Label *"/>
                    <x-text-input id="label" name="label" type="text" class="mt-1 block w-full" :value="old('label', $socialMedium->label)" required/>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="url" value="URL *"/>
                    <x-text-input id="url" name="url" type="url" class="mt-1 block w-full" :value="old('url', $socialMedium->url)" required/>
                </div>
                <div>
                    <x-input-label for="order" value="Order"/>
                    <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', $socialMedium->order)" min="0"/>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $socialMedium->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-purple-600 focus:ring-purple-500">
                <x-input-label for="is_active" value="Active"/>
            </div>
            <div class="flex gap-3 pt-2">
                <x-primary-button>Update</x-primary-button>
                <a href="{{ route('admin.social-media.index') }}" class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
