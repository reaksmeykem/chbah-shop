<div class="relative overflow-hidden">
    <div class="orb orb-a" style="opacity:.3"></div>
    <div class="orb orb-c" style="opacity:.25"></div>
    <div class="grain"></div>

    <div class="relative mx-auto max-w-xl px-5 pb-28 pt-16 sm:pt-24">
        <div class="reveal text-center">
            <p class="eyebrow mb-3">{{ __('site.license.eyebrow') }}</p>
            <h1 class="display text-4xl font-semibold leading-[1.08] sm:text-5xl">
                {!! __('site.license.title_line1') !!} <em class="text-accent-deep">{!! __('site.license.title_line2') !!}</em>
            </h1>
            <p class="mt-4 text-[15px] leading-relaxed text-muted">
                {{ __('site.license.body') }}
            </p>
        </div>

        <form wire:submit="check" class="reveal mt-9" data-reveal-delay="100">
            <div class="flex flex-col gap-3 sm:flex-row">
                <input type="text" wire:model="key" placeholder="{{ __('site.license.placeholder') }}"
                       class="field flex-1 rounded-full font-mono uppercase tracking-wide">
                <button type="submit" class="btn-primary px-7 py-3.5 text-[15px]" wire:loading.attr="disabled">
                    {{ __('site.license.check') }}
                </button>
            </div>
            @error('key') <p class="mt-2 pl-2 text-[13px] text-accent-deep">{{ $message }}</p> @enderror
        </form>

        @if ($result)
            <div class="reveal mt-8" wire:key="result-{{ $key }}-{{ app()->getLocale() }}">
                @if ($result['found'] && $result['issued'])
                    <div class="rounded-[26px] border border-line-soft bg-white/80 p-6 shadow-soft">
                        <div class="flex items-center gap-3.5">
                            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-sage/25 text-sage-deep">
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4.5 12.5l5 5 10-11"/>
                                </svg>
                            </span>
                            <div>
                                <p class="display text-lg font-semibold">{{ __('site.license.valid') }}</p>
                                <p class="text-[13px] text-muted">{{ __('site.license.issued', ['date' => $result['issued_at']]) }}</p>
                            </div>
                        </div>

                        <dl class="mt-5 space-y-3 border-t border-line-soft pt-5 text-[14px]">
                            <div class="flex gap-4"><dt class="w-24 shrink-0 text-faint">{{ __('site.license.product') }}</dt><dd class="font-medium">{{ $result['product'] }}</dd></div>
                            <div class="flex gap-4"><dt class="w-24 shrink-0 text-faint">{{ __('site.license.version') }}</dt><dd>v{{ $result['version'] }}</dd></div>
                            <div class="flex gap-4"><dt class="w-24 shrink-0 text-faint">{{ __('site.license.runs_on') }}</dt><dd>{{ $result['requirements'] }}</dd></div>
                        </dl>

                        @if ($result['download'])
                            <a href="{{ $result['download'] }}" class="btn-ghost mt-5 w-full py-3 text-sm">
                                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 4v11M7 10l5 5 5-5M5 20h14"/>
                                </svg>
                                {{ __('site.license.download_installer') }}
                            </a>
                        @endif
                    </div>
                @elseif ($result['found'])
                    <div class="rounded-[26px] border border-dashed border-line bg-white/50 p-6 text-center">
                        <p class="display text-lg font-semibold">{{ __('site.license.not_purchased') }}</p>
                        <p class="mt-1.5 text-sm text-muted">{{ __('site.license.not_purchased_body') }}</p>
                    </div>
                @else
                    <div class="rounded-[26px] border border-dashed border-line bg-white/50 p-6 text-center">
                        <p class="display text-lg font-semibold">{{ __('site.license.not_found') }}</p>
                        <p class="mt-1.5 text-sm text-muted">{{ __('site.license.not_found_body') }}</p>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
