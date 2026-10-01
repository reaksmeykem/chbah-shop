<div>
    <div class="mb-8">
        <p class="eyebrow mb-2">Stock</p>
        <h1 class="display text-3xl font-semibold">License keys</h1>
        <p class="mt-2 max-w-xl text-sm leading-relaxed text-muted">
            Every checkout pulls keys from this stock. Top it up anytime — keys are minted with each product’s prefix
            and sit in <span class="font-medium text-ink">available</span> state until sold.
        </p>
    </div>

    <div class="grid gap-4">
        @foreach ($products as $product)
            <div class="flex flex-wrap items-center gap-4 rounded-[22px] border border-line-soft bg-white/80 p-5 shadow-soft" wire:key="k-{{ $product->id }}">
                <img src="{{ $product->image_url }}" alt="" class="h-12 w-12 rounded-xl border border-line-soft bg-cream object-cover">
                <div class="min-w-40 flex-1">
                    <p class="font-medium">{{ $product->name }} <span class="font-mono text-[12px] text-faint">{{ $product->key_prefix }}-…</span></p>
                    <p class="mt-0.5 text-[12.5px] text-muted">
                        <span class="{{ $product->available_count < 5 ? 'font-semibold text-accent-deep' : 'font-medium text-sage-deep' }}">{{ $product->available_count }} available</span>
                        · {{ $product->issued_count }} issued
                    </p>
                </div>
                <div class="flex gap-2">
                    <button wire:click="generate({{ $product->id }}, 10)" class="btn-ghost px-4 py-2 text-[13px]">+ 10 keys</button>
                    <button wire:click="generate({{ $product->id }}, 50)" class="btn-primary px-4 py-2 text-[13px]">+ 50 keys</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
