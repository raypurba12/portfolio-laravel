<x-admin-layout>
    <x-slot name="header">Add Experience</x-slot>

    <x-admin-card class="max-w-2xl">
        <form method="POST" action="{{ route('admin.experience.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="company" value="Company *"/>
                    <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company')" required/>
                    <x-input-error :messages="$errors->get('company')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="position" value="Position *"/>
                    <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position')" required/>
                    <x-input-error :messages="$errors->get('position')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="start_date" value="Start Date *"/>
                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date')" required/>
                    <x-input-error :messages="$errors->get('start_date')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="end_date" value="End Date"/>
                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date')"/>
                    <p class="text-xs text-gray-400 mt-1">Leave empty if currently working here.</p>
                </div>
                <div>
                    <x-input-label for="location" value="Location"/>
                    <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')"/>
                </div>
                <div>
                    <x-input-label for="order" value="Order"/>
                    <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', 0)" min="0"/>
                </div>
            </div>
            <div>
                <x-input-label for="description" value="Description"/>
                <textarea id="description" name="description" rows="4"
                    class="mt-1 block w-full rounded-lg border border-gray-600 bg-gray-700 text-white px-3 py-2 text-sm focus:border-purple-500 focus:outline-none">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1"/>
            </div>
            <div>
                <x-input-label for="logo" value="Company Logo"/>
                <x-file-input id="logo" name="logo" class="mt-1 block w-full"/>
                <x-input-error :messages="$errors->get('logo')" class="mt-1"/>
            </div>
            <div class="flex items-center gap-2">
                <input id="is_current" name="is_current" type="checkbox" value="1" {{ old('is_current') ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-purple-600 focus:ring-purple-500">
                <x-input-label for="is_current" value="Currently working here"/>
            </div>
            <div class="flex gap-3 pt-2">
                <x-primary-button>Save</x-primary-button>
                <a href="{{ route('admin.experience.index') }}" class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
