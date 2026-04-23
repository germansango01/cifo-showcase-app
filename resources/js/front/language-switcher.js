/**
 * resources/js/front/language-switcher.js
 *
 * Language switcher UI feedback.
 * Actual locale change is handled server-side via route /language/{locale}.
 * This module only manages the aria-pressed state visually.
 */

document.querySelectorAll('.lang-switcher').forEach((switcher) => {
    const options = switcher.querySelectorAll('.lang-switcher-option');

    options.forEach((opt) => {
        opt.addEventListener('click', () => {
            options.forEach((o) => o.setAttribute('aria-pressed', 'false'));
            opt.setAttribute('aria-pressed', 'true');
        });

        // Keyboard support
        opt.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                opt.click();
            }
        });
    });
});
