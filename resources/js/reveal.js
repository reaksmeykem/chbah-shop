/**
 * Scroll reveal — elements with .reveal fade/rise in as they enter the
 * viewport. Optional data-reveal-delay="120" staggers siblings.
 * Re-scans after every Livewire update so paginated/filtered
 * content animates too.
 */
export function initReveal(root = document) {
    const els = root.querySelectorAll('.reveal:not(.is-visible):not(.reveal-bound)');
    if (!els.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -6% 0px' },
    );

    els.forEach((el) => {
        el.classList.add('reveal-bound');
        if (el.dataset.revealDelay) {
            el.style.setProperty('--reveal-delay', `${el.dataset.revealDelay}ms`);
        }
        // content already on screen at load reveals immediately
        const r = el.getBoundingClientRect();
        if (r.top < window.innerHeight * 0.92) {
            el.classList.add('is-visible');
        } else {
            observer.observe(el);
        }
    });
}

const start = () => initReveal(document);
document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', start)
    : start();

document.addEventListener('livewire:navigated', start);

window.Livewire?.hook('commit', ({ succeed }) => {
    succeed(() => queueMicrotask(() => initReveal(document)));
});
