@if ($paginator->hasPages())
    <nav aria-label="...">
        <ul class="pagination">
            {{-- Link da Página Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link">Anterior</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a></li>
            @endif

            {{-- Links das Páginas --}}
            @foreach ($elements as $element)
                {{-- Reticências --}}
                @if (is_string($element))
                    <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
                @endif

                {{-- Array de Links de Páginas --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Link da Próxima Página --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Próxima</a></li>
            @else
                <li class="page-item disabled"><a class="page-link">Próxima</a></li>
            @endif
        </ul>
    </nav>
@endif
