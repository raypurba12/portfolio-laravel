/**
 * Visitor Notes — interactive scene
 *
 * Robot = focal point di tengah. Sticky notes dekoratif mengepit kiri/kanan.
 *
 * - DESKTOP (≥900px): notes masuk BERSAMAAN dari kiri & kanan robot
 *   (transform translateX + opacity + scale), lalu berhenti di posisi
 *   stabil di samping robot. Scroll-reversible.
 * - MOBILE (<900px): SECTION DI-PIN persis Projects — saat user sampai ke
 *   bagian robot, ROBOT BERHENTI DI TEMPAT (sticky 100vh; stage diberi
 *   runway (count+1)x100vh). Selama user scroll, sticky notes muncul SATU
 *   PER SATU di zona bawah robot (fade in/out di tempat: satu fokus, sisanya
 *   tersembunyi). Setelah semua note habis, pin dilepas → user baru bisa
 *   lanjut scroll ke section berikutnya. Robot/notes tidak pernah saling
 *   menutup. Logika (ARRIVE/LEAVE/HOLD, opacity, scale, brightness, easing)
 *   diadaptasi dari projects-showcase.js.
 *
 * Prinsip: layout diatur CSS (flex) — JS HANYA menggerakkan transform,
 * opacity, dan z-index. Hasil konsisten di Chrome / Edge / Firefox.
 *
 * ── Optimasi performa ──
 * • Tidak ada requestAnimationFrame loop permanen: update HANYA saat scroll/
 *   resize (throttled via satu rAF). Saat idle → 0% CPU.
 * • Speech bubble typing hanya berjalan saat section terlihat (Intersection-
 *   Observer); otomatis berhenti saat off-screen.
 */

const MOBILE_BREAKPOINT = 899;

const clamp01 = (v) => Math.max(0, Math.min(1, v));

function easeInOutCubic(t) {
    return t < 0.5
        ? 4 * t * t * t
        : 1 - Math.pow(-2 * t + 2, 3) / 2;
}

export function initVisitorNotes() {
    const section = document.getElementById('visitor-notes');
    if (!section) return;

    const bubble = section.querySelector('[data-vn-bubble]');
    const bubbleText = section.querySelector('[data-vn-bubble-text]');
    const notes = Array.from(section.querySelectorAll('[data-vn-note]'));

    // String ucapan robot diambil dari Blade (data-vn-copy) agar mengikuti
    // bahasa aktif; fallback EN hanya untuk keadaan darurat.
    let copy = {
        hi: 'Hi there! 👋',
        welcome: 'Welcome to my guestbook.',
        thanks: 'Thanks, :name! ❤️',
    };
    try {
        if (section.dataset.vnCopy) {
            copy = { ...copy, ...JSON.parse(section.dataset.vnCopy) };
        }
    } catch (e) { /* pakai fallback */ }

    const defaultCopy = [copy.hi, copy.welcome];

    // Delay float tiap note agar tidak serempak.
    notes.forEach((n, i) => n.style.setProperty('--d', `${i * 0.12}s`));

    // Catatan: gerakan note DI SINI bersifat scroll-driven (dikendalikan
    // user via scroll) — bukan auto-animasi — jadi tetap dijalankan walau
    // prefers-reduced-motion aktif. (Auto-animasi seperti float/glow tetap
    // dimatikan lewat CSS di media prefers-reduced-motion.)
    // Reveal dipasang di .vn-scene (sesuai selector CSS `.vn-scene.is-revealed`)
    // DAN di section — sebelumnya hanya di section sehingga collage & form
    // tetap opacity:0 (robot/notes tidak pernah muncul).
    (section.querySelector('[data-vn-section]') || section).classList.add('is-revealed');
    section.classList.add('is-revealed');

    initScrollNotes(section, notes);
    initSpeechBubble(section, bubble, bubbleText, defaultCopy);
}

/* ══════════════════════════════════════════════════════════════
   Speech bubble — typing effect, hanya saat section terlihat
   ══════════════════════════════════════════════════════════════ */
function initSpeechBubble(section, bubble, bubbleText, defaultCopy) {
    if (!bubble || !bubbleText) return;

    let runId = 0;      // token pembatal: dinaikkan saat section keluar viewport

    const successName = (section.dataset.vnSuccess || '').trim();

    async function typeLine(id, text) {
        bubbleText.textContent = '';
        for (let i = 0; i < text.length; i++) {
            if (id !== runId) return;
            bubbleText.textContent += text[i];
            await delay(36);
        }
    }

    async function speechLoop(id, lines, holdMs) {
        while (id === runId) {
            for (const line of lines) {
                if (id !== runId) return;
                bubble.classList.add('is-on');
                await typeLine(id, line);
                await delay(holdMs);
            }
            // Ulangi pesan default terus menerus.
            if (lines.length > defaultCopy.length) {
                lines = defaultCopy.slice();
            } else {
                await delay(650);
            }
        }
    }

    function start() {
        runId++;
        const id = runId;
        const intro = successName
            ? [String(copy.thanks).replace(':name', successName), ...defaultCopy]
            : defaultCopy.slice();
        setTimeout(() => {
            if (id === runId) speechLoop(id, intro, successName ? 4300 : 2800);
        }, 900);
    }

    function stop() {
        runId++;
        bubble.classList.remove('is-on');
    }

    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((en) => {
                if (en.isIntersecting) start();
                else stop();
            });
        }, { rootMargin: '100px 0px', threshold: 0 });
        io.observe(bubble);
    } else {
        start(); // fallback browser lawas
    }
}

/**
 * Scroll-linked motion untuk sticky notes.
 * Hanya transform + opacity + z-index (layout tetap dari CSS/flex).
 */
function initScrollNotes(section, notes) {
    if (!notes.length) return;

    const collage = section.querySelector('[data-vn-collage]') || section;
    const scene = section.querySelector('[data-vn-section]') || collage;
    const pin = section.querySelector('[data-vn-pin]') || scene;

    // Urutan tayang dipakai berulang — cache di luar frame loop.
    const ordered = notes
        .slice()
        .sort((a, b) => (+a.dataset.vnIndex || 0) - (+b.dataset.vnIndex || 0));

    // --- Pin mobile (pola Projects): .vn-scene = STAGE (runway (count+1)x100vh,
    //     di-flow dulu → tinggi sintetis memberinya jalur lari scroll); di dalamnya
    //     .vn-pin = sticky 100vh berisi robot+notes+form. Saat pin aktif robot
    //     BERHENTI DI TEMPAT dan note muncul satu per satu; setelah note habis
    //     (runway habis) pin lepas → user baru bisa lanjut scroll. ---
    let sceneTop = 0;
    let maxVh = 0;
    let vh = window.innerHeight || 1;
    let pinned = false;

    function measure() {
        vh = window.innerHeight || 1;
        if (window.innerWidth <= MOBILE_BREAKPOINT) {
            scene.style.height = (ordered.length + 1) * vh + 'px';
            pin.classList.add('vn-pinned');
            pinned = true;
            const rect = scene.getBoundingClientRect();
            sceneTop = rect.top + window.scrollY; // posisi absolut di dokumen
            maxVh = ordered.length;
        } else {
            scene.style.height = '';
            pin.classList.remove('vn-pinned');
            pinned = false;
            sceneTop = 0;
            maxVh = 0;
        }
    }

    let lastMobile = null;

    /**
     * DESKTOP: masuk bersamaan dari kiri/kanan lalu berhenti stabil.
     * Notes tidak bergerak melewati robot — hanya settle di sampingnya.
     */
    function animateDesktop(p) {
        const left = ordered.filter((n) => n.dataset.vnSide === 'l').slice(0, 2);
        const right = ordered.filter((n) => n.dataset.vnSide === 'r').slice(0, 2);

        const WINDOW_START = 0.06;
        const WINDOW_END = 0.5;
        const t = clamp01((p - WINDOW_START) / (WINDOW_END - WINDOW_START));
        const e = easeInOutCubic(t);

        // Jarak masuk menyesuaikan viewport agar tidak keluar section.
        const inDist = Math.min(70, Math.max(36, window.innerWidth * 0.06));

        const apply = (el, dir) => {
            el.style.transform =
                `translate3d(${(dir * inDist * (1 - e)).toFixed(1)}px, ${(-10 * (1 - e)).toFixed(1)}px, 0) ` +
                `scale(${(0.9 + 0.1 * e).toFixed(4)}) rotate(${(dir * 5 * (1 - e)).toFixed(2)}deg)`;
            el.style.opacity = e.toFixed(4);
            el.style.zIndex = '1';
        };

        left.forEach((el) => apply(el, -1));
        right.forEach((el) => apply(el, 1));
    }

    /**
     * MOBILE (only): runs the SAME sequential scroll concept as Projects.
     *   - sv = seberapa jauh runway terscroll (satuan viewport). Note ke-n
     *     "difokus" saat sv = n+1; ARRIVE/LEAVE/HOLD dalam satuan viewport.
     *   - setiap note muncul SATU per satu DI TEMPAT (zona bawah robot):
     *     fade in → fokus penuh → fade out. Tidak ada gerak vertikal
     *     keluar zona; CSS translate:-50% -50% menjaga note tetap terpusat.
     *   - hanya note aktif yang terlihat; sisanya visibility:hidden.
     */
    function animateMobile(sv) {
        const count = ordered.length;
        if (!count) return;

        const ARRIVE = 0.8;   // satuan viewport — persis Projects
        const LEAVE = 0.45;
        const HOLD = 0.0;
        const entryScale0 = 0.6;
        const exitScale1 = 0.8;
        const exitBright = 0.9;

        ordered.forEach((el, i) => {
            const rel = sv - (i + 1);   // 0 = note ini "difokus"
            const pre = rel + 1;        // 0 = belum waktunya (tersembunyi)

            // Tampilkan semua note (override display:none fallback statis CSS);
            // visibility/opacity tetap diatur per-note di bawah.
            el.style.display = 'block';

            if (pre <= 0) {
                // Belum waktunya: tersembunyi di zona.
                el.style.transform = 'scale(' + entryScale0.toFixed(4) + ')';
                el.style.opacity = '0';
                el.style.visibility = 'hidden';
                el.style.filter = 'none';
                el.style.zIndex = '1';
                return;
            }

            let sc, op, br;
            if (pre < 1) {
                // Arrival: membesar + mengeras di tempat — pArr seperti Projects.
                const pArr = clamp01(pre / ARRIVE);
                sc = entryScale0 + (1 - entryScale0) * pArr;
                op = Math.pow(pArr, 1.25);
                br = 1;
            } else if (rel <= HOLD) {
                // Fokus: penuh di tengah zona.
                sc = 1;
                op = 1;
                br = 1;
            } else {
                // Leave: mengecil + fade out perlahan di tempat.
                const l = clamp01((rel - HOLD) / LEAVE);
                sc = 1 - (1 - exitScale1) * l;
                op = (1 - l) * (1 - l);
                br = 1 - (1 - exitBright) * l;
            }

            el.style.transform = 'scale(' + sc.toFixed(4) + ')';
            el.style.opacity = op.toFixed(3);
            el.style.visibility = '';
            el.style.filter = br < 1 ? 'brightness(' + br.toFixed(3) + ')' : 'none';
            el.style.zIndex = '1'; // selalu di bawah canvas robot (z-index 2)
        });
    }

    // Satu update per event — tanpa rAF loop permanen (0 CPU saat idle).
    let rafId = null;
    function update() {
        rafId = null;

        const mobile = window.innerWidth <= MOBILE_BREAKPOINT;

        // Reset kembali jika mode viewport berubah (mencegah transform lama menumpuk).
        if (lastMobile !== null && lastMobile !== mobile) {
            ordered.forEach((n) => {
                n.style.transform = '';
                n.style.opacity = '0';
                n.style.zIndex = '';
                n.style.visibility = '';
                n.style.filter = '';
            });
        }
        lastMobile = mobile;

        if (mobile) {
            if (!pinned) measure(); // mode berubah di tengah run → ukur ulang
            // Robot DIAM (dipin). sv = seberapa jauh runway sudah terscroll
            // dalam satuan viewport — persis Projects: note ke-n fokus di sv=n+1.
            const sv = Math.max(-1, Math.min(maxVh, (window.scrollY - sceneTop) / vh));
            animateMobile(sv);
        } else {
            animateDesktop(elementProgress(section));
        }
    }

    function schedule() {
        if (rafId === null) rafId = requestAnimationFrame(update);
    }

    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', () => { measure(); schedule(); }, { passive: true });
    window.addEventListener('load', () => { measure(); schedule(); });

    measure();
    update();

    // Jika section sudah terlihat saat load (mis. navigasi #visitor-notes),
    // pastikan posisi ter-hit ulang setelah font/layout settle.
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(() => { measure(); schedule(); }).catch(() => {});
    }
}

function elementProgress(el) {
    if (!el) return 0;
    const rect = el.getBoundingClientRect();
    const vh = window.innerHeight || 1;
    // 0 saat elemen baru menyentuh bawah viewport, 1 saat keluar atas.
    return clamp01((vh - rect.top) / (vh + rect.height));
}

function delay(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}
