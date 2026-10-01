<div>

    {{-- ================================ hero ================================ --}}
    <section class="relative overflow-hidden">
        <div class="orb orb-a"></div>
        <div class="orb orb-b"></div>
        <div class="orb orb-c"></div>
        <div class="grain"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-5 pb-20 pt-16 sm:px-8 lg:grid-cols-[1.05fr_1fr] lg:gap-6 lg:pb-28 lg:pt-24">

            <div class="reveal">
                <p class="mb-6 inline-flex items-center gap-2.5 rounded-full border border-line bg-white/70 py-1.5 pl-2 pr-4 text-[12.5px] font-medium text-ink-soft backdrop-blur">
                    <span class="flex items-center gap-1 rounded-full bg-accent px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-ivory">{{ __('site.hero.badge_new') }}</span>
                    {{ __('site.hero.badge_text') }}
                </p>

                <h1 class="display text-[44px] font-semibold leading-[1.04] sm:text-6xl lg:text-[68px]">
                    {!! __('site.hero.title_line1') !!}<br><em class="text-accent-deep">{!! __('site.hero.title_line2') !!}</em>
                </h1>

                <p class="mt-6 max-w-md text-[17px] leading-relaxed text-muted">
                    {{ __('site.hero.subtitle') }}
                </p>

                <div class="mt-9 flex flex-wrap items-center gap-3.5">
                    <a href="{{ route('shop') }}" class="btn-primary px-7 py-3.5 text-[15px]">
                        {{ __('site.hero.browse') }}
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </a>
                    <a href="#story" class="btn-ghost px-7 py-3.5 text-[15px]">{{ __('site.hero.why') }}</a>
                </div>

                <div class="mt-12 flex flex-wrap items-center gap-x-8 gap-y-3 text-[13px] text-muted">
                    <span class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent"></span> {{ __('site.hero.point_delivery') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-sage-deep"></span> {{ __('site.hero.point_refund') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-ochre"></span> {{ __('site.hero.point_offline') }}
                    </span>
                </div>
            </div>

            {{-- 3D canvas + floating chips --}}
            <div class="relative mx-auto h-[400px] w-full max-w-[560px] sm:h-[480px] lg:h-[600px]">
                <canvas data-hero-canvas class="h-full w-full"></canvas>

                <div class="float-y absolute left-0 top-[14%] hidden rounded-2xl border border-line-soft bg-white/80 p-2.5 pr-4 shadow-soft backdrop-blur sm:block">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/products/pchappdf.svg') }}" alt="" class="h-12 w-12 rounded-xl bg-cream">
                        <div>
                            <p class="text-[13px] font-medium leading-tight">PchapPDF</p>
                            <p class="text-[12px] text-muted">$12 · v1.8</p>
                        </div>
                    </div>
                </div>

                <div class="float-y-slow absolute bottom-[10%] right-0 hidden rounded-2xl border border-line-soft bg-white/80 px-4 py-3 shadow-soft backdrop-blur sm:block">
                    <p class="flex items-center gap-1.5 text-[13px] font-medium">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 text-ochre" fill="currentColor">
                            <path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2l-6.1 3.4 1.4-6.8L2.2 9.1l6.9-.8z"/>
                        </svg>
                        {{ __('site.hero.rating') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================== marquee ============================== --}}
    <section class="overflow-hidden border-y border-line-soft bg-cream/70 py-5" aria-hidden="true">
        <div class="marquee">
            @foreach (['track-a', 'track-b'] as $track)
                <div class="marquee__track" wire:key="marquee-{{ $track }}-{{ app()->getLocale() }}">
                    @foreach (__('site.marquee') as $word)
                        <span class="flex items-center gap-14">
                            <span class="display text-lg text-ink-soft">{{ $word }}</span>
                            <svg viewBox="0 0 24 24" class="h-4 w-4 text-accent spin-slow" fill="none">
                                <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                            </svg>
                        </span>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============================= categories ============================= --}}
    <section id="categories" class="mx-auto max-w-7xl scroll-mt-24 px-5 py-20 sm:px-8 lg:py-28">
        <div class="reveal mb-10 flex flex-wrap items-end justify-between gap-5">
            <div>
                <p class="eyebrow mb-3">{{ __('site.categories.eyebrow') }}</p>
                <h2 class="display text-4xl font-semibold sm:text-[42px]">{!! __('site.categories.title_line1') !!} <em>{!! __('site.categories.title_line2') !!}</em></h2>
            </div>
            <a href="{{ route('shop') }}" class="link-underline mb-1.5 hidden text-sm font-medium text-ink-soft sm:block">
                {{ __('site.categories.view_all') }}
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-6">
            @foreach ($categories as $i => $category)
                <div class="reveal" data-reveal-delay="{{ $i * 90 }}" wire:key="cat-{{ $category->id }}-{{ app()->getLocale() }}">
                    <a href="{{ route('shop', ['category' => $category->slug]) }}"
                       class="tilt-card group relative flex h-full flex-col rounded-[26px] border border-line-soft bg-white/70 p-5 shadow-soft transition-shadow duration-500 hover:shadow-lift sm:p-6"
                       data-tilt>
                        <span class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-cream transition-transform duration-500 group-hover:scale-105 sm:h-24 sm:w-24">
                            <img src="{{ asset("images/categories/{$category->slug}.svg") }}" alt="" class="h-14 w-14 sm:h-[72px] sm:w-[72px]">
                        </span>
                        <h3 class="display text-lg font-semibold sm:text-xl">{{ $category->display_name }}</h3>
                        <p class="mt-1.5 text-[13px] leading-relaxed text-muted">{{ $category->display_tagline }}</p>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-[13px] font-medium text-accent-deep">
                            {{ __('site.categories.tools_count', ['count' => $category->products()->count()]) }}
                            <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============================= featured ============================== --}}
    <section class="border-t border-line-soft bg-parchment/70">
        <div class="mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
            <div class="reveal mb-10 flex flex-wrap items-end justify-between gap-5">
                <div>
                    <p class="eyebrow mb-3">{{ __('site.featured.eyebrow') }}</p>
                    <h2 class="display text-4xl font-semibold sm:text-[42px]">{!! __('site.featured.title_line1') !!} <em>{!! __('site.featured.title_line2') !!}</em></h2>
                </div>
                <a href="{{ route('shop') }}" class="btn-ghost px-5 py-2.5 text-sm">{{ __('site.featured.all_tools') }}</a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featured as $i => $product)
                    @include('livewire.partials.product-card', ['product' => $product, 'delay' => ($i % 3) * 90])
                @endforeach
            </div>
        </div>
    </section>

    {{-- =============================== story =============================== --}}
    <section id="story" class="relative overflow-hidden bg-ink text-ivory">
        <div class="dot-grid absolute inset-0 opacity-20"></div>
        <div class="grain"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-14 px-5 py-24 sm:px-8 lg:grid-cols-2 lg:py-32">
            <div class="reveal">
                <p class="eyebrow mb-4 !text-clay">{{ __('site.story.eyebrow') }}</p>
                <h2 class="display text-4xl font-semibold leading-[1.08] text-ivory sm:text-5xl">
                    {!! __('site.story.title_line1') !!}<br><em class="text-clay">{!! __('site.story.title_line2') !!}</em>
                </h2>
                <p class="mt-6 max-w-md text-[16px] leading-relaxed text-ivory/65">
                    {{ __('site.story.body') }}
                </p>

                <div class="mt-10 grid grid-cols-3 gap-6 border-t border-ivory/15 pt-8">
                    <div>
                        <p class="display text-3xl font-semibold">{{ __('site.story.stat1_num') }}</p>
                        <p class="mt-1 text-[12.5px] text-ivory/55">{!! __('site.story.stat1_label') !!}</p>
                    </div>
                    <div>
                        <p class="display text-3xl font-semibold">{{ __('site.story.stat2_num') }}</p>
                        <p class="mt-1 text-[12.5px] text-ivory/55">{!! __('site.story.stat2_label') !!}</p>
                    </div>
                    <div>
                        <p class="display text-3xl font-semibold">{{ __('site.story.stat3_num') }}</p>
                        <p class="mt-1 text-[12.5px] text-ivory/55">{!! __('site.story.stat3_label') !!}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                @foreach ([
                    ['title' => __('site.story.value1_title'), 'body' => __('site.story.value1_body')],
                    ['title' => __('site.story.value2_title'), 'body' => __('site.story.value2_body')],
                    ['title' => __('site.story.value3_title'), 'body' => __('site.story.value3_body')],
                ] as $i => $value)
                    <div class="reveal flex gap-5 rounded-[24px] border border-ivory/10 bg-ivory/[0.04] p-6" data-reveal-delay="{{ $i * 110 }}" wire:key="value-{{ $i }}-{{ app()->getLocale() }}">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-accent/15">
                            <span class="h-2 w-2 rounded-full bg-accent"></span>
                        </span>
                        <div>
                            <h3 class="display text-lg font-semibold text-ivory">{{ $value['title'] }}</h3>
                            <p class="mt-1.5 text-[13.5px] leading-relaxed text-ivory/60">{{ $value['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================ testimonials ============================ --}}
    <section id="kind" class="mx-auto max-w-7xl scroll-mt-24 px-5 py-20 sm:px-8 lg:py-28">
        <div class="reveal mb-10 text-center">
            <p class="eyebrow mb-3">{{ __('site.kind.eyebrow') }}</p>
            <h2 class="display text-4xl font-semibold sm:text-[42px]">{!! __('site.kind.title_line1') !!} <em>{!! __('site.kind.title_line2') !!}</em></h2>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @foreach (range(1, 3) as $n)
                <figure class="reveal flex h-full flex-col rounded-[26px] border border-line-soft bg-white/70 p-7 shadow-soft" data-reveal-delay="{{ ($n - 1) * 100 }}" wire:key="kind-{{ $n }}-{{ app()->getLocale() }}">
                    <div class="mb-4 flex gap-1 text-ochre">
                        @for ($s = 0; $s < 5; $s++)
                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="currentColor"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2l-6.1 3.4 1.4-6.8L2.2 9.1l6.9-.8z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="serif-italic flex-1 text-[16.5px] leading-relaxed text-ink-soft">
                        “{{ __('site.kind.quote' . $n) }}”
                    </blockquote>
                    <figcaption class="mt-6 flex items-center gap-3 border-t border-line-soft pt-5">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-accent-soft text-[13px] font-semibold text-accent-deep">{{ strtoupper(substr(__('site.kind.name' . $n), 0, 1)) }}</span>
                        <div>
                            <p class="text-[14px] font-medium">{{ __('site.kind.name' . $n) }}</p>
                            <p class="text-[12px] text-faint">{{ __('site.kind.role' . $n) }}</p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>

    {{-- ============================ newsletter ============================= --}}
    <section id="letters" class="mx-auto max-w-7xl scroll-mt-24 px-5 pb-24 sm:px-8">
        <div class="reveal relative overflow-hidden rounded-[32px] border border-line-soft bg-cream px-6 py-14 text-center sm:px-12 lg:py-20">
            <div class="orb orb-a" style="width:300px;height:300px;min-width:300px;min-height:300px;top:-30%;left:-6%;opacity:.4"></div>
            <div class="orb orb-c" style="width:260px;height:260px;min-width:260px;min-height:260px;bottom:-40%;right:-4%;opacity:.4"></div>
            <div class="grain"></div>

            <div class="relative mx-auto max-w-xl" x-data="{ sent: false, email: '' }">
                <span class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-full bg-ivory shadow-soft">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 text-accent" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16v12H4z"/><path d="M4 7l8 6 8-6"/>
                    </svg>
                </span>
                <h2 class="display text-3xl font-semibold sm:text-4xl">{!! __('site.letters.title_line1') !!} <em>{!! __('site.letters.title_line2') !!}</em></h2>
                <p class="mx-auto mt-3 max-w-md text-[15px] leading-relaxed text-muted">
                    {{ __('site.letters.body') }}
                </p>

                <template x-if="!sent">
                    <form class="mx-auto mt-8 flex max-w-md flex-col gap-3 sm:flex-row" @submit.prevent="if (email) sent = true">
                        <input type="email" x-model="email" required placeholder="{{ __('site.letters.placeholder') }}"
                               class="field flex-1 rounded-full">
                        <button type="submit" class="btn-primary px-7 py-3.5 text-[15px]">{{ __('site.letters.button') }}</button>
                    </form>
                </template>
                <template x-if="sent">
                    <p class="serif-italic mt-8 text-lg text-accent-deep">{{ __('site.letters.success') }}</p>
                </template>
            </div>
        </div>
    </section>
</div>
