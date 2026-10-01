/**
 * First-party analytics + cookie consent.
 *
 * The consent cookie (`chbah_consent=all|essential`) is set by the banner.
 * While consent is 'all', every page view (initial + Livewire navigations)
 * is POSTed to /analytics/track. Server-side events (product views, cart,
 * purchases…) are written by the Analytics service after the same cookie.
 */
const CONSENT_COOKIE = 'chbah_consent';

function consentValue() {
    const match = document.cookie.split('; ').find((c) => c.startsWith(CONSENT_COOKIE + '='));

    return match ? match.split('=')[1] : null;
}

function track(event, payload = {}) {
    if (consentValue() !== 'all') return;

    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    fetch('/analytics/track', {
        method: 'POST',
        keepalive: true,
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}),
        },
        body: JSON.stringify({ event, url: window.location.pathname + window.location.search, ...payload }),
    }).catch(() => {});
}

function trackPageView() {
    track('page_view');
}

// ---- cookie banner (Alpine component used by <x-cookie-banner>) -----------

document.addEventListener('alpine:init', () => {
    window.Alpine.data('cookieBanner', () => ({
        visible: false,
        details: false,

        init() {
            this.visible = consentValue() === null;
        },

        choose(value) {
            const oneYear = 60 * 60 * 24 * 365;
            document.cookie = `${CONSENT_COOKIE}=${value}; path=/; max-age=${oneYear}; samesite=lax`;
            this.visible = false;

            if (value === 'all') {
                trackPageView();
            }
        },
    }));
});

// ---- lifecycle --------------------------------------------------------------

const start = () => trackPageView();

document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', start)
    : start();

document.addEventListener('livewire:navigated', trackPageView);

window.addEventListener('analytics:enabled', trackPageView, { once: true });
