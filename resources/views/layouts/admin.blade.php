<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Chbah Admin' }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-parchment">
<div x-data="{ sidebarOpen: false }" class="min-h-screen">

    {{-- ============================= sidebar (desktop) ============================= --}}
    <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col border-r border-line-soft bg-ivory lg:flex"
           style="box-shadow: 4px 0 24px -12px rgb(20 20 19 / .06)">

        {{-- brand --}}
        <div class="flex h-16 items-center gap-2.5 border-b border-line-soft px-6">
            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-ink">
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none">
                    <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9" stroke="#d97757" stroke-width="2.6" stroke-linecap="round"/>
                </svg>
            </span>
            <div>
                <p class="display text-[17px] font-semibold leading-none">Chbah</p>
                <p class="mt-1 text-[10.5px] font-medium uppercase tracking-[0.16em] text-faint">Admin</p>
            </div>
        </div>

        {{-- nav --}}
        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-5">
            @php
                $adminNav = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'grid', 'match' => 'admin.dashboard'],
                    ['route' => 'admin.analytics', 'label' => 'Analytics', 'icon' => 'chart', 'match' => 'admin.analytics'],
                    ['route' => 'admin.products', 'label' => 'Products', 'icon' => 'box', 'match' => 'admin.products,admin.products.*'],
                    ['route' => 'admin.keys', 'label' => 'License keys', 'icon' => 'key', 'match' => 'admin.keys'],
                    ['route' => 'admin.orders', 'label' => 'Orders', 'icon' => 'bag', 'match' => 'admin.orders'],
                ];
                $icons = [
                    'grid' => '<rect x="4" y="4" width="7" height="7" rx="1.5"/><rect x="13" y="4" width="7" height="7" rx="1.5"/><rect x="4" y="13" width="7" height="7" rx="1.5"/><rect x="13" y="13" width="7" height="7" rx="1.5"/>',
                    'chart' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
                    'box' => '<path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path d="M3.3 8.3L12 13l8.7-4.7M12 13v9"/>',
                    'key' => '<circle cx="7.5" cy="16.5" r="4"/><path d="M10.5 13.5L20 4M16 8l2.5 2.5M13 11l2 2"/>',
                    'bag' => '<path d="M6 8h12l1.2 12.2a1.6 1.6 0 0 1-1.6 1.8H6.4a1.6 1.6 0 0 1-1.6-1.8L6 8z"/><path d="M9 10V6.5a3 3 0 0 1 6 0V10"/>',
                ];
            @endphp

            @foreach ($adminNav as $item)
                @php $active = request()->routeIs(...explode(',', $item['match'])); @endphp
                <a href="{{ route($item['route']) }}"
                   class="group flex items-center gap-3 rounded-2xl px-3.5 py-2.5 text-[14px] font-medium transition-all duration-300
                          {{ $active
                              ? 'bg-accent-soft text-accent-deep shadow-[inset_3px_0_0_var(--color-accent)]'
                              : 'text-ink-soft hover:bg-cream hover:text-ink' }}"
                   @if ($active) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24"
                         class="h-4.5 w-4.5 shrink-0 transition-transform duration-300 group-hover:scale-110"
                         fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        {!! $icons[$item['icon']] !!}
                    </svg>
                    {{ $item['label'] }}
                    @if ($item['route'] === 'admin.keys')
                        @php $lowStock = \App\Models\LicenseKey::where('status', 'available')->count(); @endphp
                        @if ($lowStock < 20)
                            <span class="ml-auto rounded-full bg-accent px-2 py-0.5 text-[10.5px] font-semibold text-ivory">{{ $lowStock }}</span>
                        @endif
                    @endif
                </a>
            @endforeach

            {{-- secondary --}}
            <div class="my-4 border-t border-line-soft"></div>
            <a href="{{ route('home') }}"
               class="group flex items-center gap-3 rounded-2xl px-3.5 py-2.5 text-[14px] font-medium text-ink-soft transition-all duration-300 hover:bg-cream hover:text-ink">
                <svg viewBox="0 0 24 24" class="h-4.5 w-4.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 10.5L12 3l9 7.5M5.5 9.5V20h13V9.5"/>
                </svg>
                View shop
            </a>
            <a href="{{ route('admin.logout') }}"
               class="group flex items-center gap-3 rounded-2xl px-3.5 py-2.5 text-[14px] font-medium text-muted transition-all duration-300 hover:bg-accent-soft hover:text-accent-deep">
                <svg viewBox="0 0 24 24" class="h-4.5 w-4.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 4h4v16h-4M10 8l-4 4 4 4M6 12h9"/>
                </svg>
                Log out
            </a>
        </nav>

        {{-- footer note --}}
        <div class="border-t border-line-soft px-5 py-4">
            <p class="text-[11px] leading-relaxed text-faint">Chbah Admin · local workshop console</p>
        </div>
    </aside>

    {{-- ============================= mobile drawer ============================= --}}
    <div x-show="sidebarOpen" x-cloak
         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-ink/35 backdrop-blur-[2px] lg:hidden"
         @click="sidebarOpen = false"></div>

    <aside x-show="sidebarOpen" x-cloak x-data
           x-transition:enter="transition duration-400 ease-[cubic-bezier(0.16,1,0.3,1)]"
           x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
           x-transition:leave="transition duration-250 ease-in"
           x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-line-soft bg-ivory lg:hidden">

        <div class="flex h-16 items-center justify-between border-b border-line-soft px-5">
            <div class="flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ink">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none">
                        <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9" stroke="#d97757" stroke-width="2.6" stroke-linecap="round"/>
                    </svg>
                </span>
                <p class="display text-[16px] font-semibold">Chbah Admin</p>
            </div>
            <button @click="sidebarOpen = false" class="flex h-9 w-9 items-center justify-center rounded-full border border-line" aria-label="Close menu">
                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>
            </button>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
            @foreach ($adminNav as $item)
                @php $active = request()->routeIs(...explode(',', $item['match'])); @endphp
                <a href="{{ route($item['route']) }}" @click="sidebarOpen = false"
                   class="flex items-center gap-3 rounded-2xl px-3.5 py-3 text-[15px] font-medium
                          {{ $active ? 'bg-accent-soft text-accent-deep' : 'text-ink-soft hover:bg-cream' }}"
                   @if ($active) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        {!! $icons[$item['icon']] !!}
                    </svg>
                    {{ $item['label'] }}
                </a>
            @endforeach
            <div class="my-3 border-t border-line-soft"></div>
            <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-2xl px-3.5 py-3 text-[15px] font-medium text-ink-soft hover:bg-cream">
                <svg viewBox="0 0 24 24" class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 10.5L12 3l9 7.5M5.5 9.5V20h13V9.5"/>
                </svg>
                View shop
            </a>
            <a href="{{ route('admin.logout') }}" class="flex items-center gap-3 rounded-2xl px-3.5 py-3 text-[15px] font-medium text-muted hover:bg-accent-soft hover:text-accent-deep">
                <svg viewBox="0 0 24 24" class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 4h4v16h-4M10 8l-4 4 4 4M6 12h9"/>
                </svg>
                Log out
            </a>
        </nav>
    </aside>

    {{-- ============================= main column ============================= --}}
    <div class="lg:pl-64">

        {{-- mobile topbar --}}
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-line-soft bg-ivory/90 px-4 backdrop-blur lg:hidden">
            <button @click="sidebarOpen = true"
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-line bg-white/70"
                    aria-label="Open menu">
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ink">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none">
                        <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9" stroke="#d97757" stroke-width="2.6" stroke-linecap="round"/>
                    </svg>
                </span>
                <p class="display text-[15px] font-semibold">Chbah Admin</p>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-5 py-8 sm:px-8">
            @if (session('status'))
                <div class="mb-6 flex items-center gap-2.5 rounded-2xl border border-sage/40 bg-sage/15 px-4 py-3 text-sm font-medium text-sage-deep">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4.5 12.5l5 5 10-11"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
