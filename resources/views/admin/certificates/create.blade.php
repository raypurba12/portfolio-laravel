<x-admin-layout>
    <x-slot name="header">Add Certificate</x-slot>
    <x-admin-card class="max-w-2xl">
        <form method="POST" action="{{ route('admin.certificates.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <x-input-label for="name" value="Certificate Name *"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required/>
                    <x-input-error :messages="$errors->get('name')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="issuer" value="Issuer *"/>
                    <x-text-input id="issuer" name="issuer" type="text" class="mt-1 block w-full" :value="old('issuer')" required/>
                    <x-input-error :messages="$errors->get('issuer')" class="mt-1"/>
                </div>
                <div>
                    <x-input-label for="number" value="Certificate Number"/>
                    <x-text-input id="number" name="number" type="text" class="mt-1 block w-full" :value="old('number')"/>
                </div>
                <div>
                    <x-input-label for="issued_at" value="Issue Date *"/>
                    <x-text-input id="issued_at" name="issued_at" type="date" class="mt-1 block w-full" :value="old('issued_at')" required/>
                    <x-input-error :messages="$errors->get('issued_at')" class="mt-1"/>
                </div>
            </div>
            <div>
                <x-input-label for="image" value="Certificate Image"/>
                <x-file-input id="image" name="image" class="mt-1 block w-full"/>
                <x-input-error :messages="$errors->get('image')" class="mt-1"/>
            </div>
            <div>
                <x-input-label for="pdf" value="Certificate PDF (max 10MB)"/>
                <x-file-input id="pdf" name="pdf" class="mt-1 block w-full"/>
                <x-input-error :messages="$errors->get('pdf')" class="mt-1"/>
            </div>
            <div class="flex gap-3 pt-2">
                <x-primary-button>Save</x-primary-button>
                <a href="{{ route('admin.certificates.index') }}" class="px-4 py-2 text-sm text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
