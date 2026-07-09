<x-admin-layout>
    <x-slot name="header">Edit Certificate</x-slot>
    <x-admin-card class="max-w-2xl">
        <form method="POST" action="{{ route('admin.certificates.update', $certificate) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <x-input-label for="name" value="Certificate Name *"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $certificate->name)" required/>
                </div>
                <div>
                    <x-input-label for="issuer" value="Issuer *"/>
                    <x-text-input id="issuer" name="issuer" type="text" class="mt-1 block w-full" :value="old('issuer', $certificate->issuer)" required/>
                </div>
                <div>
                    <x-input-label for="number" value="Certificate Number"/>
                    <x-text-input id="number" name="number" type="text" class="mt-1 block w-full" :value="old('number', $certificate->number)"/>
                </div>
                <div>
                    <x-input-label for="issued_at" value="Issue Date *"/>
                    <x-text-input id="issued_at" name="issued_at" type="date" class="mt-1 block w-full" :value="old('issued_at', $certificate->issued_at?->format('Y-m-d'))" required/>
                </div>
            </div>
            <div>
                <x-input-label value="Certificate Image"/>
                @if($certificate->image_path)
                <img src="{{ asset('storage/' . str_replace('public/', '', $certificate->image_path)) }}" class="w-32 h-24 object-cover rounded mb-2" loading="lazy">
                @endif
                <x-file-input id="image" name="image" class="mt-1 block w-full"/>
            </div>
            <div>
                <x-input-label value="Certificate PDF"/>
                @if($certificate->pdf_path)
                <a href="{{ asset('storage/' . str_replace('public/', '', $certificate->pdf_path)) }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline block mb-2">View current PDF</a>
                @endif
                <x-file-input id="pdf" name="pdf" class="mt-1 block w-full"/>
            </div>
            <div class="flex gap-3 pt-2">
                <x-primary-button>Update</x-primary-button>
                <a href="{{ route('admin.certificates.index') }}" class="px-4 py-2 text-sm text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Cancel</a>
            </div>
        </form>
    </x-admin-card>
</x-admin-layout>
