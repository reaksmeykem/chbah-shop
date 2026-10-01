<div x-data="{ open: false, justAdded: '' }"
     @cart-added.window="open = true; justAdded = $event.detail.name"
     @open-cart.window="open = true; justAdded = ''"
     @close-cart.window="open = false; justAdded = ''"
     @keydown.escape.window="open = false; justAdded = ''">

    {{-- backdrop --}}
    <div x-show="open" x-cloak
         x-transition:enter="transition duration-400 ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-300 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="cart-backdrop fixed inset-0 z-50 bg-ink/35 backdrop-blur-[2px]"
         @click="open = false; justAdded = ''"></div>

    {{-- panel --}}
    <aside x-show="open" x-cloak
           x-transition:enter="transition duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]"
           x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
           x-transition:leave="transition duration-300 ease-in"
           x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
           class="cart-panel fixed right-0 top-0 z-50 flex h-dvh w-full max-w-md flex-col border-l border-line-soft bg-ivory"
           style="box-shadow: -30px 0 80px -30px rgb(20 20 19 / .25)">

        <header class="flex items-center justify-between border-b border-line-soft px-6 py-5">
            <div>
                <h2 class="display text-xl font-semibold">
                    @if ($step === 'success') {{ __('site.cart.your_licenses') }} @else {{ __('site.cart.your_cart') }} @endif
                </h2>
                <p class="text-[13px] text-muted">
                    @if ($step === 'success')
                        {{ count($issuedKeys) === 1 ? __('site.cart.key_delivered', ['count' => count($issuedKeys)]) : __('site.cart.keys_delivered', ['count' => count($issuedKeys)]) }}
                    @else
                        {{ $count === 0 ? __('site.cart.empty_note') : __('site.cart.licenses_count', ['count' => $count]) }}
                    @endif
                </p>
            </div>
            <button @click="open = false; justAdded = ''"
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-line transition hover:border-ink/30 hover:bg-cream"
                    aria-label="{{ __('site.nav.close_cart') }}">
                <svg viewBox="0 0 24 24" class="h-4.5 w-4.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>
            </button>
        </header>

        <div x-show="justAdded" x-cloak
             x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
             class="border-b border-line-soft bg-accent-soft px-6 py-3">
            <p class="flex items-center gap-2 text-[13px] font-medium text-accent-deep">
                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4.5 12.5l5 5 10-11"/>
                </svg>
                {{ __('site.cart.added') }} “<span x-text="justAdded"></span>”
            </p>
        </div>

        {{-- ============================ success step ============================ --}}
        @if ($step === 'success')
            <div class="flex-1 overflow-y-auto px-6 py-6">
                <div class="mb-6 flex items-center gap-3.5">
                    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-accent text-ivory">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4.5 12.5l5 5 10-11"/>
                        </svg>
                    </span>
                    <div>
                        <p class="display text-lg font-semibold">{{ __('site.cart.order_complete') }}</p>
                        <p class="text-[13px] text-muted">{{ __('site.cart.valid_for', ['email' => $email]) }}</p>
                    </div>
                </div>

                <ul class="space-y-4">
                    @foreach ($issuedKeys as $i => $item)
                        <li class="rounded-2xl border border-line-soft bg-white/80 p-4" wire:key="key-{{ $i }}">
                            <div class="flex items-center justify-between">
                                <p class="text-[14px] font-medium">{{ $item['product'] }} <span class="text-faint">· v{{ $item['version'] }}</span></p>
                                @if ($item['download'])
                                    <a href="{{ $item['download'] }}" class="text-[12px] font-medium text-accent-deep link-underline">{{ __('site.cart.download') }}</a>
                                @endif
                            </div>
                            <div class="mt-2.5 flex items-center gap-2" x-data="{ copied: false }">
                                <code class="flex-1 rounded-xl border border-line bg-cream/70 px-3 py-2.5 font-mono text-[13px] tracking-wide select-all">{{ $item['key'] }}</code>
                                <button class="qty-btn h-10 shrink-0 px-3 text-[12px] font-medium"
                                        @click="navigator.clipboard.writeText('{{ $item['key'] }}'); copied = true; setTimeout(() => copied = false, 1600)">
                                    <span x-show="!copied">{{ __('site.cart.copy') }}</span>
                                    <span x-show="copied" x-cloak class="text-sage-deep">{{ __('site.cart.copied') }}</span>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <p class="mt-6 text-[12.5px] leading-relaxed text-muted">
                    {{ __('site.cart.keep_keys') }}
                    <a href="{{ route('license') }}" @click="open = false" class="link-underline text-ink">{{ __('site.nav.check_license') }}</a>.
                </p>
            </div>

            <footer class="border-t border-line-soft bg-cream/50 px-6 py-5">
                <button @click="open = false" class="btn-ink w-full py-3.5 text-sm">{{ __('site.cart.continue') }}</button>
            </footer>

        {{-- ============================== cart step ============================== --}}
        @else
            <div class="flex-1 overflow-y-auto px-6 py-5">
                @if ($lines->isEmpty())
                    <div class="flex h-full flex-col items-center justify-center gap-5 text-center">
                        <span class="flex h-24 w-24 items-center justify-center rounded-full bg-cream">
                            <svg viewBox="0 0 24 24" class="h-10 w-10 text-faint" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 8h12l1.2 12.2a1.6 1.6 0 0 1-1.6 1.8H6.4a1.6 1.6 0 0 1-1.6-1.8L6 8z"/>
                                <path d="M9 10V6.5a3 3 0 0 1 6 0V10"/>
                            </svg>
                        </span>
                        <div>
                            <p class="display text-lg">{{ __('site.cart.empty_title') }}</p>
                            <p class="mt-1 text-sm text-muted">{{ __('site.cart.empty_body') }}</p>
                        </div>
                        <button @click="open = false" class="btn-primary px-6 py-3 text-sm">{{ __('site.cart.browse') }}</button>
                    </div>
                @else
                    <ul class="space-y-5">
                        @foreach ($lines as $i => $line)
                            @php $product = $line['product']; @endphp
                            <li class="flex gap-4" wire:key="cart-{{ $product->id }}">
                                <a href="{{ route('product.show', $product->slug) }}" @click="open = false" class="shrink-0">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                         class="h-20 w-20 rounded-2xl border border-line-soft bg-cream object-cover">
                                </a>
                                <div class="flex flex-1 flex-col">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <a href="{{ route('product.show', $product->slug) }}" @click="open = false"
                                               class="text-[14.5px] font-medium leading-snug hover:text-accent-deep">{{ $product->name }}</a>
                                            <p class="mt-0.5 text-[12px] text-faint">{{ __('site.cart.lifetime_each', ['price' => number_format($product->price_cents / 100, 0)]) }}</p>
                                        </div>
                                        <button wire:click="remove({{ $product->id }})"
                                                class="mt-0.5 text-faint transition-colors hover:text-accent-deep" aria-label="Remove">
                                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round">
                                                <path d="M6 6l12 12M18 6L6 18"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mt-auto flex items-center justify-between pt-2">
                                        <div class="flex items-center gap-1">
                                            <button wire:click="decrease({{ $product->id }})" class="qty-btn h-8 w-8" aria-label="Less">−</button>
                                            <span class="w-8 text-center text-sm font-medium">{{ $line['qty'] }}</span>
                                            <button wire:click="increase({{ $product->id }})" class="qty-btn h-8 w-8" aria-label="More">+</button>
                                        </div>
                                        <span class="text-[14px] font-semibold">${{ number_format($product->price_cents * $line['qty'] / 100, 0) }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <button wire:click="clear" class="mt-7 text-[13px] text-faint underline-offset-4 transition-colors hover:text-accent-deep hover:underline">
                        {{ __('site.cart.empty_cart') }}
                    </button>
                @endif
            </div>

            @if ($lines->isNotEmpty())
                <footer class="border-t border-line-soft bg-cream/50 px-6 py-5">
                    <div class="mb-1.5 flex items-center justify-between text-sm">
                        <span class="text-muted">{{ __('site.cart.subtotal') }}</span>
                        <span class="display text-xl font-semibold">{{ $subtotal }}</span>
                    </div>
                    <p class="mb-4 text-[12px] text-faint">{{ __('site.cart.instant_note') }}</p>

                    <form wire:submit="checkout" class="space-y-3">
                        <input type="email" wire:model="email" placeholder="{{ __('site.cart.email_placeholder') }}" class="field rounded-full">
                        @error('email') <p class="-mt-1 pl-2 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                        @error('checkout') <p class="-mt-1 pl-2 text-[12px] text-accent-deep">{{ $message }}</p> @enderror

                        <button type="submit" class="btn-primary w-full py-3.5 text-sm" wire:loading.attr="disabled">
                            {{ __('site.cart.checkout') }}
                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </button>
                    </form>
                    <p class="mt-3 text-center text-[11.5px] text-faint">{{ __('site.cart.demo_note') }}</p>
                </footer>
            @endif
        @endif
    </aside>
</div>
