@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="pagination-container" style="display: flex; align-items: center; justify-content: space-between; margin-top: 24px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        
        <div style="display: flex; align-items: center; color: var(--text-muted, #86868b); font-size: 13px;">
            {!! __('Mostrando') !!}
            @if ($paginator->firstItem())
                <span style="font-weight: 600; color: var(--text-color, #1d1d1f); margin: 0 4px;">{{ $paginator->firstItem() }}</span>
                {!! __('al') !!}
                <span style="font-weight: 600; color: var(--text-color, #1d1d1f); margin: 0 4px;">{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('de') !!}
            <span style="font-weight: 600; color: var(--text-color, #1d1d1f); margin: 0 4px;">{{ $paginator->total() }}</span>
            {!! __('resultados') !!}
        </div>

        <div style="display: flex; gap: 8px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background-color: var(--input-bg, #f5f5f7); color: var(--text-muted, #86868b); opacity: 0.5; cursor: not-allowed;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background-color: var(--input-bg, #f5f5f7); color: var(--text-color, #1d1d1f); text-decoration: none; transition: background-color 0.2s ease;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; color: var(--text-muted, #86868b);">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background-color: var(--primary-color, #0071e3); color: white; font-weight: 600; font-size: 14px; box-shadow: 0 4px 10px rgba(0, 113, 227, 0.2);">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background-color: transparent; color: var(--text-color, #1d1d1f); font-weight: 500; font-size: 14px; text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='var(--input-bg, #f5f5f7)'" onmouseout="this.style.backgroundColor='transparent'">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background-color: var(--input-bg, #f5f5f7); color: var(--text-color, #1d1d1f); text-decoration: none; transition: background-color 0.2s ease;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background-color: var(--input-bg, #f5f5f7); color: var(--text-muted, #86868b); opacity: 0.5; cursor: not-allowed;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
