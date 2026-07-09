<x-admin-layout>
    <x-slot name="header">Edit Education</x-slot>
    <x-admin-card class="max-w-2xl">
        <form method="POST" action="{{ route('admin.education.update', $education) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <x-input-label for="institution" value="Institution *"/>
                    <x-text-input id="institution" name="institution" type="text" class="mt-1 block w-full" :value="old('institution', $education->institution)" required/>
                </div>
                <div>
                    <x-input-label for="degree" value="Degree"/>
                    <x-text-input id="degree" name="degree" type="text" class="mt-1 block w-full" :value="old('degree', $education->degree)"/>
                </div>
                <div>
                    <x-input-label for="field_of_study" value="Field of Study"/>
                    <x-text-input id="field_of_study" name="field_of_study" type="text" class="mt-1 block w-full" :value="old('field_of_study', $education->field_of_study)"/>
                </div>
                <div>
                    <x-input-label for="start_year" value="Start Year *"/>
                    <x-text-input id="start_year" name="start_year" type="number" class="mt-1 block w-full" :value="old('start_year', $education->start_year)" required/>
                </div>
                <div>
                    <x-input-label for="end_year" value="End Year"/>
                    <x-text-input id="end_year" name="end_year" type="number" class="mt-1 block w-full" :value="old('end_year', $education->end_year)"/>
                </div>
                <div>
                    <x-input-label for="order" value="Order"/>
                    <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', $education->order)" min="0"/>
                </div>
            </div>
            <div>
                <x-input-label for="description" value="Description"/>
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-lg border border-gray-600 bg-gray-700 text-white px-3 py-2 text-sm focus:border-purple-500 focus:outline-none">{{ old('description', $education->description) }}</textarea>
            </div>
            <div>
                <x-input-label for="logo" value="Institution Logo"/>
                @if($education->logo_url)
                <img src="{{ $education->logo_url }}" class="w-16 h-16 object-contain rounded bg-gray-700 p-2 mb-2">
                @endif
                <x-file-input id="logo" name="logo" class="mt-1 block w-full"/>
            </div>
            <div class="flex items-center gap-2">
                <input id="is_current" name="is_current" type="checkbox" value="1" {{ old('is_current', $education->is_current) ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-purple-600 focus:ring-purple-500">
                <x-input-label for="is_current" value="Currently studying here"/>
            </div>
            <div class="flex gap-3 pt-2">
                <x-primary-button>Update</x-primary-button>
                <a href="{{ route('admin.education.index') }}" class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
