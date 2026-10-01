{{-- Consent banner: shown until a choice is stored in the chbah_consent cookie. --}}
<div x-data="cookieBanner" x-cloak
     x-show="visible"
     x-transition:enter="transition duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]"
     x-transition:enter-start="opacity-0 translate-y-6"
     x-transition:enter-end="opacity-100 translate-y-0"
     class="fixed inset-x-4 bottom-4 z-[60] sm:inset-x-auto sm:right-5 sm:max-w-md"
     role="dialog" aria-live="polite" aria-label="{{ __('site.cookies.title') }}">

    <div class="relative overflow-hidden rounded-[24px] border border-line-soft bg-ivory/95 p-5 shadow-pop backdrop-blur">
        <div class="grain"></div>

        <div class="relative">
            <div class="flex items-start gap-3.5">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-cream">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 text-ochre" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 1 1-9-9c0 2 1.5 3.5 3.5 3.5H17a4 4 0 0 1 4 4z"/>
                        <circle cx="9" cy="10" r="1.1" fill="currentColor" stroke="none"/>
                        <circle cx="13.5" cy="14.5" r="1.1" fill="currentColor" stroke="none"/>
                        <circle cx="8.5" cy="15.5" r="1.1" fill="currentColor" stroke="none"/>
                    </svg>
                </span>
                <div>
                    <h2 class="display text-[16px] font-semibold leading-snug">{{ __('site.cookies.title') }}</h2>
                    <p class="mt-1.5 text-[13px] leading-relaxed text-muted">{{ __('site.cookies.body') }}</p>
                </div>
            </div>

            <button class="mt-3 flex items-center gap-1.5 pl-0.5 text-[12.5px] font-medium text-ink-soft link-underline"
                    @click="details = !details" :aria-expanded="details">
                {{ __('site.cookies.details_label') }}
                <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 transition-transform duration-300" :class="details && 'rotate-180'"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </button>
            <p x-show="details" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
               class="mt-2 rounded-xl border border-line-soft bg-white/70 px-3.5 py-3 text-[12.5px] leading-relaxed text-muted">
                {{ __('site.cookies.details') }}
            </p>

            <div class="mt-4 flex flex-wrap gap-2.5">
                <button @click="choose('all')" class="btn-primary flex-1 px-5 py-2.5 text-[13.5px]">
                    {{ __('site.cookies.accept') }}
                </button>
                <button @click="choose('essential')" class="btn-ghost flex-1 px-5 py-2.5 text-[13.5px]">
                    {{ __('site.cookies.essential') }}
                </button>
            </div>
        </div>
    </div>
</div>
