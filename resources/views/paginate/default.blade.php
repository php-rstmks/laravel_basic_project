<link rel="stylesheet" href="{{ url('css/style.css') }}">

<ul class="pagination">

    {{-- 現在のページ番号が1のとき＜前へ＞のボタンは表示させない --}}
    {{-- 非表示はblade templateのif文ではなく、cssで非表示にする --}}
    <li class="page-item" style="display: {{ ($paginator->currentPage() == 1) ? 'none' : 'block' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}">
            <span aria-hidden="true" class="page-click-button">«前へ</span>
            {{-- Previous --}}
        </a>
    </li>

    {{-- 商品の数が1 or 2ページ分しかないとき --}}
    @if ($paginator->lastPage() <= 2)

        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link page-click-button" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

    {{-- 商品の数が3ページ分存在するとき --}}
    @elseif ($paginator->lastPage() >= 3)

        {{-- 現在ページが1ページのとき --}}
        @if ($paginator->currentPage() == 1)

            {{-- 1ページ目(現在ページ) --}}
            <li class="page-item active">
                <a class="page-link page-click-button" href="{{ $paginator->url($paginator->currentPage()) }}">
                    {{ $paginator->currentPage() }}
                </a>
            </li>

            {{-- ２ページ目 --}}

            <li class="page-item">
                <a class="page-link page-click-button" href="{{ $paginator->url($paginator->currentPage() + 1)}}">
                    {{$paginator->currentPage() + 1}}
                </a>
            </li>

            {{-- 3ページ目 --}}
            <li class="page-item">

                <a class="page-link page-click-button" href="{{ $paginator->url($paginator->currentPage() + 2)}}">
                    {{$paginator->currentPage() + 2}}
                </a>
            </li>

        {{-- 現在ページが2ページ以上（最後のページよりひとつ小さいページ以下）のとき --}}
        @elseif ($paginator->currentPage() >= 2 && $paginator->currentPage() < $paginator->lastPage())

            {{-- 現在ページの一つ前のページ --}}
            <li class="page-item">
                <a class="page-link page-click-button df" href="{{ $paginator->url($paginator->currentPage() - 1)}}">
                    {{$paginator->currentPage() - 1}}
                </a>
            </li>

            {{-- 現在ページ --}}
            <li class="page-item active">
                <a class="mpage-link page-click-button" href="{{ $paginator->url($paginator->currentPage()) }}">
                    {{ $paginator->currentPage() }}
                </a>
            </li>

            {{-- 現在ページの一つ後のページ（ただし、現在のページが最後のページであるときは表示しない --}}
            @if ($paginator->currentPage() != $paginator->lastPage())
                <li class="page-item">
                    <a class="page-link page-click-button" href="{{ $paginator->url($paginator->currentPage() + 1)}}">
                        {{$paginator->currentPage() + 1}}
                    </a>
                </li>
            @endif


        @elseif ($paginator->currentPage() == $paginator->lastPage())

            <li class="page-item">
                <a class="page-link page-click-button" href="{{ $paginator->url($paginator->currentPage() - 2)}}">
                    {{$paginator->currentPage() - 2}}
                </a>
            </li>

            {{-- 現在ページの一つ前のページ --}}
            <li class="page-item">
                <a class="page-link page-click-button" href="{{ $paginator->url($paginator->currentPage() - 1)}}">
                    {{$paginator->currentPage() - 1}}
                </a>
            </li>

            {{-- 現在ページ --}}
            <li class="page-item active">
                <a class="page-link page-click-button" href="{{ $paginator->url($paginator->currentPage()) }}">
                    {{ $paginator->currentPage() }}
                </a>
            </li>

        @endif

    @endif


    {{-- 現在のページ番号が最後のページのときこのli tagは表示させない --}}
    <li class="page-item" style="display: {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'none' : 'block' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}" >
            <span ackria-hidden="true" class="page-click-button">»次へ</span>
            {{-- Next --}}
        </a>
    </li>

</ul>
