import '../css/visitor-notes.css';

import Alpine from 'alpinejs';
import { chatbot } from './chatbot';
import { initProjectsShowcase } from './projects-showcase';
import { initProjectsBackground } from './projects-bg';
import { initVisitorNotes } from './visitor-notes';
import { initAosLite } from './aos-lite';

window.Alpine = Alpine;
window.chatbot = chatbot;

Alpine.start();

// Scroll-reveal ringan (pengganti AOS unpkg).
initAosLite();

// Muat Three.js robot secara lazy hanya saat section Visitor Notes mendekat.
function initVisitorRobotLazy() {
    const section = document.getElementById('visitor-notes');
    if (!section) return;

    let loading = false;
    const load = () => {
        if (loading) return;
        loading = true;
        io.disconnect();
        import('./visitor-robot').then((m) => m.initVisitorRobot());
    };

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) load();
        });
    }, { rootMargin: '500px', threshold: 0 });
    io.observe(section);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initProjectsShowcase();
        initProjectsBackground();
        initVisitorNotes();
        initVisitorRobotLazy();
    });
} else {
    initProjectsShowcase();
    initProjectsBackground();
    initVisitorNotes();
    initVisitorRobotLazy();
}
