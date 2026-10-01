<div>

    {{-- ============================ about page ============================ --}}
    @if ($page === 'about')
        <section class="relative overflow-hidden">
            <div class="orb orb-a" style="opacity:.35"></div>
            <div class="orb orb-c" style="opacity:.25"></div>
            <div class="grain"></div>

            <div class="relative mx-auto max-w-4xl px-5 pb-20 pt-14 sm:px-8 lg:pt-20">
                <div class="reveal text-center">
                    <p class="eyebrow mb-3">{{ __('site.about.eyebrow') }}</p>
                    <h1 class="display text-5xl font-semibold leading-[1.05] sm:text-[60px]">
                        {!! __('site.about.title_line1') !!}<br><em class="text-accent-deep">{!! __('site.about.title_line2') !!}</em>
                    </h1>
                </div>

                <div class="reveal mx-auto mt-8 max-w-2xl space-y-5 text-center" data-reveal-delay="100">
                    <p class="text-[16.5px] leading-relaxed text-ink-soft">{{ __('site.about.body1') }}</p>
                    <p class="text-[16.5px] leading-relaxed text-muted">{{ __('site.about.body2') }}</p>
                </div>

                {{-- tools --}}
                <div class="reveal mt-14" data-reveal-delay="180">
                    <h2 class="display mb-5 text-center text-2xl font-semibold">{{ __('site.about.tools_title') }}</h2>
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach (['dramarecap', 'pchappdf', 'chbah-voice', 'chbah-cam'] as $slug)
                            <a href="{{ route('product.show', $slug) }}"
                               class="group flex items-center gap-4 rounded-[22px] border border-line-soft bg-white/70 p-4 shadow-soft transition-shadow duration-500 hover:shadow-lift"
                               wire:key="tool-{{ $slug }}-{{ app()->getLocale() }}">
                                <img src="{{ asset("images/products/{$slug}.svg") }}" alt="" class="h-14 w-14 rounded-xl border border-line-soft bg-cream">
                                <div class="flex-1">
                                    <p class="font-medium capitalize">{{ str($slug)->replace('-', ' ') }}</p>
                                    <p class="text-[12.5px] text-muted">{{ __('site.about.tools_cta') }}</p>
                                </div>
                                <svg viewBox="0 0 24 24" class="h-4 w-4 text-faint transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M13 6l6 6-6 6"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- values --}}
                <div class="reveal mt-14" data-reveal-delay="240">
                    <h2 class="display mb-5 text-center text-2xl font-semibold">{{ __('site.about.values_title') }}</h2>
                    <div class="grid gap-4 md:grid-cols-3">
                        @foreach ([1, 2, 3] as $n)
                            <div class="rounded-[22px] border border-line-soft bg-white/70 p-6 shadow-soft" wire:key="v-{{ $n }}-{{ app()->getLocale() }}">
                                <span class="mb-3.5 flex h-9 w-9 items-center justify-center rounded-full bg-accent-soft">
                                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                                </span>
                                <h3 class="display text-[15.5px] font-semibold">{{ __('site.story.value' . $n . '_title') }}</h3>
                                <p class="mt-1.5 text-[13px] leading-relaxed text-muted">{{ __('site.story.value' . $n . '_body') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- contact --}}
                <div class="reveal relative mt-14 overflow-hidden rounded-[28px] border border-line-soft bg-cream px-6 py-12 text-center sm:px-10" data-reveal-delay="300">
                    <div class="orb orb-b" style="width:260px;height:260px;min-width:260px;min-height:260px;bottom:-40%;right:-4%;opacity:.4"></div>
                    <h2 class="display text-2xl font-semibold sm:text-3xl">{{ __('site.about.talk_title') }}</h2>
                    <p class="mx-auto mt-3 max-w-md text-[15px] leading-relaxed text-muted">{{ __('site.about.talk_body') }}</p>
                    <div class="mt-6 flex flex-wrap justify-center gap-3">
                        <a href="{{ config('site.telegram') }}" target="_blank" rel="noopener" class="btn-primary px-6 py-3.5 text-[15px]">
                            <svg viewBox="0 0 24 24" class="h-4.5 w-4.5" fill="currentColor">
                                <path d="M21.9 4.6 19 19.3c-.2 1-.8 1.2-1.6.8l-4.5-3.3-2.2 2.1c-.2.2-.4.4-.9.4l.3-4.6 8.4-7.6c.4-.3-.1-.5-.6-.2L7.5 13.2 3.1 11.8c-1-.3-1-1 .2-1.5l17.3-6.7c.8-.3 1.5.2 1.3 1z"/>
                            </svg>
                            {{ __('site.support.telegram') }}
                        </a>
                        <a href="mailto:{{ config('site.email') }}" class="btn-ghost px-6 py-3.5 text-[15px]">{{ __('site.support.email') }}</a>
                    </div>
                </div>
            </div>
        </section>

    {{-- ========================= terms / privacy pages ========================= --}}
    @else
        <section class="relative overflow-hidden">
            <div class="orb orb-b" style="opacity:.25"></div>
            <div class="grain"></div>

            <div class="relative mx-auto max-w-3xl px-5 pb-24 pt-14 sm:px-8 lg:pt-20" wire:key="doc-{{ $page }}-{{ app()->getLocale() }}">
                <div class="reveal">
                    <p class="eyebrow mb-3">Legal</p>
                    <h1 class="display text-5xl font-semibold leading-[1.05] sm:text-[56px]">
                        {!! $doc['title_line1'] !!} <em class="text-accent-deep">{!! $doc['title_line2'] !!}</em>
                    </h1>
                    <p class="mt-4 text-[13px] text-faint">{{ $doc['updated'] }}</p>
                </div>

                <div class="reveal mt-12 space-y-8" data-reveal-delay="100">
                    @foreach ($doc['sections'] as $section)
                        <div class="rounded-[22px] border border-line-soft bg-white/70 p-6 shadow-soft">
                            <h2 class="display text-[17px] font-semibold">{{ $section['h'] }}</h2>
                            <p class="mt-2.5 text-[14.5px] leading-relaxed text-ink-soft">{{ $section['p'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="reveal mt-10 rounded-[22px] border border-dashed border-line bg-cream/50 px-6 py-6 text-center" data-reveal-delay="150">
                    <p class="text-sm text-muted">{{ __('site.support.body') }}</p>
                    <div class="mt-4 flex flex-wrap justify-center gap-3">
                        <a href="{{ config('site.telegram') }}" target="_blank" rel="noopener" class="btn-primary px-5 py-2.5 text-[13.5px]">{{ __('site.support.telegram') }}</a>
                        <a href="mailto:{{ config('site.email') }}" class="btn-ghost px-5 py-2.5 text-[13.5px]">{{ __('site.support.email') }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
