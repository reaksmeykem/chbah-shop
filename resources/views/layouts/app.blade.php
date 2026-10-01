<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? __('site.title.default') }}</title>
    <meta name="description" content="Focused Windows software — PchapPDF, Chbah Voice, Chbah Cam, DramaRecap. One-time purchase, instant license keys.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
<div class="flex min-h-screen flex-col">

    {{-- ============================= header ============================= --}}
    <header class="nav-glass sticky top-0 z-40 border-b border-line-soft">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 sm:px-8"
             x-data="{ menu: false }" @keydown.escape.window="menu = false">
            <a href="{{ route('home') }}" class="group flex items-center gap-2.5">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-cream transition-transform duration-500 group-hover:rotate-45">
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none">
                        <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9"
                              stroke="#d97757" stroke-width="2.6" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="display text-[22px] font-semibold tracking-tight">Chbah</span>
            </a>

            <div class="hidden items-center gap-6 text-[14px] font-medium text-ink-soft lg:flex lg:gap-8">
                <a href="{{ route('shop') }}" class="link-underline inline-flex items-center gap-2 transition-colors hover:text-ink">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="4" width="7" height="7" rx="2"/>
                        <rect x="13" y="4" width="7" height="7" rx="2"/>
                        <rect x="4" y="13" width="7" height="7" rx="2"/>
                        <rect x="13" y="13" width="7" height="7" rx="2"/>
                    </svg>
                    {{ __('site.nav.software') }}
                </a>
                <a href="{{ route('license') }}" class="link-underline inline-flex items-center gap-2 transition-colors hover:text-ink">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="7.5" cy="16.5" r="4"/>
                        <path d="M10.5 13.5L20 4M16 8l2.5 2.5M13 11l2 2"/>
                    </svg>
                    {{ __('site.nav.check_license') }}
                </a>
                <a href="{{ route('home') }}#story" class="link-underline inline-flex items-center gap-2 transition-colors hover:text-ink">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20l-1.3-1.2C6 14.6 3 11.9 3 8.6 3 6 5 4 7.6 4c1.7 0 3.3.8 4.4 2.2C13.1 4.8 14.7 4 16.4 4 19 4 21 6 21 8.6c0 3.3-3 6-7.7 10.2L12 20z"/>
                    </svg>
                    {{ __('site.nav.why') }}
                </a>
                <a href="{{ route('home') }}#letters" class="link-underline inline-flex items-center gap-2 transition-colors hover:text-ink">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 9a6 6 0 1 0-12 0c0 6-2.5 7-2.5 7h17S18 15 18 9"/>
                        <path d="M10 20a2.2 2.2 0 0 0 4 0"/>
                    </svg>
                    {{ __('site.nav.updates') }}
                </a>
            </div>

            <div class="flex items-center gap-2.5">
                {{-- language switcher --}}
                <div class="hidden items-center rounded-full border border-line bg-white/70 p-1 sm:flex" role="group" aria-label="Language">
                    <a href="{{ route('locale.set', 'en') }}"
                       class="rounded-full px-2.5 py-1 text-[12px] font-semibold transition {{ app()->isLocale('en') ? 'bg-ink text-ivory' : 'text-muted hover:text-ink' }}"
                       @if (app()->isLocale('en')) aria-current="true" @endif>EN</a>
                    <a href="{{ route('locale.set', 'km') }}"
                       class="rounded-full px-2.5 py-1 text-[12px] font-semibold transition {{ app()->isLocale('km') ? 'bg-ink text-ivory' : 'text-muted hover:text-ink' }}"
                       @if (app()->isLocale('km')) aria-current="true" @endif>ខ្មែរ</a>
                </div>
                <livewire:cart-badge />
                <button class="flex h-10 w-10 items-center justify-center rounded-full border border-line bg-white/70 transition hover:border-ink/30 hover:bg-cream lg:hidden"
                        @click="menu = !menu" aria-label="{{ __('site.nav.menu') }}">
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <path d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                </button>
            </div>

            {{-- mobile menu --}}
            <div x-show="menu" x-transition.opacity.duration.300ms x-cloak
                 class="absolute inset-x-0 top-16 border-b border-line-soft bg-ivory/95 backdrop-blur lg:hidden"
                 style="box-shadow: 0 20px 40px -20px rgb(20 20 19 / .15)">
                <div class="flex flex-col gap-1 px-5 py-4 text-[15px] font-medium">
                    <a href="{{ route('shop') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 hover:bg-cream" @click="menu=false">
                        <svg viewBox="0 0 24 24" class="h-4.5 w-4.5 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="4" width="7" height="7" rx="2"/>
                            <rect x="13" y="4" width="7" height="7" rx="2"/>
                            <rect x="4" y="13" width="7" height="7" rx="2"/>
                            <rect x="13" y="13" width="7" height="7" rx="2"/>
                        </svg>
                        {{ __('site.nav.software') }}
                    </a>
                    <a href="{{ route('license') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 hover:bg-cream" @click="menu=false">
                        <svg viewBox="0 0 24 24" class="h-4.5 w-4.5 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="7.5" cy="16.5" r="4"/>
                            <path d="M10.5 13.5L20 4M16 8l2.5 2.5M13 11l2 2"/>
                        </svg>
                        {{ __('site.nav.check_license') }}
                    </a>
                    <a href="{{ route('home') }}#story" class="flex items-center gap-3 rounded-xl px-3 py-2.5 hover:bg-cream" @click="menu=false">
                        <svg viewBox="0 0 24 24" class="h-4.5 w-4.5 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20l-1.3-1.2C6 14.6 3 11.9 3 8.6 3 6 5 4 7.6 4c1.7 0 3.3.8 4.4 2.2C13.1 4.8 14.7 4 16.4 4 19 4 21 6 21 8.6c0 3.3-3 6-7.7 10.2L12 20z"/>
                        </svg>
                        {{ __('site.nav.why') }}
                    </a>
                    <a href="{{ route('home') }}#letters" class="flex items-center gap-3 rounded-xl px-3 py-2.5 hover:bg-cream" @click="menu=false">
                        <svg viewBox="0 0 24 24" class="h-4.5 w-4.5 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 9a6 6 0 1 0-12 0c0 6-2.5 7-2.5 7h17S18 15 18 9"/>
                            <path d="M10 20a2.2 2.2 0 0 0 4 0"/>
                        </svg>
                        {{ __('site.nav.updates') }}
                    </a>
                    <div class="mt-2 flex items-center gap-1 border-t border-line-soft pt-3">
                        <a href="{{ route('locale.set', 'en') }}"
                           class="chip {{ app()->isLocale('en') ? 'border-transparent bg-ink text-ivory' : '' }}">EN</a>
                        <a href="{{ route('locale.set', 'km') }}"
                           class="chip {{ app()->isLocale('km') ? 'border-transparent bg-ink text-ivory' : '' }}">ខ្មែរ</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- ============================= footer ============================= --}}
    <footer class="border-t border-line-soft bg-cream/60">
        <div class="mx-auto max-w-7xl px-5 py-14 sm:px-8">
            <div class="grid gap-10 md:grid-cols-[1.4fr_1fr_1fr_1fr]">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-ivory">
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none">
                                <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9"
                                      stroke="#d97757" stroke-width="2.6" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span class="display text-xl font-semibold">Chbah</span>
                    </a>
                    <p class="mt-4 max-w-xs text-sm leading-relaxed text-muted">{{ __('site.footer.blurb') }}</p>
                </div>

                <div>
                    <p class="eyebrow mb-4">{{ __('site.footer.software') }}</p>
                    <ul class="space-y-2.5 text-sm text-ink-soft">
                        <li><a href="{{ route('shop') }}" class="link-underline">{{ __('site.footer.all_products') }}</a></li>
                        <li><a href="{{ route('product.show', 'dramarecap') }}" class="link-underline">DramaRecap</a></li>
                        <li><a href="{{ route('product.show', 'pchappdf') }}" class="link-underline">PchapPDF</a></li>
                        <li><a href="{{ route('product.show', 'chbah-voice') }}" class="link-underline">Chbah Voice</a></li>
                        <li><a href="{{ route('product.show', 'chbah-cam') }}" class="link-underline">Chbah Cam</a></li>
                    </ul>
                </div>

                <div>
                    <p class="eyebrow mb-4">{{ __('site.footer.studio') }}</p>
                    <ul class="space-y-2.5 text-sm text-ink-soft">
                        <li><a href="{{ route('home') }}#story" class="link-underline">{{ __('site.footer.why') }}</a></li>
                        <li><a href="{{ route('home') }}#letters" class="link-underline">{{ __('site.footer.release_notes') }}</a></li>
                        <li><a href="{{ route('home') }}#kind" class="link-underline">{{ __('site.footer.kind_words') }}</a></li>
                    </ul>
                </div>

                <div>
                    <p class="eyebrow mb-4">{{ __('site.footer.support') }}</p>
                    <ul class="space-y-2.5 text-sm text-ink-soft">
                        <li><a href="{{ route('license') }}" class="link-underline">{{ __('site.footer.check_key') }}</a></li>
                        <li><span class="block">hello@chbah.shop</span></li>
                        <li>{{ __('site.footer.instant_delivery') }}</li>
                        <li>{{ __('site.footer.refunds') }}</li>
                    </ul>
                </div>
            </div>

            <div class="mt-14 flex flex-col items-center justify-between gap-4 border-t border-line pt-7 text-[13px] text-muted sm:flex-row">
                <p>{{ __('site.footer.copyright', ['year' => date('Y')]) }}</p>
                <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2">
                    <a href="{{ route('about') }}" class="link-underline transition-colors hover:text-ink">{{ __('site.nav.about') }}</a>
                    <a href="{{ route('terms') }}" class="link-underline transition-colors hover:text-ink">{{ __('site.nav.terms') }}</a>
                    <a href="{{ route('privacy') }}" class="link-underline transition-colors hover:text-ink">{{ __('site.nav.privacy') }}</a>
                    <span class="text-line-soft">|</span>
                    <a href="{{ route('admin.login') }}" class="text-faint transition-colors hover:text-ink">Admin</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<livewire:cart-panel />

<x-support-widget />

<x-cookie-banner />

@livewireScripts
</body>
</html>
