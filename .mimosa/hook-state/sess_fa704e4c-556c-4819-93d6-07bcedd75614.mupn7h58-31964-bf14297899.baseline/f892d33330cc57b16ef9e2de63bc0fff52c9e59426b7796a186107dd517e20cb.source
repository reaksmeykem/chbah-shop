{{-- expects $product and optional $delay (ms) --}}

<div class="tilt-scene reveal" data-reveal-delay="{{ $delay }}" wire:key="card-{{ $product->id }}-{{ app()->getLocale() }}">
    <article class="tilt-card group relative flex h-full flex-col rounded-[26px] border border-line-soft bg-white/80 p-3 shadow-soft transition-shadow duration-500 hover:shadow-lift"
             data-tilt>
        <div class="relative">
            <div class="art-frame aspect-square">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
            </div>

            @if ($product->badge)
                <span class="badge {{ $product->badge === 'New' ? 'badge-new' : 'badge-best' }} absolute left-4 top-4">
                    {{ $product->badge === 'New' ? __('site.hero.badge_new') : __('site.badge.bestseller') }}
                </span>
            @endif

            <a href="{{ route('product.show', $product->slug) }}" class="absolute inset-0 z-10"
               aria-label="{{ __('site.card.view', ['name' => $product->name]) }}"></a>

            <button wire:click="$dispatch('add-to-cart', { id: {{ $product->id }} })"
                    class="btn-primary absolute bottom-4 left-1/2 z-20 -translate-x-1/2 translate-y-16 px-5 py-2.5 text-[13px] opacity-0 transition-all duration-500 ease-out group-hover:translate-y-0 group-hover:opacity-100">
                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                {{ __('site.card.add_to_cart') }}
            </button>
        </div>

        <div class="flex flex-1 flex-col gap-1 px-2.5 pb-2 pt-4">
            <div class="flex items-baseline justify-between gap-3">
                <span class="eyebrow">{{ $product->category->display_name }} · v{{ $product->version }}</span>
                <span class="display text-[17px] font-semibold">{{ $product->price }}</span>
            </div>
            <a href="{{ route('product.show', $product->slug) }}"
               class="text-[15.5px] font-medium leading-snug transition-colors duration-300 hover:text-accent-deep">
                {{ $product->name }}
            </a>
            <p class="text-[13px] leading-relaxed text-muted">{{ $product->display_tagline }}</p>
        </div>
    </article>
</div>
