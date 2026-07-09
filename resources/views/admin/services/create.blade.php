<x-admin-layout>
    <x-slot name="header">Add Service</x-slot>
    <x-admin-card class="max-w-2xl">
        <form method="POST" action="{{ route('admin.services.store') }}" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <x-input-label for="name" value="Service Name *"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required/>
                    <x-input-error :messages="$errors->get('name')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="icon" value="Icon (emoji or SVG)"/>
                    <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full" :value="old('icon')" placeholder="💻 or SVG code"/>
                </div>
                <div>
                    <x-input-label for="price" value="Price (optional)"/>
                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')" step="0.01" min="0"/>
                </div>
                <div>
                    <x-input-label for="order" value="Order"/>
                    <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', 0)" min="0"/>
                </div>
            </div>
            <div>
                <x-input-label for="short_description" value="Short Description *"/>
                <textarea id="short_description" name="short_description" rows="2" required
                    class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-3 py-2 text-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:outline-none transition-colors">{{ old('short_description') }}</textarea>
                <x-input-error :messages="$errors->get('short_description')" class="mt-1"/>
            </div>
            <div>
                <x-input-label for="description" value="Full Description"/>
                <textarea id="description" name="description" rows="4"
                    class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-3 py-2 text-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:outline-none transition-colors">{{ old('description') }}</textarea>
            </div>
            <div class="flex items-center gap-2">
                <input id="is_active" name="is_active" type="checkbox" value="1" checked
                       class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-indigo-600 dark:text-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                <x-input-label for="is_active" value="Active (visible on site)"/>
            </div>
            <div class="flex gap-3 pt-2">
                <x-primary-button>Save</x-primary-button>
                <a href="{{ route('admin.services.index') }}" class="px-4 py-2 text-sm text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
