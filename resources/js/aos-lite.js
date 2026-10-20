/**
 * AOS-lite — pengganti ringan AOS dari unpkg.
 * Mencakup semua varian yang dipakai situs ini: fade-up, fade-down,
 * fade-left, fade-right, zoom-in (+ atribut data-aos-duration / data-aos-delay).
 *
 * - Hanya animasi transform + opacity (compositor-friendly).
 * - Sekali jalan (once), berbasis IntersectionObserver.
 * - Menghormati prefers-reduced-motion (konten langsung tampil).
 */

const CSS = `
[data-aos]{opacity:0;transition-property:opacity,transform;transition-timing-function:cubic-bezier(.215,.61,.355,1);transition-duration:.8s}
[data-aos="fade-up"]{transform:translate3d(0,100px,0)}
[data-aos="fade-down"]{transform:translate3d(0,-100px,0)}
[data-aos="fade-right"]{transform:translate3d(100px,0,0)}
[data-aos="fade-left"]{transform:translate3d(-100px,0,0)}
[data-aos="zoom-in"]{transform:scale(.6)}
[data-aos].aos-animate{opacity:1;transform:none}
@media (prefers-reduced-motion:reduce){[data-aos]{opacity:1;transform:none;transition:none}}
`;

export function initAosLite() {
    const els = document.querySelectorAll('[data-aos]');
    if (!els.length) return;

    if (
        window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
        !('IntersectionObserver' in window)
    ) {
        els.forEach((el) => el.classList.add('aos-animate'));
        return;
    }

    const style = document.createElement('style');
    style.id = 'aos-lite-style';
    style.textContent = CSS;
    document.head.appendChild(style);

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            io.unobserve(el);

            if (el.dataset.aosDelay) el.style.transitionDelay = el.dataset.aosDelay + 'ms';
            if (el.dataset.aosDuration) el.style.transitionDuration = el.dataset.aosDuration + 'ms';

            // Double rAF agar transisi pasti terpicu setelah state awal ter-render.
            requestAnimationFrame(() => requestAnimationFrame(() => {
                el.classList.add('aos-animate');
                el.addEventListener('transitionend', () => {
                    el.style.transitionDelay = '';
                    el.style.willChange = 'auto';
                }, { once: true });
            }));
        });
    }, { rootMargin: '0px 0px -120px 0px', threshold: 0 });

    els.forEach((el) => io.observe(el));
}
