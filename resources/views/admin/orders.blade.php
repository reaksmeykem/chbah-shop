<div>
    <div class="mb-8">
        <p class="eyebrow mb-2">Sales</p>
        <h1 class="display text-3xl font-semibold">Orders</h1>
    </div>

    @forelse ($orders as $order)
        <div class="mb-4 overflow-hidden rounded-[22px] border border-line-soft bg-white/80 shadow-soft" wire:key="o-{{ $order->id }}">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-line-soft bg-cream/40 px-5 py-4">
                <div class="flex items-center gap-3">
                    <span class="font-mono text-[12px] text-muted">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                    <span class="font-medium">{{ $order->email }}</span>
                    <span class="chip !py-1 !text-[11px]">{{ $order->status }}</span>
                </div>
                <div class="flex items-center gap-4 text-sm">
                    <span class="text-muted">{{ $order->created_at->format('M j, Y · H:i') }}</span>
                    <span class="display text-lg font-semibold">${{ number_format($order->total_cents / 100, 0) }}</span>
                </div>
            </div>
            <div class="grid gap-4 px-5 py-4 sm:grid-cols-2">
                <div>
                    <p class="mb-2 text-[11px] uppercase tracking-[0.14em] text-faint">Items</p>
                    <ul class="space-y-1 text-sm text-ink-soft">
                        @foreach ($order->items as $item)
                            <li>{{ $item->product?->name ?? '—' }} ×{{ $item->qty }} <span class="text-faint">(${{ number_format($item->unit_price_cents / 100, 0) }} each)</span></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <p class="mb-2 text-[11px] uppercase tracking-[0.14em] text-faint">License keys delivered</p>
                    <ul class="space-y-1.5 text-sm">
                        @forelse ($order->licenseKeys as $key)
                            <li class="flex items-center gap-2">
                                <code class="rounded-lg border border-line bg-cream/60 px-2 py-1 font-mono text-[12px]">{{ $key->key }}</code>
                                <span class="text-[12px] text-faint">{{ $key->product?->name }}</span>
                            </li>
                        @empty
                            <li class="text-muted">—</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <div class="rounded-[22px] border border-dashed border-line bg-white/50 px-6 py-14 text-center">
            <p class="display text-lg font-semibold">No orders yet</p>
            <p class="mt-1.5 text-sm text-muted">Orders appear here the moment a customer completes checkout.</p>
        </div>
    @endforelse

    <div class="mt-6">{{ $orders->links() }}</div>
</div>
