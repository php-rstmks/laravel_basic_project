<link rel="stylesheet" href="{{ url('css/style.css') }}">

{{-- pagerが二ページ分あるときに表示させる。 --}}
@if ($paginator->lastPage() > 1)
<ul class="pagination">

    {{-- 現在のページ番号が1のときこのli tagは表示させない --}}
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="page-link page-click-button" href="{{ $paginator->url(1) }}">First Page</a>
     </li>

    {{-- 現在のページ番号が1のときこのli tagは表示させない --}}
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url(1) }}">
            <span aria-hidden="true" class="page-click-button">«</span>
            {{-- Previous --}}
        </a>
    </li>

    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a class="page-link page-click-button" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
    @endfor

    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" >
            <span ackria-hidden="true" class="page-click-button">»</span>
            {{-- Next --}}
        </a>
    </li>
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link  page-click-button" href="{{ $paginator->url($paginator->lastPage()) }}">Last Page</a>
    </li>
</ul>
@endif
