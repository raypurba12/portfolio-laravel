export function initProjectsShowcase() {
    const stage = document.querySelector('[data-projects-stage]');
    if (!stage) return;

    const sticky = stage.querySelector('[data-projects-sticky]');
    const slides = Array.from(stage.querySelectorAll('[data-projects-slide]'));
    const title = sticky.querySelector('[data-projects-title]');
    const count = slides.length;
    if (!sticky || !count) return;

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const clamp = (v, a, b) => Math.min(b, Math.max(a, v));
    const clamp01 = v => (v < 0 ? 0 : v > 1 ? 1 : v);

    let vh = window.innerHeight;
    let stageTop = 0;
    let maxScroll = 0;

    // ── Phase windows (fractions of one viewport of user scroll) ──
    // Arrival spans 0.8 of a viewport: hidden at 0%, small by ~20%,
    // ~75% by 40%, ~90% by 60%, FULL by 80%, then holds to 100%.
    const ARRIVE = 0.8;   // rel -1 → -0.2 : card rises, grows, sharpens
    const LEAVE = 0.45;   // rel  0 → +0.45 : leaves upward
    const HOLD = 0.0;     // rel -0.2 → 0   : stays full while focused

    const o = {
        reduced: reducedMotion,
        mobile: window.matchMedia('(max-width: 767px)').matches,
    };

    o.entryY = (o.mobile ? 0.7 : 0.8) * vh;   // start below the fold, peeks early
    o.exitY = (o.mobile ? 0.7 : 0.85) * vh;   // leave well above the fold
    o.entryScale0 = o.mobile ? 0.6 : 0.5;
    o.exitScale1 = o.mobile ? 0.8 : 0.75;
    o.entryBlur = o.mobile ? 0 : 8;
    o.exitBlur = o.mobile ? 0 : 4;
    o.exitBright = o.mobile ? 0.9 : 0.85;
    o.entryRot = o.mobile ? 0 : 0.6;
    o.exitRot = o.mobile ? 0 : -0.6;

    function measure() {
        vh = window.innerHeight;
        stage.style.height = (count + 1) * vh + 'px';
        requestAnimationFrame(measurePositions);
    }

    function measurePositions() {
        const rect = stage.getBoundingClientRect();
        stageTop = rect.top + window.scrollY;
        maxScroll = count * vh;
    }

    // State for one card based on its progress toward focus.
    // arrive p (0→1): comes from below, small, faint    -> full at p = 1
    // leave  l (0→1): goes above, shrinks, fades        -> gone at l = 1
    // Outside both windows the card is 100% hidden.
    function stateOf(rel) {
        const p = rel + 1;            // 0 at pure bottom, 1 at focus
        let st;
        if (p <= 0) {                 // not yet arrived: fully below
            st = { y: o.entryY, sc: o.entryScale0, op: 0, bl: o.entryBlur, br: 1, rot: o.entryRot, hidden: true };
        } else if (p < 1) {           // arriving (finishes at rel = -0.2)
            const pArr = clamp01(p / ARRIVE);
            st = {
                y: o.entryY * (1 - pArr),
                sc: o.entryScale0 + (1 - o.entryScale0) * pArr,
                op: Math.pow(pArr, 1.25),
                bl: o.entryBlur * (1 - pArr),
                br: 1,
                rot: o.entryRot * (1 - pArr),
                hidden: false,
            };
        } else if (rel <= HOLD) {     // at focus (rel = 0): full, sharp, centered
            st = { y: 0, sc: 1, op: 1, bl: 0, br: 1, rot: 0, hidden: false };
        } else {                      // leaving upward
            const l = clamp01((rel - HOLD) / LEAVE);
            st = {
                y: -o.exitY * l,
                sc: 1 - (1 - o.exitScale1) * l,
                op: (1 - l) * (1 - l),
                bl: o.exitBlur * l,
                br: 1 - (1 - o.exitBright) * l,
                rot: o.exitRot * l,
                hidden: false,
            };
        }
        if (o.reduced) { st.bl = 0; st.br = 1; st.rot = 0; }
        return st;
    }

    let raf = null;
    function onScroll() {
        if (raf) return;
        raf = requestAnimationFrame(update);
    }

    function update() {
        raf = null;
        const s = clamp(window.scrollY - stageTop, 0, maxScroll);

        // ── Title drift: rides the FIRST card's arrival, then stays gone ──
        if (title) {
            const t = clamp01((s / vh) / ARRIVE);   // 0 at pin, 1 by 80% scroll
            const ty = -(o.mobile ? 0.14 : 0.16) * vh * t;
            const opT = Math.pow(1 - t, 1.15);
            title.style.transform =
                'translate3d(0,' + ty.toFixed(2) + 'px,0) scale(' + (1 - 0.06 * t).toFixed(4) + ')';
            title.style.opacity = opT.toFixed(3);
            title.style.willChange = 'transform, opacity';
        }

        for (let i = 0; i < count; i++) {
            const slide = slides[i];
            // Focus of project i occurs at s = (i + 1) * vh.
            const rel = (s / vh) - (i + 1);
            const st = stateOf(rel);

            const filters = [];
            if (!o.reduced) {
                if (st.br < 1) filters.push('brightness(' + st.br.toFixed(3) + ')');
                if (st.bl > 0.01) filters.push('blur(' + st.bl.toFixed(2) + 'px)');
            }

            slide.style.transform =
                'translate3d(0,' + st.y.toFixed(2) + 'px,0) ' +
                'scale(' + st.sc.toFixed(4) + ') ' +
                'rotate(' + st.rot.toFixed(2) + 'deg)';
            slide.style.opacity = st.op.toFixed(3);
            slide.style.filter = filters.length ? filters.join(' ') : 'none';
            slide.style.visibility = st.hidden ? 'hidden' : '';
            // Closest to focus (rel nearest 0) sits on top.
            slide.style.zIndex = String(Math.round(1000 - Math.abs(rel) * 100));
        }
    }

    stage.classList.add('js-init');
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', measure, { passive: true });
    window.addEventListener('load', measure);

    measure();
    update();
}