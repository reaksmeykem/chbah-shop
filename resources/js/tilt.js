/**
 * 3D tilt — cards marked [data-tilt] lean toward the cursor.
 * Pure transform work; the resting transition lives in CSS (.tilt-card).
 */
const MAX_TILT = 7;

export function initTilt(root = document) {
    root.querySelectorAll('[data-tilt]').forEach((card) => {
        if (card.__tiltBound) return;
        card.__tiltBound = true;

        const strength = parseFloat(card.dataset.tiltStrength || MAX_TILT);

        card.addEventListener('pointermove', (e) => {
            if (e.pointerType !== 'mouse') return;
            const r = card.getBoundingClientRect();
            const px = (e.clientX - r.left) / r.width - 0.5;
            const py = (e.clientY - r.top) / r.height - 0.5;
            card.classList.add('is-tilting');
            card.style.transform = `rotateX(${(-py * strength).toFixed(2)}deg) rotateY(${(px * strength).toFixed(2)}deg) translateZ(6px)`;
        });

        card.addEventListener('pointerleave', () => {
            card.classList.remove('is-tilting');
            card.style.transform = '';
        });
    });
}

const start = () => initTilt(document);
document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', start)
    : start();

document.addEventListener('livewire:navigated', start);
