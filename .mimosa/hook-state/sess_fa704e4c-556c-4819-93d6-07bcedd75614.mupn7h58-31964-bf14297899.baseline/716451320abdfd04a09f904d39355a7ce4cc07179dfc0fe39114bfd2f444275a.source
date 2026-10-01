@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex flex-wrap items-center justify-center gap-2">
        {{-- previous --}}
        <button class="page-btn" {{ $paginator->onFirstPage() ? 'disabled' : '' }}
                wire:click="previousPage('{{ $paginator->getPageName() }}')" aria-label="Previous page">
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 6l-6 6 6 6"/>
            </svg>
        </button>

        @foreach ($elements as $element)
            {{-- '...' separator --}}
            @if (is_string($element))
                <span class="page-btn border-transparent !text-faint">{{ $element }}</span>
            @elseif (is_array($element))
                @foreach ($element as $page)
                    <button class="page-btn {{ $page === $paginator->currentPage() ? 'border-transparent bg-ink text-ivory' : '' }}"
                            wire:key="page-{{ $page }}"
                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                @endforeach
            @endif
        @endforeach

        {{-- next --}}
        <button class="page-btn" {{ $paginator->hasMorePages() ? '' : 'disabled' }}
                wire:click="nextPage('{{ $paginator->getPageName() }}')" aria-label="Next page">
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 6l6 6-6 6"/>
            </svg>
        </button>
    </nav>
@endif
