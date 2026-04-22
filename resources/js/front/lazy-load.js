/**
 * Lazy load module — IntersectionObserver-based image loading.
 * Targets img elements with a data-src attribute.
 * Adds .is-loaded class after the image loads for fade-in effect.
 */

/**
 * Initialize lazy loading on all img[data-src] elements within a root.
 * @param {Document|Element} root - Scope for the selector (defaults to document)
 */
export function initLazyLoad(root = document) {
    const images = Array.from(root.querySelectorAll('img[data-src]'));
    if (!images.length) return;

    // Fallback for browsers without IntersectionObserver
    if (!('IntersectionObserver' in window)) {
        images.forEach((img) => {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
            img.classList.add('is-loaded');
        });
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');

                img.addEventListener('load', () => img.classList.add('is-loaded'), { once: true });
                img.addEventListener('error', () => img.classList.add('is-loaded'), { once: true });

                observer.unobserve(img);
            });
        },
        { rootMargin: '0px 0px 200px 0px' }
    );

    images.forEach((img) => observer.observe(img));
}
