<div>
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="eyebrow mb-2">First-party analytics · consent-gated</p>
            <h1 class="display text-3xl font-semibold">Analytics</h1>
            <p class="mt-2 text-sm text-muted">Last {{ $days }} days — recorded only from visitors who accepted analytics.</p>
        </div>
        <select wire:model.live="days" class="field w-auto cursor-pointer rounded-full py-2.5 text-[13.5px]">
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
        </select>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @foreach ([
            ['label' => 'Page views', 'value' => number_format($visits), 'tint' => 'bg-accent-soft text-accent-deep'],
            ['label' => 'Unique visitors', 'value' => number_format($uniques), 'tint' => 'text-ink'],
            ['label' => 'Product views', 'value' => number_format($productViews), 'tint' => 'text-ink'],
            ['label' => 'Add to cart', 'value' => number_format($cartAdds), 'tint' => 'text-ink'],
            ['label' => 'Purchases', 'value' => number_format($purchases), 'tint' => 'bg-sage/20 text-sage-deep'],
        ] as $stat)
            <div class="rounded-[22px] border border-line-soft bg-white/80 p-5 shadow-soft">
                <p class="text-[11.5px] font-medium uppercase tracking-[0.14em] text-muted">{{ $stat['label'] }}</p>
                <p class="display mt-2 text-3xl font-semibold {{ $stat['tint'] }}">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- visits chart --}}
    <div class="mt-8 rounded-[22px] border border-line-soft bg-white/80 p-6 shadow-soft">
        <h2 class="display mb-5 text-lg font-semibold">Page views per day</h2>
        <div class="flex h-44 items-end gap-1.5">
            @foreach ($chart as $day)
                <div class="group flex h-full flex-1 flex-col items-center justify-end gap-1.5">
                    <span class="text-[10px] font-semibold text-faint opacity-0 transition-opacity group-hover:opacity-100">{{ $day['count'] }}</span>
                    <div class="w-full rounded-t-md bg-accent/75 transition-colors group-hover:bg-accent"
                         style="height: {{ max(2, (int) round($day['count'] / $max * 100)) }}%"></div>
                </div>
            @endforeach
        </div>
        <div class="mt-2 flex gap-1.5">
            @foreach ($chart as $i => $day)
                <div class="flex-1 text-center text-[9.5px] text-faint">{{ $chart->count() <= 14 || $i % 2 === 0 ? $day['label'] : '' }}</div>
            @endforeach
        </div>
    </div>

    {{-- breakdowns --}}
    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        @php
            $sections = [
                ['Top pages', $topPages],
                ['Top products viewed', $topProducts],
                ['Search terms', $topSearches],
                ['Referrers', $referrers],
                ['Browsers', $browsers],
                ['Platforms', $platforms],
                ['Devices', $devices],
                ['Languages', $locales],
            ];
        @endphp

        @foreach ($sections as [$heading, $rows])
            <div class="rounded-[22px] border border-line-soft bg-white/80 p-6 shadow-soft" wire:key="sec-{{ md5($heading) }}-{{ $days }}">
                <h2 class="display mb-4 text-lg font-semibold">{{ $heading }}</h2>
                @forelse ($rows as $label => $count)
                    @php $pct = (int) round($count / max(1, $rows->max()) * 100); @endphp
                    <div class="mb-3 last:mb-0">
                        <div class="mb-1 flex items-baseline justify-between gap-4 text-[13px]">
                            <span class="truncate font-medium text-ink-soft" title="{{ $label }}">{{ $label }}</span>
                            <span class="shrink-0 text-muted">{{ number_format($count) }}</span>
                        </div>
                        <div class="h-1.5 overflow-hidden rounded-full bg-cream">
                            <div class="h-full rounded-full bg-accent/70" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-muted">No data in this period yet.</p>
                @endforelse
            </div>
        @endforeach
    </div>
</div>
