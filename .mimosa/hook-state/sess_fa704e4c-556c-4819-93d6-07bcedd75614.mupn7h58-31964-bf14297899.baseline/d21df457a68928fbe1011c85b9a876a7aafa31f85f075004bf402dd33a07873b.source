<button x-data @click="$dispatch('open-cart')"
        class="relative flex h-10 w-10 items-center justify-center rounded-full border border-line bg-white/70 transition-all duration-300 hover:border-ink/30 hover:bg-cream"
        aria-label="{{ __('site.nav.open_cart') }}">
    <svg viewBox="0 0 24 24" class="h-[18px] w-[18px]" fill="none" stroke="currentColor" stroke-width="1.7"
         stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 8h12l1.2 12.2a1.6 1.6 0 0 1-1.6 1.8H6.4a1.6 1.6 0 0 1-1.6-1.8L6 8z"/>
        <path d="M9 10V6.5a3 3 0 0 1 6 0V10"/>
    </svg>
    @if ($count)
        <span class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-accent px-1 text-[11px] font-semibold text-ivory shadow-sm"
              wire:key="badge-{{ $count }}">{{ $count }}</span>
    @endif
</button>
