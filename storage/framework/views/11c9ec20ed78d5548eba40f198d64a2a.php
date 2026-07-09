<?php if (isset($component)) { $__componentOriginal49728f76f6574eefb81a3aaa880242ed = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49728f76f6574eefb81a3aaa880242ed = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend-layout','data' => ['settings' => $settings ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['settings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings ?? [])]); ?>


<div class="pointer-events-none fixed inset-0 z-[60] hidden lg:block"
     x-data="{ x: 0, y: 0 }"
     x-init="window.addEventListener('mousemove', e => { x = e.clientX; y = e.clientY })">
    <div class="absolute w-72 h-72 rounded-full blur-3xl transition-none"
         style="background: radial-gradient(circle, rgba(168,85,247,0.15) 0%, rgba(6,182,212,0.08) 40%, transparent 70%);"
         :style="`transform:translate(${x - 144}px,${y - 144}px)`"></div>
</div>


<style>
.shimmer-text{background:linear-gradient(90deg,#a855f7,#06b6d4,#a855f7);background-size:200% auto;-webkit-background-clip:text;background-clip:text;color:transparent;animation:shimmer 4s linear infinite}
@keyframes shimmer{to{background-position:200% center}}
.animate-glow-pulse{animation:glowPulse 2.5s ease-in-out infinite}
@keyframes glowPulse{0%,100%{box-shadow:0 0 15px rgba(168,85,247,.4),0 0 30px rgba(6,182,212,.15)}50%{box-shadow:0 0 25px rgba(168,85,247,.7),0 0 50px rgba(6,182,212,.3)}}
.animate-float{animation:floatY 3.5s ease-in-out infinite}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
.animate-gradient-x{background-size:200% 200%;animation:gradientX 3s ease infinite}
@keyframes gradientX{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
.meteor{position:absolute;width:2px;height:90px;background:linear-gradient(to bottom,rgba(168,85,247,.9),transparent);transform:rotate(35deg);animation:meteorFall 6s linear infinite;opacity:0;will-change:transform}
@keyframes meteorFall{0%{opacity:0;transform:translate(0,-100px) rotate(35deg)}10%{opacity:1}80%{opacity:1}100%{opacity:0;transform:translate(250px,400px) rotate(35deg)}}
.shine-sweep{background:linear-gradient(120deg,transparent 20%,rgba(255,255,255,.15) 50%,transparent 80%);background-size:200% 200%;background-position:-100% 0;transition:background-position .9s ease,opacity .3s}
.group:hover .shine-sweep{background-position:200% 0}
.tilt-card{will-change:transform}
/* counter number animation */
@keyframes countUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
.count-up{animation:countUp .5s ease forwards}

/* ── Hero background media (image or video) ── */
.hero-bg-media{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
@keyframes heroKenBurns{0%{transform:scale(1) translate(0,0)}100%{transform:scale(1.09) translate(-1.2%,-1%)}}
.hero-bg-kenburns{animation:heroKenBurns 22s ease-in-out infinite alternate}

/* ── Lanyard ID card ── */
.lanyard-hanger{width:60px;height:14px;border-radius:0 0 10px 10px;background:linear-gradient(to bottom,#1f2430,#0b0d12);box-shadow:0 2px 6px rgba(0,0,0,.5),inset 0 -2px 3px rgba(255,255,255,.05)}
.lanyard-strap{position:relative;width:26px;margin:0 auto;background:
    repeating-linear-gradient(135deg,#7e22ce 0 10px,#6d28d9 10px 20px),
    linear-gradient(90deg,#0b0d12 0%,rgba(0,0,0,0) 8%,rgba(0,0,0,0) 92%,#0b0d12 100%);
  box-shadow:inset 0 0 0 1px rgba(6,182,212,.25),0 4px 10px rgba(0,0,0,.35)}
.lanyard-strap::before{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(255,255,255,.18),transparent 30%)}
.lanyard-strap::after{content:'CLAUDE • PORTFOLIO • CLAUDE • PORTFOLIO';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(90deg);white-space:nowrap;font-family:'Orbitron',sans-serif;font-size:8px;letter-spacing:2px;color:rgba(255,255,255,.55);width:200px;text-align:center}
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
.skills-marquee-wrapper{overflow:hidden;mask-image:linear-gradient(to right,transparent,black 50px,black calc(100% - 50px),transparent);-webkit-mask-image:linear-gradient(to right,transparent,black 50px,black calc(100% - 50px),transparent)}
.skills-marquee-track{display:flex;gap:1.25rem;width:max-content;animation:scrollSkills 40s linear infinite}
.skills-marquee-wrapper:hover .skills-marquee-track{animation-play-state:paused}
@keyframes scrollSkills{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
</style>




<?php if($hero && $hero->status): ?>
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

    <?php
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
    ?>

    <?php $durations = $slides->map(fn($s) => $s->duration ?? 6500)->toJson(); ?>

    <?php if($slides->isNotEmpty()): ?>
    <div class="absolute inset-0 z-0 overflow-hidden bg-gray-950"
         x-data="{
             active: 0,
             count: <?php echo e($slides->count()); ?>,
             durations: <?php echo e($durations); ?>,
             timer: null,
             init(){
                 if(this.count > 1) this.next();
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
             destroy(){ clearInterval(this.timer); }
         }">
        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="absolute inset-0 transition-opacity duration-[1500ms] ease-in-out"
             :class="active === <?php echo e($i); ?> ? 'opacity-100 z-[1]' : 'opacity-0 z-0'">
            <template x-if="active === <?php echo e($i); ?>">
                <div class="absolute inset-0">
                    <?php if(($slide->type ?? 'image') === 'video'): ?>
                        <video class="hero-bg-media" autoplay muted loop playsinline preload="auto"
                               <?php if(!empty($slide->poster)): ?> poster="<?php echo e($slide->poster); ?>" <?php endif; ?>>
                            <source src="<?php echo e($slide->url); ?>" type="video/mp4">
                        </video>
                    <?php else: ?>
                        <img src="<?php echo e($slide->url); ?>" alt="" class="hero-bg-media hero-bg-kenburns" loading="<?php echo e($i === 0 ? 'eager' : 'lazy'); ?>" width="1920" height="1080">
                    <?php endif; ?>
                </div>
            </template>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="absolute inset-0 z-[2] bg-gradient-to-b from-gray-950/70 via-gray-950/50 to-gray-950"></div>
        <div class="absolute inset-0 z-[2] bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>

        <?php if($slides->count() > 1): ?>
        <div class="absolute bottom-24 left-1/2 -translate-x-1/2 z-[3] flex gap-2">
            <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" @click="goTo(<?php echo e($i); ?>)"
                    class="h-1.5 rounded-full transition-all duration-300"
                    :class="active === <?php echo e($i); ?> ? 'w-8 bg-purple-400' : 'w-1.5 bg-white/30 hover:bg-white/50'"
                    aria-label="Slide <?php echo e($i + 1); ?>"></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="absolute inset-0 cyber-grid opacity-40 z-0"
         :style="`transform:translate(${mx*8}px,${my*8}px)`"
         style="transition:transform .2s ease-out"></div>

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl animate-pulse z-0"
         :style="`transform:translate(${mx*-20}px,${my*-20}px)`" style="transition:transform .3s ease-out"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-cyan-600/20 rounded-full blur-3xl animate-pulse z-0"
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

        
        <div class="flex-1 text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
            <div class="inline-flex items-center gap-2 bg-purple-500/10 border border-purple-500/30 rounded-full px-4 py-1.5 mb-6 hover:border-purple-400/60 hover:bg-purple-500/20 transition-all duration-300">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-sm text-purple-300 font-orbitron tracking-wider">AVAILABLE FOR HIRE</span>
            </div>

            <h1 class="font-orbitron font-black text-5xl md:text-7xl leading-tight mb-4 text-white">
                <?php echo e($hero->name); ?>

            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-4 font-light"><?php echo e($hero->title); ?></p>

            
            <div class="text-xl md:text-2xl mb-8 font-orbitron"
                 x-data="{
                     texts:<?php echo e(json_encode(array_map('trim', explode(',', $hero->typing_text)))); ?>,
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

            
            <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                <?php if($hero->github_url): ?>
                <a href="<?php echo e($hero->github_url); ?>" target="_blank"
                   class="group relative flex items-center gap-2 border border-purple-500/50 hover:border-purple-400 text-gray-300 hover:text-white font-semibold py-3 px-6 rounded-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-500/20">
                    <div class="absolute inset-0 bg-purple-600/0 group-hover:bg-purple-600/20 transition-all duration-300"></div>
                    <svg class="w-5 h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                    <span class="relative z-10">GitHub</span>
                </a>
                <?php endif; ?>
                <?php if($hero->linkedin_url): ?>
                <a href="<?php echo e($hero->linkedin_url); ?>" target="_blank"
                   class="group relative flex items-center gap-2 border border-cyan-500/50 hover:border-cyan-400 text-gray-300 hover:text-white font-semibold py-3 px-6 rounded-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-cyan-500/20">
                    <div class="absolute inset-0 bg-cyan-600/0 group-hover:bg-cyan-600/20 transition-all duration-300"></div>
                    <span class="relative z-10">LinkedIn</span>
                </a>
                 <?php endif; ?>
                <?php if($hero->cv_url && $hero->cv_url !== '#'): ?>
                <a href="<?php echo e($hero->cv_url); ?>" target="_blank"
                   class="flex items-center gap-2 bg-gradient-to-r from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 text-white font-bold py-3 px-7 rounded-xl transition-all duration-300 shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:scale-105 animate-glow-pulse">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Download CV
                </a>
                <?php endif; ?>
            </div>
        </div>

        
        <?php if($hero->photo_url): ?>
        <div class="flex-shrink-0 relative flex flex-col items-center select-none"
             data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200"
             style="perspective:1200px">

            
            <div class="lanyard-hanger relative z-10"></div>

            
            <div class="relative"
                 style="transform-origin: top center; touch-action:none;"
                 x-data="{
                     angle:5, vel:0, dragging:false,
                     lastX:0, history:[], raf:null,
                     init(){
                         this.raf = requestAnimationFrame(()=>this.loop());
                         this.$el.addEventListener('pointerdown', this.startDrag.bind(this));
                     },
                     destroy(){ if(this.raf) cancelAnimationFrame(this.raf); },
                     loop(){
                         if(!this.dragging){
                             const now = performance.now();
                             const wind = Math.sin(now/2600) * 0.006 + Math.sin(now/970) * 0.003;
                             const restoring = -this.angle * 0.011;
                             const damping = -this.vel * 0.055;
                             this.vel += restoring + damping + wind;
                             this.angle += this.vel;
                         }
                         this.raf = requestAnimationFrame(()=>this.loop());
                     },
                     startDrag(e){
                         this.dragging = true; this.vel = 0;
                         this.lastX = e.clientX;
                         this.history = [{x:e.clientX, t:performance.now()}];
                         e.preventDefault();
                     },
                     onDrag(e){
                         if(!this.dragging) return;
                         const dx = e.clientX - this.lastX;
                         this.angle = Math.max(-60, Math.min(60, this.angle + dx * 0.4));
                         this.lastX = e.clientX;
                         this.history.push({x:e.clientX, t:performance.now()});
                         if(this.history.length > 6) this.history.shift();
                     },
                     endDrag(){
                         if(!this.dragging) return;
                         this.dragging = false;
                         if(this.history.length >= 2){
                             const first = this.history[0];
                             const last = this.history[this.history.length - 1];
                             const dt = Math.max(last.t - first.t, 16);
                             const speed = (last.x - first.x) / dt;
                             this.vel = Math.max(-8, Math.min(8, speed * 4));
                         }
                     }
                 }"
                 @pointermove.window="onDrag"
                 @pointerup.window="endDrag"
                 @pointercancel.window="endDrag"
                 :style="`transform: rotate(${angle}deg); cursor:${dragging ? 'grabbing' : 'grab'}`">

                
                <div class="lanyard-strap h-32 md:h-40 rounded-b-sm"></div>

                
                <div class="lanyard-clip -mt-1"></div>

                
                <div class="id-card -mt-1 mx-auto tilt-card">
                    <div class="card-sheen"></div>
                    <div class="id-punch"></div>

                    <div class="relative w-full aspect-square rounded-xl overflow-hidden border-2 border-purple-500/50"
                         style="box-shadow:0 0 20px rgba(168,85,247,.35)">
                        <img src="<?php echo e($hero->photo_url); ?>" alt="<?php echo e($hero->name); ?>" class="w-full h-full object-cover pointer-events-none" width="288" height="288" draggable="false">
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/30 to-transparent"></div>
                        <div class="absolute inset-0 opacity-20"
                             style="background:repeating-linear-gradient(0deg,transparent,transparent 3px,rgba(168,85,247,.1) 3px,rgba(168,85,247,.1) 4px)"></div>
                    </div>

                    <div class="mt-3 text-center">
                        <p class="font-orbitron text-sm font-bold text-white tracking-wide truncate"><?php echo e($hero->name); ?></p>
                        <p class="text-[11px] text-purple-300/80 truncate"><?php echo e($hero->title); ?></p>
                    </div>

                    <div class="mt-2 flex items-center justify-center gap-2 bg-gray-950/60 border border-purple-500/30 rounded-full px-3 py-1 whitespace-nowrap">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-orbitron text-green-400 tracking-widest">ONLINE</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 z-10 animate-bounce">
        <span class="text-xs font-orbitron text-gray-500 tracking-widest">SCROLL</span>
        <div class="w-0.5 h-8 bg-gradient-to-b from-purple-400 to-transparent"></div>
    </div>
</section>
<?php endif; ?>

<div class="cyber-divider"></div>




<?php if($about): ?>
<section id="about" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="cyber-grid absolute inset-0 opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ WHO AM I ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Me</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <?php if($about->photo_path): ?>
            <div class="relative flex justify-center" data-aos="fade-right">
                <div class="relative w-64 h-80 md:w-80 md:h-96 group">
                    <div class="absolute -inset-0.5 rounded-2xl bg-gradient-to-r from-purple-500 via-cyan-500 to-purple-500 opacity-0 group-hover:opacity-60 blur transition-opacity duration-500 animate-gradient-x"></div>
                    <div class="absolute -top-3 -left-3 w-10 h-10 border-t-2 border-l-2 border-purple-400 z-20"></div>
                    <div class="absolute -bottom-3 -right-3 w-10 h-10 border-b-2 border-r-2 border-cyan-400 z-20"></div>
                    <img src="<?php echo e($about->photo_url); ?>" alt="About Me"
                         class="relative w-full h-full object-cover rounded-2xl group-hover:scale-[1.02] transition-transform duration-500"
                         style="box-shadow:0 0 40px rgba(168,85,247,.2)" loading="lazy" width="320" height="384">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-gray-950/50 to-transparent"></div>
                </div>
            </div>
            <?php endif; ?>
            <div data-aos="fade-left">
                <p class="text-gray-400 text-lg leading-relaxed mb-8"><?php echo e($about->description); ?></p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php $__currentLoopData = [
                        ['icon'=>'📍','label'=>'Location','value'=>$about->location??null],
                        ['icon'=>'📧','label'=>'Email','value'=>$about->email??null],
                        ['icon'=>'🎂','label'=>'Age','value'=>$about->birth_date?$about->birth_date->age.' years old':null],
                        ['icon'=>'📱','label'=>'Phone','value'=>$about->phone??null],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($info['value']): ?>
                    <div class="flex items-center gap-3 p-3 bg-gray-900/50 border border-purple-500/10 rounded-xl hover:border-purple-500/40 hover:-translate-y-0.5 transition-all duration-300"
                         data-aos="fade-up" data-aos-delay="<?php echo e($k*80); ?>">
                        <span class="text-xl"><?php echo e($info['icon']); ?></span>
                        <div>
                            <p class="text-xs text-gray-500 font-orbitron uppercase tracking-wider"><?php echo e($info['label']); ?></p>
                            <p class="text-gray-200 text-sm font-medium"><?php echo e($info['value']); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<div class="cyber-divider"></div>




<?php if($services->isNotEmpty()): ?>
<section id="services" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-cyan-600/10 rounded-full blur-3xl -translate-y-1/2"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ WHAT I DO ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4">
                My <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Services</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cyber-card tilt-card bg-gray-900/60 border border-purple-500/10 rounded-2xl p-8 group relative overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(168,85,247,0.15)]"
                 data-aos="fade-up" data-aos-delay="<?php echo e(($key%3)*100); ?>"
                 x-data="{ rx:0,ry:0 }"
                 @mousemove="const r=$el.getBoundingClientRect();ry=(($event.clientX-r.left)/r.width-.5)*15;rx=-(($event.clientY-r.top)/r.height-.5)*15"
                 @mouseleave="rx=0;ry=0"
                 :style="`transform:perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg)`">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-purple-500/20 to-transparent rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="w-16 h-16 rounded-xl bg-gray-800/80 border border-purple-500/20 flex items-center justify-center mb-6 relative z-10 group-hover:border-purple-400/50 transition-colors">
                    <i class="<?php echo e($service->icon ?: 'bx bx-code-alt'); ?> text-3xl text-transparent bg-clip-text bg-gradient-to-br from-purple-400 to-cyan-400 group-hover:animate-pulse"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 relative z-10 font-orbitron"><?php echo e($service->name); ?></h3>
                <p class="text-gray-400 text-sm leading-relaxed relative z-10"><?php echo e($service->description); ?></p>
                
                <!-- Corner accents -->
                <div class="absolute top-4 left-4 w-2 h-2 border-t border-l border-purple-500/30 group-hover:border-purple-400 transition-colors"></div>
                <div class="absolute bottom-4 right-4 w-2 h-2 border-b border-r border-cyan-500/30 group-hover:border-cyan-400 transition-colors"></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<div class="cyber-divider"></div>
<?php endif; ?>




<?php if($skills->isNotEmpty()): ?>
<section id="skills" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-cyan-400 tracking-widest uppercase mb-2 block">[ MY ARSENAL ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4">
                Tech <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Skills</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>

        <div class="skills-marquee-wrapper" data-aos="fade-up">
            <div class="skills-marquee-track">
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('components.skill-card', ['skill' => $skill], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('components.skill-card', ['skill' => $skill], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<div class="cyber-divider"></div>




<section id="projects" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="cyber-grid absolute inset-0 opacity-20"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-purple-600/5 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ MY WORK ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4">
                Featured <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Projects</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto mb-4"></div>
            <p class="text-gray-400">A selection of my finest work.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('projects.show', $project->slug)); ?>"
               class="cyber-card tilt-card block bg-gray-900/60 border border-purple-500/10 rounded-2xl overflow-hidden group relative"
               data-aos="fade-up" data-aos-delay="<?php echo e(($loop->index%3)*120); ?>"
               x-data="{ rx:0,ry:0 }"
               @mousemove="const r=$el.getBoundingClientRect();ry=(($event.clientX-r.left)/r.width-.5)*10;rx=-(($event.clientY-r.top)/r.height-.5)*10"
               @mouseleave="rx=0;ry=0"
               :style="`transform:perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg);transition:transform .15s ease-out`">

                <div class="relative overflow-hidden h-52">
                    <?php if($project->thumbnail_url): ?>
                    <img src="<?php echo e($project->thumbnail_url); ?>" alt="<?php echo e($project->title); ?>"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy" width="416" height="208">
                    <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-purple-900/40 to-cyan-900/40 flex items-center justify-center">
                        <span class="font-orbitron text-purple-400 text-2xl">PROJECT</span>
                    </div>
                    <?php endif; ?>
                    <div class="absolute inset-0 shine-sweep opacity-0 group-hover:opacity-100"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>
                    <?php if($project->category): ?>
                    <span class="absolute top-3 left-3 bg-purple-600/80 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo e($project->category->name); ?>

                    </span>
                    <?php endif; ?>
                    <?php if($project->featured): ?>
                    <span class="absolute top-3 right-3 bg-cyan-500/80 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">⭐ FEATURED</span>
                    <?php endif; ?>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-lg text-white group-hover:text-purple-400 transition-colors mb-2"><?php echo e($project->title); ?></h3>
                    <?php if($project->technology_stack): ?>
                    <div class="flex flex-wrap gap-1.5 mt-3">
                        <?php $__currentLoopData = array_slice(explode(',', $project->technology_stack), 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-xs bg-gray-800 border border-purple-500/20 text-gray-400 px-2 py-0.5 rounded-md font-mono"><?php echo e(trim($tech)); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="mt-4 flex items-center gap-2 text-purple-400 text-sm group-hover:gap-3 transition-all">
                        <span>View Project</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 text-center py-20">
                <p class="font-orbitron text-gray-600">NO PROJECTS FOUND</p>
            </div>
            <?php endif; ?>
        </div>
        <?php if($projects->isNotEmpty()): ?>
        <div class="text-center mt-14" data-aos="fade-up">
            <a href="<?php echo e(route('projects.index')); ?>"
               class="group inline-flex items-center gap-3 relative overflow-hidden border border-purple-500/50 hover:border-purple-400 text-gray-300 hover:text-white font-orbitron font-bold py-3.5 px-10 rounded-xl transition-all duration-300 hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 to-cyan-600/0 group-hover:from-purple-600/20 group-hover:to-cyan-600/20 transition-all duration-300"></div>
                <span class="relative z-10">VIEW ALL PROJECTS</span>
                <svg class="w-4 h-4 relative z-10 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<div class="cyber-divider"></div>




<?php if($experiences->isNotEmpty() || $educations->isNotEmpty()): ?>
<section id="journey" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 cyber-grid opacity-10"></div>
    <div class="container mx-auto px-6 relative z-10 max-w-5xl">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="font-orbitron text-xs text-purple-400 tracking-widest uppercase mb-2 block">[ MY PATH ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4">
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
                    <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative pl-8 group" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-gray-900 border-2 border-purple-500 group-hover:bg-purple-500 transition-colors shadow-[0_0_10px_rgba(168,85,247,0.5)]"></div>
                        <div class="absolute left-0 top-3 w-8 h-[1px] bg-purple-500/20 group-hover:bg-purple-500/50 transition-colors"></div>
                        
                        <div class="bg-gray-900/40 border border-purple-500/10 rounded-xl p-6 hover:border-purple-400/30 transition-all duration-300 hover:-translate-y-1 hover:bg-gray-900/60 shadow-lg">
                            <span class="text-xs font-orbitron text-cyan-400 mb-2 block">
                                <?php echo e(\Carbon\Carbon::parse($exp->start_date)->format('M Y')); ?> - 
                                <?php echo e($exp->is_current ? 'Present' : \Carbon\Carbon::parse($exp->end_date)->format('M Y')); ?>

                            </span>
                            <h4 class="text-lg font-bold text-white"><?php echo e($exp->position); ?></h4>
                            <p class="text-purple-300 text-sm font-medium mb-3"><?php echo e($exp->company); ?></p>
                            <?php if($exp->description): ?>
                            <p class="text-gray-400 text-sm leading-relaxed"><?php echo e($exp->description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Education -->
            <div>
                <h3 class="text-2xl font-orbitron font-bold text-white mb-10 flex items-center gap-3" data-aos="fade-left">
                    <span class="w-8 h-8 rounded-full bg-cyan-500/20 border border-cyan-500/50 flex items-center justify-center text-cyan-400">🎓</span>
                    Education
                </h3>
                <div class="relative border-l border-cyan-500/20 ml-4 space-y-10">
                    <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative pl-8 group" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-gray-900 border-2 border-cyan-500 group-hover:bg-cyan-500 transition-colors shadow-[0_0_10px_rgba(6,182,212,0.5)]"></div>
                        <div class="absolute left-0 top-3 w-8 h-[1px] bg-cyan-500/20 group-hover:bg-cyan-500/50 transition-colors"></div>
                        
                        <div class="bg-gray-900/40 border border-cyan-500/10 rounded-xl p-6 hover:border-cyan-400/30 transition-all duration-300 hover:-translate-y-1 hover:bg-gray-900/60 shadow-lg">
                            <span class="text-xs font-orbitron text-purple-400 mb-2 block">
                                <?php echo e($edu->start_year); ?> - <?php echo e($edu->is_current ? 'Present' : $edu->end_year); ?>

                            </span>
                            <h4 class="text-lg font-bold text-white"><?php echo e($edu->degree ?? 'Degree'); ?></h4>
                            <p class="text-cyan-300 text-sm font-medium mb-1"><?php echo e($edu->institution); ?></p>
                            <?php if($edu->field_of_study): ?>
                            <p class="text-gray-500 text-xs mb-3"><?php echo e($edu->field_of_study); ?></p>
                            <?php endif; ?>
                            <?php if($edu->description): ?>
                            <p class="text-gray-400 text-sm leading-relaxed"><?php echo e($edu->description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="cyber-divider"></div>
<?php endif; ?>




<?php if($certificates->isNotEmpty()): ?>
<section id="certificates" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="font-orbitron text-xs text-cyan-400 tracking-widest uppercase mb-2 block">[ ACHIEVEMENTS ]</span>
            <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4">
                Licenses & <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Certifications</span>
            </h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto"></div>
        </div>
        
        <div class="flex flex-wrap justify-center gap-6">
            <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cyber-card group w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] bg-gray-900/60 border border-purple-500/10 rounded-2xl overflow-hidden hover:border-purple-400/40 transition-all duration-300 hover:-translate-y-1"
                 data-aos="zoom-in" data-aos-delay="<?php echo e(($loop->index%3)*100); ?>">
                <?php if($cert->image_path): ?>
                <div class="h-40 overflow-hidden border-b border-purple-500/10 relative">
                    <img src="<?php echo e(asset('storage/' . str_replace('public/', '', $cert->image_path))); ?>" alt="<?php echo e($cert->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" width="400" height="160">
                    <div class="absolute inset-0 bg-gray-950/20 group-hover:bg-transparent transition-colors"></div>
                </div>
                <?php endif; ?>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-white mb-1 leading-tight group-hover:text-cyan-400 transition-colors"><?php echo e($cert->name); ?></h3>
                    <p class="text-purple-400 text-sm font-medium mb-3"><?php echo e($cert->issuer); ?></p>
                    <div class="flex items-center justify-between text-xs text-gray-500 font-orbitron mb-4">
                        <span>Issued: <?php echo e(\Carbon\Carbon::parse($cert->issue_date)->format('M Y')); ?></span>
                        <?php if($cert->expiration_date): ?>
                        <span>Expires: <?php echo e(\Carbon\Carbon::parse($cert->expiration_date)->format('M Y')); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if($cert->credential_url): ?>
                    <a href="<?php echo e($cert->credential_url); ?>" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/5 hover:bg-white/10 px-4 py-2 rounded-lg transition-colors border border-white/10 hover:border-cyan-500/50 w-full justify-center">
                        View Credential
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<div class="cyber-divider"></div>
<?php endif; ?>




<section id="contact" class="relative py-28 bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 cyber-grid opacity-20"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
        <div class="max-w-5xl mx-auto">
            <div class="text-center">
                <span class="font-orbitron text-xs text-cyan-400 tracking-widest uppercase mb-2 block">[ LET'S CONNECT ]</span>
                <h2 class="font-orbitron font-bold text-4xl md:text-5xl text-white mb-4">
                    Get In <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">Touch</span>
                </h2>
                <div class="w-24 h-0.5 bg-gradient-to-r from-purple-500 to-cyan-500 mx-auto mb-8"></div>
                <p class="text-gray-400 text-lg leading-relaxed mb-10">
                    I'm currently available for freelance work and exciting collaborations.
                    Let's build something extraordinary together.
                </p>
            </div>

            <?php
                $hasContactInfo = !empty($settings['site_email']) || !empty($settings['site_phone']) || !empty($settings['site_address']);
                $hasMaps = !empty($settings['google_maps_embed']);
            ?>

            

            <?php if(session('contact_success')): ?>
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 x-transition
                 class="mb-8 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-4 rounded-2xl text-sm font-medium">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php echo e(session('contact_success')); ?>

                <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-300">✕</button>
            </div>
            <?php endif; ?>

            <div class="relative bg-gray-900/50 border border-purple-500/20 rounded-3xl p-6 sm:p-10 overflow-hidden"
                 style="box-shadow:0 0 60px rgba(168,85,247,.1)">
                <div class="absolute top-0 left-0 w-32 h-32 bg-purple-600/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-cyan-600/10 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="space-y-5">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact_name" class="block text-sm font-medium text-gray-300 mb-1.5">Name *</label>
                                <input id="contact_name" name="name" type="text" value="<?php echo e(old('name')); ?>" required
                                       class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500"
                                       placeholder="Your name">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-300 mb-1.5">Email *</label>
                                <input id="contact_email" name="email" type="email" value="<?php echo e(old('email')); ?>" required
                                       class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500"
                                       placeholder="your@email.com">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div>
                            <label for="contact_subject" class="block text-sm font-medium text-gray-300 mb-1.5">Subject</label>
                            <input id="contact_subject" name="subject" type="text" value="<?php echo e(old('subject')); ?>"
                                   class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500"
                                   placeholder="What's this about?">
                        </div>
                        <div>
                            <label for="contact_message" class="block text-sm font-medium text-gray-300 mb-1.5">Message *</label>
                            <textarea id="contact_message" name="message" rows="4" required
                                      class="w-full bg-gray-800/80 border border-purple-500/20 text-white rounded-xl px-4 py-3 text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition-colors placeholder-gray-500 resize-none"
                                      placeholder="Your message..."><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-4 pt-2">
                            <button type="submit"
                                    class="w-full sm:w-auto group flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-cyan-600 hover:from-purple-500 hover:to-cyan-500 text-white font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-xl shadow-purple-500/30 hover:shadow-purple-500/50 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Send Message
                            </button>
                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <span>or</span>
                                <?php $contactEmail = $about->email ?? $settings['site_email'] ?? null; ?>
                                <?php if($contactEmail): ?>
                                <a href="mailto:<?php echo e($contactEmail); ?>"
                                   class="text-purple-400 hover:text-purple-300 underline underline-offset-2 decoration-purple-500/30 transition-colors">
                                    <?php echo e($contactEmail); ?>

                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if(isset($socialMedias) && $socialMedias->isNotEmpty()): ?>
            <div class="mt-16 text-center">
                <p class="text-sm font-orbitron text-gray-500 mb-6 uppercase tracking-widest">Or find me on</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <?php $__currentLoopData = $socialMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($social->url); ?>" target="_blank" title="<?php echo e($social->platform); ?>"
                       class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-900 border border-purple-500/20 text-gray-400 hover:text-white hover:border-cyan-400 hover:bg-cyan-500/10 hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(6,182,212,0.3)] transition-all duration-300 group animate-float"
                       style="animation-delay: <?php echo e($i * 0.15); ?>s">
                        <i class="<?php echo e($social->icon_class); ?> text-lg group-hover:scale-110 transition-transform"></i>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49728f76f6574eefb81a3aaa880242ed)): ?>
<?php $attributes = $__attributesOriginal49728f76f6574eefb81a3aaa880242ed; ?>
<?php unset($__attributesOriginal49728f76f6574eefb81a3aaa880242ed); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49728f76f6574eefb81a3aaa880242ed)): ?>
<?php $component = $__componentOriginal49728f76f6574eefb81a3aaa880242ed; ?>
<?php unset($__componentOriginal49728f76f6574eefb81a3aaa880242ed); ?>
<?php endif; ?><?php /**PATH D:\FORTOFOLIO\portfolio-laravel\resources\views/welcome.blade.php ENDPATH**/ ?>