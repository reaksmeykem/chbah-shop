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
<div class="min-h-screen">

    <header class="border-b border-line-soft bg-ivory">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5 sm:px-8">
            <div class="flex items-center gap-3">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ink">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none">
                        <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9" stroke="#d97757" stroke-width="2.6" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="display text-lg font-semibold">Chbah Admin</span>
            </div>

            <nav class="flex items-center gap-1.5">
                <a href="{{ route('admin.dashboard') }}"
                   class="chip {{ request()->routeIs('admin.dashboard') ? 'border-transparent bg-ink text-ivory' : '' }}">Dashboard</a>
                <a href="{{ route('admin.analytics') }}"
                   class="chip {{ request()->routeIs('admin.analytics') ? 'border-transparent bg-ink text-ivory' : '' }}">Analytics</a>
                <a href="{{ route('admin.products') }}"
                   class="chip {{ request()->routeIs('admin.products.*') ? 'border-transparent bg-ink text-ivory' : '' }}">Products</a>
                <a href="{{ route('admin.keys') }}"
                   class="chip {{ request()->routeIs('admin.keys') ? 'border-transparent bg-ink text-ivory' : '' }}">License keys</a>
                <a href="{{ route('admin.orders') }}"
                   class="chip {{ request()->routeIs('admin.orders') ? 'border-transparent bg-ink text-ivory' : '' }}">Orders</a>
                <a href="{{ route('admin.logout') }}" class="chip !border-line text-muted hover:!text-accent-deep">Log out</a>
            </nav>
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

@livewireScripts
</body>
</html>
