<div>
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="eyebrow mb-2">Catalog</p>
            <h1 class="display text-3xl font-semibold">Products</h1>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary px-5 py-2.5 text-sm">
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            New product
        </a>
    </div>

    <div class="mb-5 max-w-sm">
        <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search by name or slug…"
               class="field rounded-full py-2.5 text-[13.5px]">
    </div>

    <div class="overflow-hidden rounded-[22px] border border-line-soft bg-white/80 shadow-soft">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-line-soft text-[11px] uppercase tracking-[0.14em] text-faint">
                    <th class="px-5 py-3.5 font-medium">Product</th>
                    <th class="px-5 py-3.5 font-medium">Category</th>
                    <th class="px-5 py-3.5 font-medium">Price</th>
                    <th class="px-5 py-3.5 font-medium">Keys left</th>
                    <th class="px-5 py-3.5 font-medium">Featured</th>
                    <th class="px-5 py-3.5 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody wire:loading.class="lw-loading">
                @forelse ($products as $product)
                    <tr class="border-b border-line-soft last:border-0" wire:key="p-{{ $product->id }}">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->image_url }}" alt="" class="h-11 w-11 rounded-xl border border-line-soft bg-cream object-cover">
                                <div>
                                    <p class="font-medium leading-tight">{{ $product->name }}</p>
                                    <p class="text-[12px] text-faint">{{ $product->slug }} · v{{ $product->version }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-muted">{{ $product->category->name }}</td>
                        <td class="px-5 py-3.5 font-semibold">{{ $product->price }}</td>
                        <td class="px-5 py-3.5">
                            <span class="{{ $product->available_keys < 5 ? 'font-semibold text-accent-deep' : 'text-muted' }}">{{ $product->available_keys }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <button wire:click="toggleFeatured({{ $product->id }})"
                                    class="relative h-6 w-11 rounded-full transition-colors duration-300 {{ $product->featured ? 'bg-accent' : 'bg-line' }}"
                                    aria-label="Toggle featured">
                                <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform duration-300 {{ $product->featured ? 'translate-x-5' : '' }}"></span>
                            </button>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="chip">Edit</a>
                                <button wire:click="delete({{ $product->id }})" wire:confirm="Delete “{{ $product->name }}” and all its license keys? This cannot be undone."
                                        class="chip !border-transparent !bg-accent-soft !text-accent-deep hover:!bg-accent hover:!text-ivory">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-10 text-center text-muted">No products match “{{ $search }}”.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
