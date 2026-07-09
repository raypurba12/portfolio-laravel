<div class="cyber-card bg-gray-900/60 border border-purple-500/10 rounded-2xl p-5 flex flex-col items-center text-center group hover:border-purple-400/50 hover:-translate-y-2 hover:shadow-lg hover:shadow-purple-500/10 transition-all duration-300 flex-shrink-0 w-[140px]">
    <div class="w-14 h-14 mb-3 flex items-center justify-center">
        @if($skill->logo_path)
        <img src="{{ str_starts_with($skill->logo_path, 'http') ? $skill->logo_path : asset('storage/' . str_replace('public/', '', $skill->logo_path)) }}" alt="{{ $skill->name }}"
             class="w-12 h-12 object-contain drop-shadow-lg group-hover:scale-110 transition-transform duration-300" loading="lazy" width="48" height="48">
        @else
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-cyan-500/20 border border-purple-500/30 flex items-center justify-center font-orbitron font-bold text-purple-400 text-lg group-hover:scale-110 transition-transform duration-300">
            {{ substr($skill->name,0,2) }}
        </div>
        @endif
    </div>
    <p class="text-sm font-semibold text-gray-200 group-hover:text-white transition-colors">{{ $skill->name }}</p>
    @if($skill->percentage)
    <div class="w-full mt-2 bg-gray-800 rounded-full h-1">
        <div class="h-1 rounded-full bg-gradient-to-r from-purple-500 to-cyan-500"
             style="width:{{ $skill->percentage }}%"></div>
    </div>
    <p class="text-xs text-purple-400 mt-1 font-orbitron">{{ $skill->percentage }}%</p>
    @endif
</div>
