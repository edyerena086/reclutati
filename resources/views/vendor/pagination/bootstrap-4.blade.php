@if ($paginator->hasPages())
    <div class="clearfix"></div>
        <div class="pagination-container margin-top-20 margin-bottom-20">
            <nav class="pagination">
                <ul>
                    {{-- previous --}}
                    @if (!$paginator->onFirstPage())
                        <li class="pagination-arrow"><a href="{{ $paginator->previousPageUrl() }}" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                    @endif

                    {{-- Paginator --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>&lsaquo;</li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li><a href="{{ $url }}" class="ripple-effect current-page">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}" class="ripple-effect">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                        {{--<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>--}}
                    @endforeach

                    {{-- next --}}
                    @if ($paginator->hasMorePages())
                        <li class="pagination-arrow"><a href="{{ $paginator->nextPageUrl() }}" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                    @endif
                </ul>
            </nav>
        </div>
        <div class="clearfix"></div>
@endif
