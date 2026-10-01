<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login — Chbah</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-parchment">
<div class="flex min-h-screen items-center justify-center px-5">

    <div class="orb orb-a" style="opacity:.3"></div>
    <div class="grain"></div>

    <div class="relative w-full max-w-sm rounded-[26px] border border-line-soft bg-white/80 p-8 shadow-soft">
        <div class="mb-6 text-center">
            <span class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-ink">
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none">
                    <path d="M12 3v18M4.2 7.5l15.6 9M19.8 7.5l-15.6 9" stroke="#d97757" stroke-width="2.6" stroke-linecap="round"/>
                </svg>
            </span>
            <h1 class="display text-2xl font-semibold">Chbah Admin</h1>
            <p class="mt-1.5 text-sm text-muted">Enter the shop-owner password to continue.</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-3.5">
            @csrf
            <input type="password" name="password" required placeholder="Admin password" autofocus
                   class="field">
            @error('password')
                <p class="text-[13px] text-accent-deep">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn-primary w-full py-3.5 text-sm">Sign in</button>
        </form>

        <p class="mt-5 text-center text-[12px] text-faint">
            <a href="{{ route('home') }}" class="link-underline">← Back to the shop</a>
        </p>
    </div>
</div>
</body>
</html>
