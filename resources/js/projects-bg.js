export function initProjectsBackground() {
    const bg = document.querySelector('[data-projects-bg]');
    if (!bg) return;

    const react = bg.querySelector('[data-bg-react]');
    const grid = bg.querySelector('[data-bg-grid]');
    const glows = Array.from(bg.querySelectorAll('[data-bg-glow]'));
    const canvas = bg.querySelector('[data-bg-canvas]');
    const ctx = canvas.getContext('2d');

    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const mqMobile = window.matchMedia('(max-width: 767px)');
    const mobile = mqMobile.matches;

    let vw = 0, vh = 0, dpr = 1, running = true;
    let t0 = performance.now();
    let raf = null;

    let particles = [];
    // Jumlah partikel dikurangi — sprite pre-render membuat tiap partikel jauh lebih murah.
    const count = mobile ? 28 : 56;
    const PALETTE = ['124,58,237', '8,145,178', '30,64,175', '139,92,246'];

    // ── Sprite pre-render: gradient radial digambar SEKALI per warna ke
    //    offscreen canvas, lalu tiap frame cukup drawImage (10-20x lebih
    //    murah daripada membuat createRadialGradient per partikel/frame).
    const SPRITE_SIZE = 64;
    const sprites = PALETTE.map((rgb) => {
        const c = document.createElement('canvas');
        c.width = c.height = SPRITE_SIZE;
        const sctx = c.getContext('2d');
        const grad = sctx.createRadialGradient(
            SPRITE_SIZE / 2, SPRITE_SIZE / 2, 0,
            SPRITE_SIZE / 2, SPRITE_SIZE / 2, SPRITE_SIZE / 2
        );
        grad.addColorStop(0, 'rgba(' + rgb + ',1)');
        grad.addColorStop(0.3, 'rgba(' + rgb + ',0.32)');
        grad.addColorStop(1, 'rgba(' + rgb + ',0)');
        sctx.fillStyle = grad;
        sctx.fillRect(0, 0, SPRITE_SIZE, SPRITE_SIZE);
        return c;
    });

    function resize() {
        vh = window.innerHeight;
        dpr = Math.min(window.devicePixelRatio || 1, mobile ? 1.5 : 2);
        const rect = bg.getBoundingClientRect();
        vw = rect.width;
        const h = rect.height;
        canvas.width = Math.round(vw * dpr);
        canvas.height = Math.round(h * dpr);
        canvas.style.width = vw + 'px';
        canvas.style.height = h + 'px';
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        particles = [];
        for (let i = 0; i < count; i++) {
            particles.push({
                x: Math.random() * vw,
                y: Math.random() * Math.max(h, vh),
                r: 0.5 + Math.random() * (mobile ? 1.3 : 1.9),
                vx: (Math.random() - 0.5) * 0.12,
                vy: -0.05 - Math.random() * (mobile ? 0.1 : 0.18),
                a: 0.10 + Math.random() * 0.25,
                tw: 0.6 + Math.random() * 2.4,
                ph: Math.random() * Math.PI * 2,
                sp: sprites[Math.floor(Math.random() * sprites.length)],
                depth: 0.4 + Math.random() * 0.6,
            });
        }
    }

    function tick(now) {
        const t = (now - t0) / 1000;
        const sy = window.scrollY;
        const stageTop = bg.getBoundingClientRect().top + sy;
        const pg = (sy - stageTop) / Math.max(1, vh * 3);   // -..0..+ across the pinned section
        const slowed = pg * 0.35;                            // bg jauh lebih lambat dari kartu

        // 1) Subtle animated gradient — slow breathing + scroll drift
        const rx = Math.sin(t * 0.08) * 6 - slowed * 14;
        const ry = Math.cos(t * 0.11) * 7 + slowed * 36;
        react.style.transform = 'translate3d(' + rx.toFixed(2) + 'px,' + ry.toFixed(2) + 'px,0) scale(1.12)';

        // 2) Futuristic grid — parallax + tiny drift
        const gx = slowed * -10 + Math.sin(t * 0.05) * 3;
        grid.style.transform = 'translate3d(' + gx.toFixed(2) + 'px,' + slowed.toFixed(2) * 20 + 'px,0)';

        // 3) Ambient glows — each drifts independently
        for (let i = 0; i < glows.length; i++) {
            const g = glows[i];
            const travel = slowed * (90 + i * 40) * (i % 2 ? 1 : -1);
            const ox = Math.sin(t * 0.12 + i * 2.1) * 46;
            const oy = Math.cos(t * 0.09 + i * 1.7) * 38;
            g.style.transform = 'translate3d(' + (ox + travel * 0.6).toFixed(2) + 'px,' + (oy + travel * 0.4).toFixed(2) + 'px,0)';
        }

        // 4) Floating particles — drawImage dari sprite (bukan gradient per frame)
        ctx.clearRect(0, 0, vw, vh);
        ctx.globalCompositeOperation = 'lighter';
        const rise = slowed * 260;   // whole field drifts up slowly with scroll
        for (const p of particles) {
            if (!reduced) {
                p.x += p.vx * 0.4;
                p.y += p.vy;
                if (p.y < -6) { p.y = vh + 6; p.x = Math.random() * vw; }
                if (p.x < -6) p.x = vw + 6;
                if (p.x > vw + 6) p.x = -6;
            }
            const y = p.y + rise * p.depth;
            const yw = ((y % vh) + vh) % vh;
            const alpha = reduced ? p.a : p.a * (0.72 + 0.28 * Math.sin(t * p.tw + p.ph));
            const glow = p.r * 5;
            ctx.globalAlpha = alpha;
            ctx.drawImage(p.sp, p.x - glow, yw - glow, glow * 2, glow * 2);
        }
        ctx.globalAlpha = 1;
        ctx.globalCompositeOperation = 'source-over';

        if (running) raf = requestAnimationFrame(tick);
    }

    resize();
    t0 = performance.now();
    running = false; // start() dipicu IntersectionObserver di bawah

    const start = () => {
        if (running) return;
        running = true;
        t0 = performance.now();
        raf = requestAnimationFrame(tick);
    };
    const stop = () => {
        running = false;
        if (raf) { cancelAnimationFrame(raf); raf = null; }
    };

    // Only paint while the section is near the viewport.
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => (e.isIntersecting ? start() : stop()));
        }, { rootMargin: '600px 0px' });
        io.observe(bg);
    } else {
        start();
    }

    let resizeT;
    window.addEventListener('resize', () => {
        clearTimeout(resizeT);
        resizeT = setTimeout(() => { resize(); if (!running) start(); }, 150);
    }, { passive: true });
}
