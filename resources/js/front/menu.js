/* ══════════════════════════════════════════════════════════
   MENU.JS — CIFO Violeta Showcase
   Mobile hamburger menu + header scroll shadow
   ══════════════════════════════════════════════════════════ */

const header = document.querySelector('.site-header');
const toggle = document.querySelector('.menu-toggle');
const mobileNav = document.querySelector('.mobile-nav');
const mobileLinks = document.querySelectorAll('.mobile-nav-link');

// Create overlay element
const overlay = document.createElement('div');
overlay.className = 'mobile-overlay';
document.body.appendChild(overlay);

/* ─────────────────────────────────────────
   MOBILE MENU TOGGLE
   ───────────────────────────────────────── */
function openMenu() {
    mobileNav.classList.add('is-open');
    overlay.classList.add('is-visible');
    mobileNav.removeAttribute('aria-hidden');
    toggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('scroll-lock');
    mobileLinks[0]?.focus();
}

function closeMenu() {
    mobileNav.classList.remove('is-open');
    overlay.classList.remove('is-visible');
    mobileNav.setAttribute('aria-hidden', 'true');
    toggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('scroll-lock');
}

function isMenuOpen() {
    return mobileNav.classList.contains('is-open');
}

if (toggle && mobileNav) {
    toggle.addEventListener('click', () => {
        isMenuOpen() ? closeMenu() : openMenu();
    });

    // Close on any mobile nav link click
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Close on Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && isMenuOpen()) {
            closeMenu();
            toggle.focus();
        }
    });

    // Close on overlay click
    overlay.addEventListener('click', () => {
        closeMenu();
    });

    // Wire up close button inside the panel
    const closeBtn = mobileNav.querySelector('.mobile-close-btn');
    closeBtn?.addEventListener('click', () => {
        closeMenu();
        toggle.focus();
    });
}

/* ─────────────────────────────────────────
   HEADER SCROLL SHADOW
   ───────────────────────────────────────── */
if (header) {
    const sentinel = document.createElement('div');
    sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
    document.body.prepend(sentinel);

    const observer = new IntersectionObserver(
        ([entry]) => {
            header.classList.toggle('is-scrolled', !entry.isIntersecting);
        },
        { threshold: 0 }
    );

    observer.observe(sentinel);
}
