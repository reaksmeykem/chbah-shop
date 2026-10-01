<div>
    <section class="relative overflow-hidden">
        <div class="orb orb-a" style="opacity:.35"></div>
        <div class="grain"></div>

        <div class="relative mx-auto max-w-7xl px-5 pb-20 pt-10 sm:px-8 lg:pt-14" wire:key="product-{{ $product->id }}-{{ app()->getLocale() }}">

            {{-- breadcrumb --}}
            <nav class="reveal mb-10 flex flex-wrap items-center gap-2 text-[13px] text-muted" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition-colors hover:text-ink">{{ __('site.product.home_crumb') }}</a>
                <span class="text-faint">/</span>
                <a href="{{ route('shop') }}" class="transition-colors hover:text-ink">{{ __('site.product.software_crumb') }}</a>
                <span class="text-faint">/</span>
                <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="transition-colors hover:text-ink">{{ $product->category->display_name }}</a>
                <span class="text-faint">/</span>
                <span class="text-ink">{{ $product->name }}</span>
            </nav>

            <div class="grid gap-12 lg:grid-cols-[1.05fr_1fr] lg:gap-16">

                {{-- ============================ artwork ============================ --}}
                <div class="tilt-scene reveal">
                    <div class="tilt-card relative overflow-hidden rounded-[32px] border border-line-soft bg-cream shadow-lift"
                         data-tilt data-tilt-strength="4">
                        <div class="aspect-square w-full">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        </div>
                        @if ($product->badge)
                            <span class="badge {{ $product->badge === 'New' ? 'badge-new' : 'badge-best' }} absolute left-6 top-6">
                                {{ $product->badge === 'New' ? __('site.hero.badge_new') : __('site.badge.bestseller') }}
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 grid grid-cols-3 gap-4">
                        <div class="rounded-2xl border border-line-soft bg-white/70 px-4 py-3.5 text-center">
                            <p class="display text-[15px] font-semibold">v{{ $product->version }}</p>
                            <p class="mt-0.5 text-[11.5px] leading-snug text-muted">{{ __('site.product.version_label') }}</p>
                        </div>
                        <div class="rounded-2xl border border-line-soft bg-white/70 px-4 py-3.5 text-center">
                            <p class="display text-[15px] font-semibold">Windows</p>
                            <p class="mt-0.5 text-[11.5px] leading-snug text-muted">{{ $product->requirements }}</p>
                        </div>
                        <div class="rounded-2xl border border-line-soft bg-white/70 px-4 py-3.5 text-center">
                            <p class="display text-[15px] font-semibold">{{ __('site.product.offline_short') }}</p>
                            <p class="mt-0.5 text-[11.5px] leading-snug text-muted">{{ __('site.product.offline_label') }}</p>
                        </div>
                    </div>
                </div>

                {{-- ============================== info ============================= --}}
                <div class="reveal" data-reveal-delay="120" x-data="{ details: false }">
                    <span class="eyebrow">{{ $product->category->display_name }}</span>
                    <h1 class="display mt-3 text-4xl font-semibold leading-[1.06] sm:text-[44px]">{{ $product->name }}</h1>
                    <p class="serif-italic mt-3 text-lg text-accent-deep">{{ $product->display_tagline }}</p>

                    <p class="mt-6 text-[15.5px] leading-relaxed text-ink-soft">{{ $product->display_description }}</p>

                    {{-- features --}}
                    <ul class="mt-7 space-y-2.5">
                        @foreach ($product->display_features as $feature)
                            <li class="flex items-start gap-2.5 text-[14.5px] text-ink-soft">
                                <svg viewBox="0 0 24 24" class="mt-0.5 h-4.5 w-4.5 shrink-0 text-sage-deep" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4.5 12.5l5 5 10-11"/>
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-8 flex flex-wrap items-baseline gap-3">
                        <span class="display text-4xl font-semibold">{{ $product->price }}</span>
                        <span class="text-[13px] text-faint">{{ __('site.product.price_note') }}</span>
                    </div>

                    {{-- qty + add --}}
                    <div class="mt-8 flex flex-wrap items-center gap-3.5">
                        <div class="flex items-center gap-2 rounded-full border border-line bg-white/70 px-2 py-1.5">
                            <button class="qty-btn h-9 w-9" @click="$wire.qty = Math.max(1, $wire.qty - 1)">−</button>
                            <span class="w-8 text-center text-[15px] font-medium">{{ $qty }}</span>
                            <button class="qty-btn h-9 w-9" @click="$wire.qty = $wire.qty + 1">+</button>
                        </div>

                        <button wire:click="add" class="btn-primary flex-1 px-8 py-4 text-[15px] sm:flex-none">
                            {{ __('site.card.add_to_cart') }} — {{ $product->price }}
                        </button>
                    </div>
                    <p class="mt-3 flex items-center gap-2 text-[13px] text-muted">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent"></span>
                        {{ __('site.product.instant_delivery') }}
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ $product->download_url }}" class="btn-ghost px-6 py-3 text-sm">
                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 4v11M7 10l5 5 5-5M5 20h14"/>
                            </svg>
                            {{ __('site.product.download_trial', ['version' => $product->version]) }}
                        </a>
                        <a href="{{ route('license') }}" class="btn-ghost px-6 py-3 text-sm">{{ __('site.product.own_it') }}</a>
                    </div>
                    <p wire:loading.delay class="mt-3 text-[13px] text-muted">{{ __('site.product.adding') }}</p>

                    {{-- license terms accordion --}}
                    <div class="mt-10 divide-y divide-line-soft border-y border-line-soft">
                        <button class="flex w-full items-center justify-between py-4 text-left" @click="details = !details">
                            <span class="text-[14.5px] font-medium">{{ __('site.product.license_title') }}</span>
                            <svg viewBox="0 0 24 24" class="h-4 w-4 text-muted transition-transform duration-300"
                                 :class="details && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </button>
                        <div x-show="details" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                            <dl class="grid gap-3 py-5 text-[14px]">
                                <div class="flex gap-4"><dt class="w-28 shrink-0 text-faint">{{ __('site.product.system') }}</dt><dd>{{ $product->requirements }}</dd></div>
                                <div class="flex gap-4"><dt class="w-28 shrink-0 text-faint">{{ __('site.product.license') }}</dt><dd>{{ __('site.product.license_terms') }}</dd></div>
                                <div class="flex gap-4"><dt class="w-28 shrink-0 text-faint">{{ __('site.product.delivery') }}</dt><dd>{{ __('site.product.delivery_terms') }}</dd></div>
                                <div class="flex gap-4"><dt class="w-28 shrink-0 text-faint">{{ __('site.product.refunds') }}</dt><dd>{{ __('site.product.refund_terms') }}</dd></div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================= related ============================= --}}
    @if ($related->count())
        <section class="border-t border-line-soft bg-parchment/70">
            <div class="mx-auto max-w-7xl px-5 py-20 sm:px-8">
                <div class="reveal mb-10 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="eyebrow mb-3">{{ __('site.product.keep_looking') }}</p>
                        <h2 class="display text-3xl font-semibold sm:text-4xl">{{ __('site.product.more_category', ['category' => $product->category->display_name]) }}</h2>
                    </div>
                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="btn-ghost px-5 py-2.5 text-sm">
                        {{ __('site.product.all_category', ['category' => $product->category->display_name]) }}
                    </a>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $i => $rel)
                        @include('livewire.partials.product-card', ['product' => $rel, 'delay' => $i * 80])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
