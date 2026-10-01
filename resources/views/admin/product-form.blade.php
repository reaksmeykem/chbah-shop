<div class="mx-auto max-w-2xl">
    <div class="mb-8">
        <a href="{{ route('admin.products') }}" class="link-underline text-sm text-muted">← All products</a>
        <h1 class="display mt-3 text-3xl font-semibold">
            {{ $product?->exists ? 'Edit “' . $product->name . '”' : 'New product' }}
        </h1>
    </div>

    <form wire:submit="save" class="space-y-6">
        <section class="rounded-[22px] border border-line-soft bg-white/80 p-6 shadow-soft">
            <h2 class="display mb-4 text-lg font-semibold">Identity</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Name *</span>
                    <input type="text" wire:model.live="name" class="field" placeholder="Chbah Cam">
                    @error('name') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Slug (URL) *</span>
                    <input type="text" wire:model="slug" class="field font-mono text-[13px]" placeholder="chbah-cam">
                    @error('slug') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Category *</span>
                    <select wire:model="category_id" class="field">
                        <option value="">Choose…</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Badge</span>
                    <select wire:model="badge" class="field">
                        <option value="">None</option>
                        <option value="New">New</option>
                        <option value="Bestseller">Bestseller</option>
                    </select>
                </label>
                <label class="block sm:col-span-2">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Tagline *</span>
                    <input type="text" wire:model="tagline" class="field" placeholder="Your phone is a pro webcam">
                    @error('tagline') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block sm:col-span-2">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Description *</span>
                    <textarea wire:model="description" rows="4" class="field"></textarea>
                    @error('description') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
            </div>
        </section>

        <section class="rounded-[22px] border border-line-soft bg-white/80 p-6 shadow-soft">
            <h2 class="display mb-4 text-lg font-semibold">Pricing & license</h2>
            <div class="grid gap-4 sm:grid-cols-3">
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Price (USD) *</span>
                    <input type="number" step="0.01" min="0" wire:model="price" class="field" placeholder="24.00">
                    @error('price') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Version *</span>
                    <input type="text" wire:model="version" class="field" placeholder="1.0">
                    @error('version') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Key prefix *</span>
                    <input type="text" wire:model="key_prefix" class="field font-mono uppercase text-[13px]" placeholder="CHCM">
                    @error('key_prefix') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
            </div>
        </section>

        <section class="rounded-[22px] border border-line-soft bg-white/80 p-6 shadow-soft">
            <h2 class="display mb-4 text-lg font-semibold">Details</h2>
            <div class="grid gap-4">
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">System requirements *</span>
                    <input type="text" wire:model="requirements" class="field" placeholder="Windows 10/11 · 64-bit">
                    @error('requirements') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Download URL (trial / installer)</span>
                    <input type="text" wire:model="download_url" class="field font-mono text-[13px]" placeholder="https://…">
                    @error('download_url') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-[13px] font-medium text-ink-soft">Features — one per line *</span>
                    <textarea wire:model="features" rows="5" class="field" placeholder="Real-time noise suppression&#10;Virtual mic for OBS, Discord, Zoom"></textarea>
                    @error('features') <p class="mt-1 text-[12px] text-accent-deep">{{ $message }}</p> @enderror
                </label>

                <div class="flex flex-wrap items-center gap-6 pt-1">
                    <label class="flex cursor-pointer items-center gap-2.5 text-sm font-medium text-ink-soft">
                        <input type="checkbox" wire:model="featured" class="h-4 w-4 accent-[#d97757]">
                        Featured on the home page
                    </label>
                    <label class="flex cursor-pointer items-center gap-2.5 text-sm font-medium text-ink-soft">
                        <input type="checkbox" wire:model="generate_art" class="h-4 w-4 accent-[#d97757]">
                        {{ $product?->exists ? 'Regenerate app-icon artwork' : 'Generate app-icon artwork' }}
                    </label>
                </div>
            </div>
        </section>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.products') }}" class="btn-ghost px-6 py-3 text-sm">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 text-sm" wire:loading.attr="disabled">
                {{ $product?->exists ? 'Save changes' : 'Create product' }}
            </button>
        </div>
    </form>
</div>
