<x-admin-layout>
    <x-slot name="header">Site Settings</x-slot>

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Main column --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- General --}}
                <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-5 pb-3 border-b border-slate-200 dark:border-slate-700">General Settings</p>
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="site_title" value="Site Title"/>
                            <x-text-input id="site_title" name="site_title" type="text" class="mt-1 block w-full"
                                :value="old('site_title', $settings['site_title'] ?? '')"/>
                        </div>
                        <div>
                            <x-input-label for="site_description" value="Meta Description"/>
                            <textarea id="site_description" name="site_description" rows="3"
                                class="mt-1 block w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <x-input-label for="site_footer" value="Footer Text"/>
                            <x-text-input id="site_footer" name="site_footer" type="text" class="mt-1 block w-full"
                                :value="old('site_footer', $settings['site_footer'] ?? '')"/>
                        </div>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-5 pb-3 border-b border-slate-200 dark:border-slate-700">Contact Info</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="site_email" value="Email"/>
                            <x-text-input id="site_email" name="site_email" type="email" class="mt-1 block w-full"
                                :value="old('site_email', $settings['site_email'] ?? '')"/>
                        </div>
                        <div>
                            <x-input-label for="site_phone" value="Phone"/>
                            <x-text-input id="site_phone" name="site_phone" type="text" class="mt-1 block w-full"
                                :value="old('site_phone', $settings['site_phone'] ?? '')"/>
                        </div>
                        <div class="sm:col-span-2">
                            <x-input-label for="site_address" value="Address"/>
                            <textarea id="site_address" name="site_address" rows="2"
                                class="mt-1 block w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Integrations --}}
                <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-5 pb-3 border-b border-slate-200 dark:border-slate-700">Integrations</p>
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="google_analytics" value="Google Analytics ID"/>
                            <x-text-input id="google_analytics" name="google_analytics" type="text" class="mt-1 block w-full"
                                :value="old('google_analytics', $settings['google_analytics'] ?? '')" placeholder="G-XXXXXXXXXX"/>
                        </div>
                        <div>
                            <x-input-label for="google_maps_embed" value="Google Maps Embed Code"/>
                            <textarea id="google_maps_embed" name="google_maps_embed" rows="4"
                                class="mt-1 block w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm font-mono text-xs"
                                placeholder="<iframe ...>">{{ old('google_maps_embed', $settings['google_maps_embed'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Logo --}}
                <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-5 pb-3 border-b border-slate-200 dark:border-slate-700">Logo</p>
                    @if(!empty($settings['logo_path']))
                    <img src="{{ Storage::url($settings['logo_path']) }}"
                         class="h-16 object-contain mb-3 bg-slate-100 dark:bg-slate-700 rounded-lg p-2">
                    @else
                    <div class="h-16 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center text-slate-400 dark:text-slate-500 text-xs mb-3">No logo</div>
                    @endif
                    <x-file-input id="logo" name="logo" class="block w-full"/>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PNG/SVG recommended, max 2MB</p>
                </div>

                {{-- Favicon --}}
                <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-5 pb-3 border-b border-slate-200 dark:border-slate-700">Favicon</p>
                    @if(!empty($settings['favicon_path']))
                    <img src="{{ Storage::url($settings['favicon_path']) }}"
                         class="w-10 h-10 object-contain mb-3 bg-slate-100 dark:bg-slate-700 rounded p-1">
                    @else
                    <div class="w-10 h-10 bg-slate-100 dark:bg-slate-700 rounded flex items-center justify-center text-slate-400 dark:text-slate-500 text-xs mb-3">?</div>
                    @endif
                    <x-file-input id="favicon" name="favicon" class="block w-full"/>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">ICO/PNG, max 512KB</p>
                </div>

                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Save All Settings
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
