{{-- Floating help widget: expands to Telegram / email options. --}}
<div x-data="{ open: false }" class="fixed bottom-5 right-5 z-40 sm:bottom-6 sm:right-6">

    {{-- expanded options --}}
    <div x-show="open" x-cloak
         x-transition:enter="transition duration-300 ease-[cubic-bezier(0.16,1,0.3,1)]"
         x-transition:enter-start="opacity-0 translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition duration-200 ease-in"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 translate-y-3 scale-95"
         class="absolute bottom-16 right-0 w-64 rounded-[22px] border border-line-soft bg-ivory/95 p-4 shadow-pop backdrop-blur"
         role="dialog" aria-label="{{ __('site.support.open') }}">

        <p class="display text-[15px] font-semibold">{{ __('site.support.title') }}</p>
        <p class="mt-1 text-[12.5px] leading-snug text-muted">{{ __('site.support.body') }}</p>

        <a href="{{ config('site.telegram') }}" target="_blank" rel="noopener"
           class="mt-3.5 flex items-center gap-2.5 rounded-xl bg-accent px-3.5 py-2.5 text-[13px] font-medium text-ivory transition hover:bg-accent-hover">
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="currentColor">
                <path d="M21.9 4.6 19 19.3c-.2 1-.8 1.2-1.6.8l-4.5-3.3-2.2 2.1c-.2.2-.4.4-.9.4l.3-4.6 8.4-7.6c.4-.3-.1-.5-.6-.2L7.5 13.2 3.1 11.8c-1-.3-1-1 .2-1.5l17.3-6.7c.8-.3 1.5.2 1.3 1z"/>
            </svg>
            {{ __('site.support.telegram') }}
        </a>

        <a href="mailto:{{ config('site.email') }}"
           class="mt-2 flex items-center gap-2.5 rounded-xl border border-line px-3.5 py-2.5 text-[13px] font-medium text-ink-soft transition hover:border-ink/30 hover:bg-cream">
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16v12H4z"/><path d="M4 7l8 6 8-6"/>
            </svg>
            {{ __('site.support.email') }}
        </a>
    </div>

    {{-- launcher --}}
    <button @click="open = !open"
            class="relative flex h-13 w-13 items-center justify-center rounded-full bg-ink text-ivory shadow-pop transition-all duration-300 hover:scale-105"
            :aria-expanded="open" aria-label="{{ __('site.support.open') }}">
        <span class="absolute inset-0 rounded-full bg-ink opacity-20 ping-slow" x-show="!open"></span>

        <svg x-show="!open" viewBox="0 0 24 24" class="h-5.5 w-5.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5c-1.6 0-3.1-.4-4.4-1.2L3 20l1.2-5.1A8.5 8.5 0 1 1 21 11.5z"/>
            <path d="M8.5 10.5h7M8.5 13.5h4.5"/>
        </svg>

        <svg x-show="open" x-cloak viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
            <path d="M6 6l12 12M18 6L6 18"/>
        </svg>
    </button>
</div>
