<x-admin-layout>
    <x-slot name="header">Certificates</x-slot>
    <x-success-alert/>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Certificate
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($certificates as $cert)
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
            @if($cert->image_path)
            <img src="{{ asset('storage/' . str_replace('public/', '', $cert->image_path)) }}" class="w-full h-36 object-cover" loading="lazy">
            @else
            <div class="w-full h-36 bg-gradient-to-br from-indigo-100 to-cyan-100 dark:from-indigo-900/40 dark:to-cyan-900/40 flex items-center justify-center">
                <svg class="w-12 h-12 text-indigo-300 dark:text-indigo-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            @endif
            <div class="p-4">
                <p class="font-semibold text-slate-800 dark:text-slate-100 text-sm">{{ $cert->name }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $cert->issuer }} · {{ $cert->issued_at->format('M Y') }}</p>
                @if($cert->number)
                <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-1 font-mono">{{ $cert->number }}</p>
                @endif
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('admin.certificates.edit', $cert) }}" class="flex-1 text-center text-xs bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 py-1.5 rounded-lg transition-colors font-medium">Edit</a>
                    <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete?')" class="w-full text-xs bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-500/20 py-1.5 rounded-lg transition-colors font-medium">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="col-span-full py-16 text-center text-slate-500 dark:text-slate-400">No certificates yet.</p>
        @endforelse
    </div>
</x-admin-layout>
