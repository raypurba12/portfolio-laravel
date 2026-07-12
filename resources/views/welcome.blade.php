<x-frontend-layout :settings="$settings ?? []">

{{-- ── Global cursor glow ── --}}
<div class="pointer-events-none fixed inset-0 z-[60] hidden lg:block"
     x-data="{ x: 0, y: 0 }"
     x-init="window.addEventListener('mousemove', e => { x = e.clientX; y = e.clientY })">
    <div class="absolute w-72 h-72 rounded-full blur-3xl transition-none"
         style="background: radial-gradient(circle, rgba(168,85,247,0.15) 0%, rgba(6,182,212,0.08) 40%, transparent 70%);"
         :style="`transform:translate(${x - 144}px,${y - 144}px)`"></div>
</div>

{{-- ── Extra animation styles ── --}}
<style>
.shimmer-text{background:linear-gradient(90deg,#a855f7,#06b6d4,#a855f7);background-size:200% auto;-webkit-background-clip:text;background-clip:text;color:transparent;animation:shimmer 4s linear infinite}
@keyframes shimmer{to{background-position:200% center}}
.animate-glow-pulse{animation:glowPulse 2.5s ease-in-out infinite}
@keyframes glowPulse{0%,100%{box-shadow:0 0 15px rgba(168,85,247,.4),0 0 30px rgba(6,182,212,.15)}50%{box-shadow:0 0 25px rgba(168,85,247,.7),0 0 50px rgba(6,182,212,.3)}}
.animate-float{animation:floatY 3.5s ease-in-out infinite}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
.animate-gradient-x{background-size:200% 200%;animation:gradientX 3s ease infinite}
@keyframes gradientX{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
.meteor{position:absolute;width:2px;height:90px;background:linear-gradient(to bottom,rgba(168,85,247,.9),transparent);transform:rotate(35deg);animation:meteorFall 6s linear infinite;opacity:0;will-change:transform;pointer-events:none}
@keyframes meteorFall{0%{opacity:0;transform:translate(0,-100px) rotate(35deg)}10%{opacity:1}80%{opacity:1}100%{opacity:0;transform:translate(250px,400px) rotate(35deg)}}
.shine-sweep{background:linear-gradient(120deg,transparent 20%,rgba(255,255,255,.15) 50%,transparent 80%);background-size:200% 200%;background-position:-100% 0;transition:background-position .9s ease,opacity .3s}
.group:hover .shine-sweep{background-position:200% 0}
.tilt-card{will-change:transform}
/* counter number animation */
@keyframes countUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
.count-up{animation:countUp .5s ease forwards}

/* ── Hero background media (image or video) ── */
.hero-bg-media{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center}
@media(max-width:767px){.hero-bg-media{object-position:30% center}}
.hero-bg-video{object-position:center}
@keyframes heroKenBurns{0%{transform:scale(1) translate(0,0)}100%{transform:scale(1.09) translate(-1.2%,-1%)}}
.hero-bg-kenburns{animation:heroKenBurns 22s ease-in-out infinite alternate}
@media(max-width:640px){.hero-bg-kenburns{animation:none}}

/* ── Sound toggle ── */
.sound-toggle{position:absolute;bottom:28px;right:24px;z-index:50;width:40px;height:40px;border-radius:9999px;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.55);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);cursor:pointer;transition:all .3s ease;backdrop-filter:blur(6px);pointer-events:auto}
.sound-toggle:hover{background:rgba(0,0,0,.75);color:#fff;border-color:rgba(168,85,247,.5);box-shadow:0 0 15px rgba(168,85,247,.2)}

/* ── Lanyard ID card ── */
.lanyard-hanger{width:60px;height:14px;border-radius:0 0 10px 10px;background:linear-gradient(to bottom,#1f2430,#0b0d12);box-shadow:0 2px 6px rgba(0,0,0,.5),inset 0 -2px 3px rgba(255,255,255,.05)}
.lanyard-strap{position:relative;width:26px;margin:0 auto;background:
    repeating-linear-gradient(135deg,#7e22ce 0 10px,#6d28d9 10px 20px),
    linear-gradient(90deg,#0b0d12 0%,rgba(0,0,0,0) 8%,rgba(0,0,0,0) 92%,#0b0d12 100%);
  box-shadow:inset 0 0 0 1px rgba(6,182,212,.25),0 4px 10px rgba(0,0,0,.35)}
.lanyard-strap::before{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(255,255,255,.18),transparent 30%)}
.lanyard-strap::after{content:'RAY • PORTFOLIO • RAY • PORTFOLIO';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(90deg);white-space:nowrap;font-family:'Orbitron',sans-serif;font-size:8px;letter-spacing:2px;color:rgba(255,255,255,.55);width:200px;text-align:center}
.lanyard-clip{width:22px;height:22px;border-radius:9999px;margin:0 auto;position:relative;z-index:5;
  background:radial-gradient(circle at 35% 30%,#e5e7eb,#9ca3af 45%,#4b5563 100%);
  box-shadow:0 2px 4px rgba(0,0,0,.5),inset 0 0 0 2px rgba(255,255,255,.15)}
.lanyard-clip::after{content:'';position:absolute;inset:5px;border-radius:9999px;background:#111827}
.id-card{position:relative;width:15rem;border-radius:1.1rem;padding:.85rem .85rem 1.1rem;
  background:linear-gradient(155deg,#111421 0%,#171a2b 55%,#0c0e17 100%);
  border:1px solid rgba(168,85,247,.35);
  box-shadow:0 25px 45px -15px rgba(0,0,0,.7),0 0 40px -10px rgba(168,85,247,.35),inset 0 1px 0 rgba(255,255,255,.06)}
.id-card::before{content:'';position:absolute;inset:0;border-radius:1.1rem;pointer-events:none;
  background:linear-gradient(115deg,rgba(255,255,255,.10) 0%,transparent 30%,transparent 70%,rgba(6,182,212,.08) 100%)}
.id-punch{width:2.6rem;height:.55rem;border-radius:9999px;margin:0 auto .6rem;background:#05060a;
  box-shadow:inset 0 2px 4px rgba(0,0,0,.8)}
@keyframes cardSheen{0%,100%{background-position:-150% 0}50%{background-position:250% 0}}
.card-sheen{position:absolute;inset:0;border-radius:1.1rem;pointer-events:none;overflow:hidden}
.card-sheen::after{content:'';position:absolute;top:0;left:0;width:60%;height:100%;
  background:linear-gradient(100deg,transparent,rgba(255,255,255,.12),transparent);
  background-size:250% 100%;animation:cardSheen 5s ease-in-out infinite}

/* ── Skills Marquee ── */
.skills-marquee-wrapper{overflow-x:hidden;overflow-y:visible;padding:2.5rem 0;mask-image:linear-gradient(to right,transparent,black 50px,black calc(100% - 50px),transparent);-webkit-mask-image:linear-gradient(to right,transparent,black 50px,black calc(100% - 50px),transparent)}
.skills-marquee-track{display:flex;gap:1.25rem;width:max-content;animation:scrollSkills 40s linear infinite}
.skills-marquee-wrapper:hover .skills-marquee-track{animation-play-state:paused}
@keyframes scrollSkills{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}

/* Kartu skill: efek zoom dramatis saat hover */
.skill-card-item{position:relative;transform-origin:center bottom;transition:transform .4s cubic-bezier(.34,1.56,.64,1),box-shadow .4s ease;will-change:transform}
.skill-card-item:hover{transform:translateY(-14px) scale(1.15);box-shadow:0 15px 40px -10px rgba(168,85,247,.4);z-index:30}
.skill-icon{transition:transform .45s cubic-bezier(.34,1.56,.64,1),filter .45s ease;will-change:transform}
.skill-card-item:hover .skill-icon{transform:scale(1.7) rotate(-6deg);filter:drop-shadow(0 0 14px rgba(168,85,247,.8)) drop-shadow(0 0 28px rgba(6,182,212,.5));animation:skillWiggle 1.2s ease-in-out infinite}
@keyframes skillWiggle{0%,100%{transform:scale(1.7) rotate(-6deg)}50%{transform:scale(1.85) rotate(5deg)}}

/* ── FLIP 3D — KARTU SERTIFIKAT ── */
.cert-flip-outer{perspective:1200px;transition:transform .3s ease}
.cert-flip-outer:hover{transform:translateY(-6px)}
.cert-flip-inner{position:relative;width:100%;height:100%;transition:transform .7s cubic-bezier(.4,.2,.2,1);transform-style:preserve-3d}
.cert-flip-outer:hover .cert-flip-inner{transform:rotateY(180deg)}
.cert-flip-face{position:absolute;inset:0;backface-visibility:hidden;-webkit-backface-visibility:hidden;display:flex;flex-direction:column}
.cert-flip-back{transform:rotateY(180deg)}

/* ── RGB GLITCH — GAMBAR PROJECT ── */
.rgb-glitch{position:relative}
.rgb-glitch::before,.rgb-glitch::after{content:'';position:absolute;inset:0;background-image:var(--glitch-bg);background-size:cover;background-position:center;opacity:0;mix-blend-mode:screen;pointer-events:none}
.rgb-glitch::before{background-color:rgba(255,0,90,.55)}
.rgb-glitch::after{background-color:rgba(0,220,255,.55)}
.group:hover .rgb-glitch::before{opacity:.5;animation:glitchShiftRed .35s steps(2,end) 2}
.group:hover .rgb-glitch::after{opacity:.5;animation:glitchShiftCyan .35s steps(2,end) 2}
@keyframes glitchShiftRed{0%{transform:translate(0,0)}25%{transform:translate(-5px,2px)}50%{transform:translate(4px,-2px)}75%{transform:translate(-2px,1px)}100%{transform:translate(0,0)}}
@keyframes glitchShiftCyan{0%{transform:translate(0,0)}25%{transform:translate(5px,-2px)}50%{transform:translate(-4px,2px)}75%{transform:translate(2px,-1px)}100%{transform:translate(0,0)}}
</style>

{{-- ════════════════════════════════════════════════════ --}}
{{-- HERO --}}
{{-- ════════════════════════════════════════════════════ --}}
@if($hero && $hero->status)
<section id="home"
         class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gray-950 scanlines"
         x-data="{
             particles:[],mx:0,my:0,
             init(){
                 for(let i=0;i<40;i++) this.particles.push({
                     id:i,x:Math.random()*100,
                     size:Math.random()*4+1,
                     dur:Math.random()*15+8,
                     del:Math.random()*10,
                     col:Math.random()>.5?'#a855f7':'#06b6d4'
                 });
                 this.$el.addEventListener('mousemove',e=>{
                     const r=this.$el.getBoundingClientRect();
                     this.mx=((e.clientX-r.left)/r.width-.5)*2;
                     this.my=((e.clientY-r.top)/r.height-.5)*2;
                 });
             }
         }">

    @php
        $slides = collect($heroBackgrounds ?? []);
        if ($slides->isEmpty()) {
            if (!empty($hero->background_video_url)) {
                $slides->push((object)[
                    'type' => 'video',
                    'url' => $hero->background_video_url,
                    'poster' => $hero->background_url ?? null,
                ]);
            } elseif (!empty($hero->background_url)) {
                $slides->push((object)['type' => 'image', 'url' => $hero->background_url, 'poster' => null]);
            }
        }
    @endphp

    @php
        $durations = $slides->map(fn($s) => $s->duration ?? 6500)->toJson();
        $hasVideo = $slides->contains(fn($s) => ($s->type ?? 'image') === 'video');
    @endphp

    @if($slides->isNotEmpty())
    @php $hasVideo = $slides->contains(fn($s) => ($s->type ?? 'image') === 'video'); @endphp
    <div class="absolute inset-0 z-0 overflow-hidden bg-gray-950"
     x-data="{
         active: 0,
         count: {{ $slides->count() }},
         durations: {{ $durations }},
         timer: null,
         isMuted: true,
         init(){
             if(this.count > 1) this.next();
             this.$watch('isMuted', val => {
                 this.$el.querySelectorAll('video').forEach(v => v.muted = val);
             });
         },
         next(){
             clearInterval(this.timer);
             this.timer = setInterval(() => {
                 this.active = (this.active + 1) % this.count;
                 this.next();
             }, this.durations[this.active]);
         },
         goTo(i){
             this.active = i;
             this.next();
         },
         toggleMute(){
             this.isMuted = !this.isMuted;
         },
         destroy(){ clearInterval(this.timer); }
     }">
    @foreach($slides as $i => $slide)
    <div class="absolute inset-0 transition-opacity duration-[1500ms] ease-in-out"
         :class="active === {{ $i }} ? 'opacity-100 z-[1]' : 'opacity-0 z-0'">
        <template x-if="active === {{ $i }}">
            <div class="absolute inset-0">
                @if(($slide->type ?? 'image') === 'video')
                    <video class="hero-bg-media hero-bg-video" autoplay muted loop playsinline preload="auto"
                           x-init="$el.muted = isMuted"
                           @if(!empty($slide->poster)) poster="{{ $slide->poster }}" @endif>
                        <source src="{{ $slide->url }}" type="video/mp4">
                    </video>
                @else
                    <img src="{{ $slide->url }}" alt="" class="hero-bg-media hero-bg-kenburns" loading="{{ $i === 0 ? 'eager' : 'lazy' }}" width="1920" height="1080">
                @endif
            </div>
        </template>
    </div>
    @endforeach

    <div class="absolute inset-0 z-[2] bg-gradient-to-b from-gray-950/70 via-gray-950/50 to-gray-950 pointer-events-none"></div>
    <div class="absolute inset-0 z-[2] bg-gradient-to-t from-gray-950 via-transparent to-transparent pointer-events-none"></div>

    @if($slides->count() > 1)
    <div class="absolute bottom-24 left-1/2 -translate-x-1/2 z-[3] flex gap-2">
        @foreach($slides as $i => $slide)
        <button type="button" @click="goTo({{ $i }})"
                class="h-1.5 rounded-full transition-all duration-300"
                :class="active === {{ $i }} ? 'w-8 bg-purple-400' : 'w-1.5 bg-white/30 hover:bg-white/50'"
                aria-label="Slide {{ $i + 1 }}"></button>
        @endforeach
    </div>
    @endif

    @if($hasVideo)
    <button type="button" @click="toggleMute()"
            class="sound-toggle"
            :title="isMuted ? 'Aktifkan suara' : 'Matikan suara'"
            aria-label="Toggle sound">
        <svg x-show="isMuted" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><line x1="23" y1="9" x2="17" y2="15"/><line x1="17" y1="9" x2="23" y2="15"/></svg>
        <svg x-show="!isMuted" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
    </button>
    @endif
</div>
    @endif

    <div class="absolute inset-0 cyber-grid opacity-40 z-0 pointer-events-none"
         :style="`transform:translate(${mx*8}px,${my*8}px)`"
         style="transition:transform .2s ease-out"></div>

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl animate-pulse z-0 pointer-events-none"
         :style="`transform:translate(${mx*-20}px,${my*-20}px)`" style="transition:transform .3s ease-out"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-cyan-600/20 rounded-full blur-3xl animate-pulse z-0 pointer-events-none"
         style="animation-delay:1.5s"
         :style="`transform:translate(${mx*20}px,${my*20}px)`"
         x-bind:style="`transform:translate(${mx*20}px,${my*20}px);transition:transform .3s ease-out`"></div>

    <div class="meteor" style="top:10%;left:20%;animation-delay:0s"></div>
    <div class="meteor" style="top:30%;left:60%;animation-delay:2.5s"></div>
    <div class="meteor" style="top:55%;left:10%;animation-delay:5s"></div>
    <div class="meteor" style="top:70%;left:80%;animation-delay:8s"></div>

    <template x-for="p in particles" :key="p.id">
        <div class="particle"
             :style="`left:${p.x}%;width:${p.size}px;height:${p.size}px;background:${p.col};animation-duration:${p.dur}s;animation-delay:${p.del}s;box-shadow:0 0 ${p.size*3}px ${p.col}`"></div>
    </template>

    <div class="relative z-10 container mx-auto px-6 py-32 flex flex-col lg:flex-row items-center gap-16">

        {{-- Text --}}
        <div class="flex-1 text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
            <div class="inline-flex items-center gap-2 bg-purple-500/10 border border-purple-500/30 rounded-full px-4 py-1.5 mb-6 hover:border-purple-400/60 hover:bg-purple-500/20 transition-all duration-300">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-sm text-purple-300 font-orbitron tracking-wider">AVAILABLE FOR HIRE</span>
            </div>

            <h1 class="font-orbitron font-black text-5xl md:text-7xl leading-tight mb-4 shimmer-text animate-float">
                {{ $hero->name }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-4 font-light">{{ $hero->title }}</p>

            {{-- Typing animation --}}
            <div class="text-xl md:text-2xl mb-8 font-orbitron"
                 x-data="{
                     texts:{{ json_encode(array_map('trim', explode(',', $hero->typing_text))) }},
                     current:0,output:'',deleting:false,
                     init(){this.type()},
                     async type(){
                         const t=this.texts[this.current];
                         if(!this.deleting){
                             if(this.output.length<t.length){this.output+=t[this.output.length];setTimeout(()=>this.type(),80)}
                             else setTimeout(()=>{this.deleting=true;this.type()},2000)
                         } else {
                             if(this.output.length>0){this.output=this.output.slice(0,-1);setTimeout(()=>this.type(),40)}
                             else{this.deleting=false;this.current=(this.current+1)%this.texts.length;setTimeout(()=>this.type(),300)}
                         }
                     }
                 }">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400" x-text="output"></span>
                <span class="inline-block w-0.5 h-6 bg-cyan-400 animate-pulse ml-1 align-middle"></span>
            </div>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                @if($hero->github_url)
                <a href="{{ $hero->github_url }}" target="_blank"
                   class="magnetic-btn group relative flex items-center gap-2 border border-purple-500/50 hover:border-purple-400 text-gray-300 hover:text-white font-semibold py-3 px-6 rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/20"
                   x-data="{ tx:0, ty:0 }"
                   @mousemove="const r=$el.getBoundingClientRect(); tx=($event.clientX-r.left-r.width/2)*0.35; ty=($event.clientY-r.top-r.height/2)*0.35"
                   @mouseleave="tx=0; ty=0"
                   :style="`transform:translate(${tx}px, ${ty}px)`">
                    <div class="absolute inset-0 bg-purple-600/0 group-hover:bg-purple-600/20 transition-all duration-300"></div>
                    <svg class="w-5 h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                    <span class="relative z-10">GitHub</span>
                </a>
                @endif
                @if($hero->linkedin_url)
                <a href="{{ $hero->linkedin_url }}" target="_blank"
                   class="magnetic-btn group relative flex items-center gap-2 border border-cyan-500/50 hover:border-cyan-400 text-gray-300 hover:text-white font-semibold py-3 px-6 rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20"
                   x-data="{ tx:0, ty:0 }"
                   @mousemove="const r=$el.getBoundingClientRect(); tx=($event.clientX-r.left-r.width/2)*0.35; ty=($event.clientY-r.top-r.height/2)*0.35"
                   @mouseleave="tx=0; ty=0"
                   :style="`transform:translate(${tx}px, ${ty}px)`">
                    <div class="absolute inset-0 bg-cyan-600/0 group-hover:bg-cyan-600/20 transition-all duration-300"></div>
                    <span class="relative z-10">LinkedIn</span>
                </a>
                 @endif
                @if($hero->cv_url && $hero->cv_url !== '#')
                <a href="{{ $hero->cv_url }}" target="_blank"
                   class="magnetic-btn flex items-center gap-2 bg-gradient-to-r from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 text-white font-bold py-3 px-7 rounded-xl transition-all duration-300 shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 animate-glow-pulse"
                   x-data="{ tx:0, ty:0 }"
                   @mousemove="const r=$el.getBoundingClientRect(); tx=($event.clientX-r.left-r.width/2)*0.35; ty=($event.clientY-r.top-r.height/2)*0.35"
                   @mouseleave="tx=0; ty=0"
                   :style="`transform:translate(${tx}px, ${ty}px)`">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Download CV
                </a>
                @endif
            </div>
        </div>

        {{-- Photo as a swinging lanyard ID card --}}
        @if($hero->photo_url)
        <div class="flex-shrink-0 relative flex flex-col items-center select-none"
             data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200"
             style="perspective:1200px">

            {{-- fixed hanger rail (does not swing) --}}
            <div class="lanyard-hanger relative z-10"></div>

            <div class="relative"
                 style="transform-origin: top center; touch-action:none;"
                 x-data="{
                     x:0, y:0, angle:5,
                     vx:0, vy:0, vAngle:0,
                     dragging:false,
                     startX:0, startY:0,
                     history:[], raf:null,
                     init(){
                         this.raf = requestAnimationFrame(()=>this.loop());
                         this.$el.addEventListener('pointerdown', this.startDrag.bind(this));
                     },
                     destroy(){ if(this.raf) cancelAnimationFrame(this.raf); },
                     loop(){
                         if(!this.dragging){
                             const now = performance.now();
                             const wind = Math.sin(now/2200)*0.35 + Math.sin(now/850)*0.18;
                             this.vx = (this.vx - this.x*0.05 + wind*0.05) * 0.92;
                             this.x += this.vx;
                             this.vy = (this.vy - this.y*0.045) * 0.92;
                             this.y += this.vy;
                             this.vAngle = (this.vAngle - this.angle*0.045 + wind*0.06) * 0.93;
                             this.angle += this.vAngle;
                         }
                         this.raf = requestAnimationFrame(()=>this.loop());
                     },
                     startDrag(e){
                         this.dragging = true;
                         this.vx = 0; this.vy = 0; this.vAngle = 0;
                         this.startX = e.clientX - this.x;
                         this.startY = e.clientY - this.y;
                         this.history = [{x:e.clientX, y:e.clientY, t:performance.now()}];
                         e.preventDefault();
                     },
                     onDrag(e){
                         if(!this.dragging) return;
                         this.x = Math.max(-100, Math.min(100, e.clientX - this.startX));
                         this.y = Math.max(-40, Math.min(150, e.clientY - this.startY));
                         this.angle = Math.max(-45, Math.min(45, this.x * 0.35));
                         this.history.push({x:e.clientX, y:e.clientY, t:performance.now()});
                         if(this.history.length > 6) this.history.shift();
                     },
                     endDrag(){
                         if(!this.dragging) return;
                         this.dragging = false;
                         if(this.history.length >= 2){
                             const first = this.history[0];
                             const last = this.history[this.history.length - 1];
                             const dt = Math.max(last.t - first.t, 16);
                             this.vx = Math.max(-28, Math.min(28, (last.x - first.x) / dt * 11));
                             this.vy = Math.max(-28, Math.min(28, (last.y - first.y) / dt * 11));
                             this.vAngle = Math.max(-12, Math.min(12, this.vx * 0.15));
                         }
                     }
                 }"
                 @pointermove.window="onDrag"
                 @pointerup.window="endDrag"
                 @pointercancel.window="endDrag"
                 :style="`transform: translate(${x}px, ${y}px) rotate(${angle}deg); cursor:${dragging ? 'grabbing' : 'grab'}`">

                {{-- strap --}}
                <div class="lanyard-strap h-32 md:h-40 rounded-b-sm"></div>

                {{-- metal clip ring --}}
                <div class="lanyard-clip -mt-1"></div>

                {{-- the ID card itself --}}
                <div class="id-card -mt-1 mx-auto tilt-card">
                    <div class="card-sheen"></div>
                    <div class="id-punch"></div>

                    <div class="relative w-full aspect-square rounded-xl overflow-hidden border-2 border-purple-500/50"
                         style="box-shadow:0 0 20px rgba(168,85,247,.35)">
                        <img src="{{ $hero->photo_url }}" alt="{{ $hero->name }}" class="w-full h-full object-cover pointer-events-none" width="288" height="288" draggable="false">
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/30 to-transparent"></div>
                        <div class="absolute inset-0 opacity-20"
                             style="background:repeating-linear-gradient(0deg,transparent,transparent 3px,rgba(168,85,247,.1) 3px,rgba(168,85,247,.1) 4px)"></div>
                    </div>

                    <div class="mt-3 text-center">
                        <p class="font-orbitron text-sm font-bold text-white tracking-wide truncate">{{ $hero->name }}</p>
                        <p class="text-[11px] text-purple-300/80 truncate">{{ $hero->title }}</p>
                    </div>

                    <div class="mt-2 flex items-center justify-center gap-2 bg-gray-950/60 border border-purple-500/30 rounded-full px-3 py-1 whitespace-nowrap">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-orbitron text-green-400 tracking-widest">ONLINE</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 z-10 animate-bounce">
        <span class="text-xs font-orbitron text-gray-500 tracking-widest">SCROLL</span>
        <div class="w-0.5 h-8 bg-gradient-to-b from-purple-400 to-transparent"></div>
    </div>
</section>
@endif

<div class="cyber-divider"></div>

{{-- ════════════════════════════════════════════════════ --}}
{{-- ABOUT --}}
{{-- ════════════════════════════════════════════════════ --}}
@if($about)
<section id="about" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="cyber-grid absolute inset-0 opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ WHO AM I ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="About Me">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Me</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            @if($about->photo_path)
            <div class="relative flex justify-center" data-aos="fade-right">
                <div class="relative w-64 h-80 md:w-80 md:h-96 group">
                    <div class="absolute -inset-0.5 rounded-2xl bg-gradient-to-r from-purple-500 via-cyan-500 to-purple-500 opacity-0 group-hover:opacity-60 blur transition-opacity duration-500 animate-gradient-x"></div>
                    <div class="absolute -top-3 -left-3 w-10 h-10 border-t-2 border-l-2 border-purple-400 z-20"></div>
                    <div class="absolute -bottom-3 -right-3 w-10 h-10 border-b-2 border-r-2 border-cyan-400 z-20"></div>
                    <img src="{{ $about->photo_url }}" alt="About Me"
                         class="relative w-full h-full object-cover rounded-2xl group-hover:scale-[1.02] transition-transform duration-500"
                         style="box-shadow:0 0 40px rgba(168,85,247,.2)" loading="lazy" width="320" height="384">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-gray-950/50 to-transparent"></div>
                </div>
            </div>
            @endif
            <div data-aos="fade-left">
                <p class="text-gray-400 text-lg leading-relaxed mb-8">{{ $about->description }}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['icon'=>'📍','label'=>'Location','value'=>$about->location??null],
                        ['icon'=>'📧','label'=>'Email','value'=>$about->email??null],
                        ['icon'=>'🎂','label'=>'Age','value'=>$about->birth_date?$about->birth_date->age.' years old':null],
                        ['icon'=>'📱','label'=>'Phone','value'=>$about->phone??null],
                    ] as $k=>$info)
                    @if($info['value'])
                    <div class="flex items-center gap-3 p-3 bg-gray-900/50 border border-purple-500/10 rounded-xl hover:border-purple-500/40 hover:-translate-y-0.5 transition-all duration-300"
                         data-aos="fade-up" data-aos-delay="{{ $k*80 }}">
                        <span class="text-xl">{{ $info['icon'] }}</span>
                        <div>
                            <p class="text-xs text-gray-500 font-orbitron uppercase tracking-wider">{{ $info['label'] }}</p>
                            <p class="text-gray-200 text-sm font-medium">{{ $info['value'] }}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<div class="cyber-divider"></div>

{{-- ════════════════════════════════════════════════════ --}}
{{-- SERVICES --}}
{{-- ════════════════════════════════════════════════════ --}}
@if($services->isNotEmpty())
<section id="services" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-cyan-600/10 rounded-full blur-3xl -translate-y-1/2"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ WHAT I DO ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="My Services">
                My <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Services</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $key => $service)
            <div class="cyber-card tilt-card bg-gray-900/60 border border-purple-500/10 rounded-2xl p-8 group relative overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(168,85,247,0.15)]"
                 data-aos="fade-up" data-aos-delay="{{ ($key%3)*100 }}"
                 x-data="{ rx:0,ry:0 }"
                 @mousemove="const r=$el.getBoundingClientRect();ry=(($event.clientX-r.left)/r.width-.5)*15;rx=-(($event.clientY-r.top)/r.height-.5)*15"
                 @mouseleave="rx=0;ry=0"
                 :style="`transform:perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg)`">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-purple-500/20 to-transparent rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="w-16 h-16 rounded-xl bg-gray-800/80 border border-purple-500/20 flex items-center justify-center mb-6 relative z-10 group-hover:border-purple-400/50 transition-colors">
                    <i class="{{ $service->icon ?: 'bx bx-code-alt' }} text-3xl text-transparent bg-clip-text bg-gradient-to-br from-purple-400 to-cyan-400 group-hover:animate-pulse"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 relative z-10 font-orbitron">{{ $service->name }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed relative z-10">{{ $service->description }}</p>
                
                <!-- Corner accents -->
                <div class="absolute top-4 left-4 w-2 h-2 border-t border-l border-purple-500/30 group-hover:border-purple-400 transition-colors"></div>
                <div class="absolute bottom-4 right-4 w-2 h-2 border-b border-r border-cyan-500/30 group-hover:border-cyan-400 transition-colors"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<div class="cyber-divider"></div>
@endif

{{-- ════════════════════════════════════════════════════ --}}
{{-- SKILLS --}}
{{-- ════════════════════════════════════════════════════ --}}
@if($skills->isNotEmpty())
<section id="skills" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-cyan-400 tracking-widest uppercase mb-2 block">[ MY ARSENAL ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="Tech Skills">
                Tech <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Skills</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>

        <div class="skills-marquee-wrapper" data-aos="fade-up">
            <div class="skills-marquee-track">
                @foreach($skills as $skill)
                <div class="skill-item">
                    @include('components.skill-card', ['skill' => $skill])
                </div>
                @endforeach
                @foreach($skills as $skill)
                <div class="skill-item">
                    @include('components.skill-card', ['skill' => $skill])
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<div class="cyber-divider"></div>

{{-- ════════════════════════════════════════════════════ --}}
{{-- PROJECTS --}}
{{-- ════════════════════════════════════════════════════ --}}
<section id="projects" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="cyber-grid absolute inset-0 opacity-20"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-purple-600/5 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ MY WORK ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="Featured Projects">
                Featured <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Projects</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto mb-4"></div>
            <p class="text-gray-400">A selection of my finest work.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @forelse($projects as $project)
            <a href="{{ route('projects.show', $project->slug) }}"
               class="cyber-card tilt-card block bg-gray-900/60 border border-purple-500/10 rounded-2xl overflow-hidden group relative"
               data-aos="fade-up" data-aos-delay="{{ ($loop->index%3)*120 }}"
               x-data="{ rx:0,ry:0 }"
               @mousemove="const r=$el.getBoundingClientRect();ry=(($event.clientX-r.left)/r.width-.5)*10;rx=-(($event.clientY-r.top)/r.height-.5)*10"
               @mouseleave="rx=0;ry=0"
               :style="`transform:perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg);transition:transform .15s ease-out`">

                <div class="relative overflow-hidden h-52 rgb-glitch"
                     @if($project->thumbnail_url) style="--glitch-bg:url('{{ $project->thumbnail_url }}')" @endif>
                    @if($project->thumbnail_url)
                    <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy" width="416" height="208">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-purple-900/40 to-cyan-900/40 flex items-center justify-center">
                        <span class="font-orbitron text-purple-400 text-2xl">PROJECT</span>
                    </div>
                    @endif
                    <div class="absolute inset-0 shine-sweep opacity-0 group-hover:opacity-100"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>
                    @if($project->category)
                    <span class="absolute top-3 left-3 bg-purple-600/80 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $project->category->name }}
                    </span>
                    @endif
                    @if($project->featured)
                    <span class="absolute top-3 right-3 bg-cyan-500/80 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">⭐ FEATURED</span>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-lg text-white group-hover:text-purple-400 transition-colors mb-2">{{ $project->title }}</h3>
                    @if($project->technology_stack)
                    <div class="flex flex-wrap gap-1.5 mt-3">
                        @foreach(array_slice(explode(',', $project->technology_stack), 0, 3) as $tech)
                        <span class="text-xs bg-gray-800 border border-purple-500/20 text-gray-400 px-2 py-0.5 rounded-md font-mono">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="mt-4 flex items-center gap-2 text-purple-400 text-sm group-hover:gap-3 transition-all">
                        <span>View Project</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-20">
                <p class="font-orbitron text-gray-600">NO PROJECTS FOUND</p>
            </div>
            @endforelse
        </div>
        @if($projects->isNotEmpty())
        <div class="text-center mt-14" data-aos="fade-up">
            <a href="{{ route('projects.index') }}"
               class="group inline-flex items-center gap-3 relative overflow-hidden border border-purple-500/50 hover:border-purple-400 text-gray-300 hover:text-white font-orbitron font-bold py-3.5 px-10 rounded-xl transition-all duration-300 hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 to-cyan-600/0 group-hover:from-purple-600/20 group-hover:to-cyan-600/20 transition-all duration-300"></div>
                <span class="relative z-10">VIEW ALL PROJECTS</span>
                <svg class="w-4 h-4 relative z-10 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        @endif
    </div>
</section>

<div class="cyber-divider"></div>

{{-- ════════════════════════════════════════════════════ --}}
{{-- JOURNEY (EXPERIENCE & EDUCATION) --}}
{{-- ════════════════════════════════════════════════════ --}}
@if($experiences->isNotEmpty() || $educations->isNotEmpty())
<section id="journey" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 cyber-grid opacity-10"></div>
    <div class="container mx-auto px-6 relative z-10 max-w-5xl">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ MY PATH ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="Career Journey">
                Career <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Journey</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-8">
            <!-- Experience -->
            <div>
                <h3 class="text-2xl font-orbitron font-bold text-white mb-10 flex items-center gap-3" data-aos="fade-right">
                    <span class="w-8 h-8 rounded-full bg-purple-500/20 border border-purple-500/50 flex items-center justify-center text-purple-400">💼</span>
                    Experience
                </h3>
                <div class="relative border-l border-purple-500/20 ml-4 space-y-10">
                    @foreach($experiences as $exp)
                    <div class="relative pl-8 group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-gray-900 border-2 border-purple-500 group-hover:bg-purple-500 transition-colors shadow-[0_0_10px_rgba(168,85,247,0.5)]"></div>
                        <div class="absolute left-0 top-3 w-8 h-[1px] bg-purple-500/20 group-hover:bg-purple-500/50 transition-colors"></div>
                        
                        <div class="bg-gray-900/40 border border-purple-500/10 rounded-xl p-6 hover:border-purple-400/30 transition-all duration-300 hover:-translate-y-1 hover:bg-gray-900/60 shadow-lg">
                            <span class="text-xs font-orbitron text-cyan-400 mb-2 block">
                                {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} - 
                                {{ $exp->is_current ? 'Present' : \Carbon\Carbon::parse($exp->end_date)->format('M Y') }}
                            </span>
                            <h4 class="text-lg font-bold text-white">{{ $exp->position }}</h4>
                            <p class="text-purple-300 text-sm font-medium mb-3">{{ $exp->company }}</p>
                            @if($exp->description)
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $exp->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Education -->
            <div>
                <h3 class="text-2xl font-orbitron font-bold text-white mb-10 flex items-center gap-3" data-aos="fade-left">
                    <span class="w-8 h-8 rounded-full bg-cyan-500/20 border border-cyan-500/50 flex items-center justify-center text-cyan-400">🎓</span>
                    Education
                </h3>
                <div class="relative border-l border-cyan-500/20 ml-4 space-y-10">
                    @foreach($educations as $edu)
                    <div class="relative pl-8 group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-gray-900 border-2 border-cyan-500 group-hover:bg-cyan-500 transition-colors shadow-[0_0_10px_rgba(6,182,212,0.5)]"></div>
                        <div class="absolute left-0 top-3 w-8 h-[1px] bg-cyan-500/20 group-hover:bg-cyan-500/50 transition-colors"></div>
                        
                        <div class="bg-gray-900/40 border border-cyan-500/10 rounded-xl p-6 hover:border-cyan-400/30 transition-all duration-300 hover:-translate-y-1 hover:bg-gray-900/60 shadow-lg">
                            <span class="text-xs font-orbitron text-purple-400 mb-2 block">
                                {{ $edu->start_year }} - {{ $edu->is_current ? 'Present' : $edu->end_year }}
                            </span>
                            <h4 class="text-lg font-bold text-white">{{ $edu->degree ?? 'Degree' }}</h4>
                            <p class="text-cyan-300 text-sm font-medium mb-1">{{ $edu->institution }}</p>
                            @if($edu->field_of_study)
                            <p class="text-gray-500 text-xs mb-3">{{ $edu->field_of_study }}</p>
                            @endif
                            @if($edu->description)
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $edu->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<div class="cyber-divider"></div>
@endif

{{-- ════════════════════════════════════════════════════ --}}
{{-- CERTIFICATES --}}
{{-- ════════════════════════════════════════════════════ --}}
@if($certificates->isNotEmpty())
<section id="certificates" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-cyan-400 tracking-widest uppercase mb-2 block">[ ACHIEVEMENTS ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="Licenses & Certifications">
                Licenses & <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Certifications</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>
        
        <div class="flex flex-wrap justify-center gap-6">
            @foreach($certificates as $cert)
            <div
    class="cert-flip-outer w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]"
    style="height:340px; min-height:340px; background:red;"
    data-aos="zoom-in"
    data-aos-delay="{{ ($loop->index%3)*100 }}"
>
                <div class="cert-flip-inner">

                    {{-- FRONT --}}
                    <div class="cert-flip-face cert-flip-front bg-gray-900/60 border border-purple-500/10 rounded-2xl overflow-hidden">
                        @if($cert->image_path)
                        <div class="h-44 overflow-hidden border-b border-purple-500/10 relative flex-shrink-0">
                            <img src="{{ asset('storage/' . str_replace('public/', '', $cert->image_path)) }}"
                                 alt="{{ $cert->name }}" class="w-full h-full object-cover" loading="lazy" width="400" height="176">
                            <div class="absolute inset-0 bg-gray-950/20"></div>
                        </div>
                        @endif
                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="font-bold text-lg text-white leading-tight">{{ $cert->name }}</h3>
                            <p class="text-purple-400 text-sm font-medium mt-1">{{ $cert->issuer }}</p>
                            <span class="mt-auto text-[11px] text-gray-500 font-orbitron tracking-wider">HOVER UNTUK DETAIL →</span>
                        </div>
                    </div>

                    {{-- BACK --}}
                    <div class="cert-flip-face cert-flip-back bg-gray-900/95 border border-cyan-400/30 rounded-2xl p-6 justify-center">
                        <h3 class="font-bold text-lg text-white mb-1">{{ $cert->name }}</h3>
                        <p class="text-cyan-300 text-sm font-medium mb-4">{{ $cert->issuer }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-400 font-orbitron mb-5">
                            <span>Issued: {{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}</span>
                            @if($cert->expiration_date)
                            <span>Expires: {{ \Carbon\Carbon::parse($cert->expiration_date)->format('M Y') }}</span>
                            @endif
                        </div>
                        @if($cert->credential_url)
                        <a href="{{ $cert->credential_url }}" target="_blank"
                           class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/5 hover:bg-white/10 px-4 py-2 rounded-lg transition-colors border border-white/10 hover:border-cyan-500/50 w-full justify-center">
                            View Credential
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<div class="cyber-divider"></div>
@endif

{{-- ════════════════════════════════════════════════════ --}}
{{-- CONTACT --}}
{{-- ════════════════════════════════════════════════════ --}}
<section id="contact" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 cyber-grid opacity-20"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
        <div class="max-w-5xl mx-auto">
            <div class="text-center">
                <span class="font-orbitron text-xs text-cyan-400 tracking-widest uppercase mb-2 block">[ LET'S CONNECT ]</span>
                <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4 glitch-heading" data-text="Get In Touch">
                    Get In <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Touch</span>
                </h2>
                <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto mb-8"></div>
                <p class="text-gray-400 text-lg leading-relaxed mb-10">
                    I'm currently available for freelance work and exciting collaborations.
                    Let's build something extraordinary together.
                </p>
            </div>

            @php
                $hasContactInfo = !empty($settings['site_email']) || !empty($settings['site_phone']) || !empty($settings['site_address']);
                $hasMaps = !empty($settings['google_maps_embed']);
            @endphp

            

            @if(session('contact_success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 x-transition
                 class="mb-8 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-4 rounded-2xl text-sm font-medium">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('contact_success') }}
                <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-300">✕</button>
            </div>
            @endif

            <div class="relative bg-gray-900/50 border border-purple-500/20 rounded-3xl p-6 sm:p-10 overflow-hidden"
                 style="box-shadow:0 0 60px rgba(168,85,247,.1)">
                <div class="absolute top-0 left-0 w-32 h-32 bg-purple-600/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-cyan-600/10 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact_name" class="block text-sm font-medium text-gray-300 mb-1.5">Name *</label>
                                <input id="contact_name" name="name" type="text" value="{{ old('name') }}" required
                                       class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500"
                                       placeholder="Your name">
                                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-300 mb-1.5">Email *</label>
                                <input id="contact_email" name="email" type="email" value="{{ old('email') }}" required
                                       class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500"
                                       placeholder="your@email.com">
                                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label for="contact_subject" class="block text-sm font-medium text-gray-300 mb-1.5">Subject</label>
                            <input id="contact_subject" name="subject" type="text" value="{{ old('subject') }}"
                                   class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500"
                                   placeholder="What's this about?">
                        </div>
                        <div>
                            <label for="contact_message" class="block text-sm font-medium text-gray-300 mb-1.5">Message *</label>
                            <textarea id="contact_message" name="message" rows="4" required
                                      class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500 resize-none"
                                      placeholder="Your message...">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-4 pt-2">
                            <button type="submit"
                                    class="w-full sm:w-auto group flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 text-white font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-xl shadow-purple-500/30 hover:shadow-purple-500/50 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Send Message
                            </button>
                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <span>or</span>
                                @php $contactEmail = $about->email ?? $settings['site_email'] ?? null; @endphp
                                @if($contactEmail)
                                <a href="mailto:{{ $contactEmail }}"
                                   class="text-purple-400 hover:text-purple-300 underline underline-offset-2 decoration-purple-500/30 transition-colors">
                                    {{ $contactEmail }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(isset($socialMedias) && $socialMedias->isNotEmpty())
            <div class="mt-16 text-center">
                <p class="text-sm font-orbitron text-gray-500 mb-6 uppercase tracking-widest">Or find me on</p>
                <div class="flex flex-wrap justify-center gap-4">
                    @foreach($socialMedias as $i => $social)
                    <a href="{{ $social->url }}" target="_blank" title="{{ $social->platform }}"
                       class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-900 border border-purple-500/20 text-gray-400 hover:text-white hover:border-cyan-400 hover:bg-cyan-500/10 hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(6,182,212,0.3)] transition-all duration-300 group animate-float"
                       style="animation-delay: {{ $i * 0.15 }}s">
                        <i class="{{ $social->icon_class }} text-lg group-hover:scale-110 transition-transform"></i>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

</x-frontend-layout>