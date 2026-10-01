<div class="relative">

    {{-- soft ambient background --}}
    <div class="orb orb-b" style="opacity:.3"></div>
    <div class="orb orb-c" style="opacity:.25"></div>

    <div class="relative mx-auto max-w-7xl px-5 pb-24 pt-12 sm:px-8 lg:pt-16">

        {{-- ============================ heading ============================ --}}
        <div class="reveal mb-10 max-w-2xl" wire:key="heading-{{ app()->getLocale() }}">
            <p class="eyebrow mb-3">{{ __('site.shop.eyebrow') }}</p>
            <h1 class="display text-5xl font-semibold leading-[1.05] sm:text-[56px]">
                {!! __('site.shop.title_line1') !!}<br><em class="text-accent-deep">{!! __('site.shop.title_line2') !!}</em>
            </h1>
            <p class="mt-5 text-[16px] leading-relaxed text-muted">
                {{ __('site.shop.subtitle', ['count' => number_format($products->total())]) }}
            </p>
        </div>

        {{-- ============================ controls =========================== --}}
        <div class="sticky top-16 z-30 -mx-5 mb-10 border-y border-line-soft bg-ivory/85 px-5 py-3.5 backdrop-blur sm:-mx-8 sm:px-8">
            <div class="flex flex-wrap items-center gap-3">
                {{-- search --}}
                <div class="relative">
                    <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-faint"
                         fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/>
                    </svg>
                    <input type="search" wire:model.live.debounce.350ms="search" placeholder="{{ __('site.shop.search') }}"
                           class="field w-56 rounded-full py-2.5 pl-10 pr-4 text-[13.5px]">
                </div>

                {{-- category chips --}}
                <div class="flex flex-1 flex-wrap items-center gap-2">
                    <button class="chip" wire:click="setCategory('')" data-active="{{ $category === '' }}">{{ __('site.shop.all') }}</button>
                    @foreach ($categories as $c)
                        <button class="chip" wire:key="chip-{{ $c->slug }}-{{ app()->getLocale() }}"
                                wire:click="setCategory('{{ $c->slug }}')"
                                data-active="{{ $category === $c->slug }}">{{ $c->display_name }}</button>
                    @endforeach
                </div>

                {{-- sort --}}
                <select wire:model.live="sort"
                        class="field w-auto cursor-pointer rounded-full py-2.5 pl-4 pr-9 text-[13.5px] appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%236f6d64%22 stroke-width=%222%22 stroke-linecap=%22round%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E')] bg-[length:16px] bg-[right_0.75rem_center] bg-no-repeat">
                    <option value="featured">{{ __('site.shop.sort_featured') }}</option>
                    <option value="newest">{{ __('site.shop.sort_newest') }}</option>
                    <option value="price-asc">{{ __('site.shop.sort_price_asc') }}</option>
                    <option value="price-desc">{{ __('site.shop.sort_price_desc') }}</option>
                </select>
            </div>
        </div>

        {{-- ============================= grid ============================== --}}
        <div wire:loading.class="lw-loading" class="transition-opacity duration-200" wire:key="grid-{{ app()->getLocale() }}">
            @if ($products->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $i => $product)
                        @include('livewire.partials.product-card', ['product' => $product, 'delay' => ($i % 3) * 70])
                    @endforeach
                </div>

                <div class="mt-14">
                    {{ $products->onEachSide(1)->links('livewire.partials.pagination') }}
                </div>
            @else
                <div class="flex flex-col items-center gap-4 rounded-[26px] border border-dashed border-line bg-white/50 py-20 text-center">
                    <span class="flex h-16 w-16 items-center justify-center rounded-full bg-cream">
                        <svg viewBox="0 0 24 24" class="h-7 w-7 text-faint" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
                            <circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/>
                        </svg>
                    </span>
                    <div>
                        <p class="display text-xl">{{ __('site.shop.empty_title', ['search' => $search]) }}</p>
                        <p class="mt-1 text-sm text-muted">{{ __('site.shop.empty_body') }}</p>
                    </div>
                    <button wire:click="$set('search', '')" wire:click="$set('category', '')" class="btn-ghost mt-2 px-5 py-2.5 text-sm">
                        {{ __('site.shop.clear_filters') }}
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
