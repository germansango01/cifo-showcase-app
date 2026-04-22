/* ══════════════════════════════════════════════════════════
   MAIN.JS — CIFO Violeta Showcase
   Universal entry point. Imports all modules and initializes
   them based on the current page context.
   ══════════════════════════════════════════════════════════ */

import { initScrollAnimations, initStatsCounter } from './scroll-animations.js';
import { initLazyLoad } from './lazy-load.js';

// menu.js runs on all pages (hamburger + header scroll shadow)
import './menu.js';

// ── Page detection ────────────────────────────────────────
const path = window.location.pathname;
const isHome = path.endsWith('index.html') || path.endsWith('/');
const isProjects = path.includes('projects.html');
const isProjectDetail = path.includes('project-detail.html');

// ── Home page — modal for featured cards ─────────────────
if (isHome) {
    import('./modal.js');
}

// ── Projects page — filters + modal + back-to-top ────────
if (isProjects) {
    import('./filters.js');
    import('./modal.js');
    import('./back-to-top.js');
}

// ── Project detail — populates the page from data ────────
// project-detail.js auto-executes and calls initLazyLoad() internally
if (isProjectDetail) {
    import('./project-detail.js');
}

// ── Universal: scroll animations + lazy load ─────────────
document.addEventListener('DOMContentLoaded', () => {
    initScrollAnimations();
    initStatsCounter();

    // Lazy load is already called inside project-detail.js; skip on that page
    if (!isProjectDetail) {
        initLazyLoad();
    }
});
