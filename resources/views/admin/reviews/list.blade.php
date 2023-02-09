<button style="float: right"><a href="{{route('admin.home')}}">トップに戻る</a></button>
<h2>商品レビュー一覧</h2>
<button><a href="{{route('admin.reviews.registerpage')}}">商品登録</a></button>
<form action="{{route('admin.reviews.list')}}" method="GET">
    {{-- @csrf --}}
    <span></span>

    <div class="id">
        <span>ID</span>
        <input type="text" name="id" value="">
    </div>

    <div>
        <span>フリーワード</span>
        <input style="width: 260px;" type="text" name="free_word">
    </div>

    <button>検索する</button>

</form>

    <table style="border: 1px black solid">
        <tr>
            <th>
                @if ($asc_flg)
                {{-- 昇順のとき以下を表示 --}}
                    <form action="{{route('admin.reviews.list')}}" method="GET">
                        <button>ID▼de</button>
                        <input type="hidden" name="sort_desc" value="1">
                        {{-- 検索条件で表示されたデータに対して、昇順、降順をするためのプログラム --}}
                        @if (isset($free_word))
                            <input type="hidden" name="free_word" value={{$free_word}}>
                        @endif
                    </form>
                @else
                {{-- 降順のとき --}}
                    <form action="{{route('admin.reviews.list')}}" method="GET">
                        <button>ID▼as</button>
                        <input type="hidden" name="sort_asc" value="1">
                        {{-- 検索条件で表示されたデータに対して、昇順、降順をするためのプログラム --}}
                        @if (isset($free_word))
                            <input type="hidden" name="free_word" value={{$free_word}}>
                        @endif
                    </form>
                @endif
            </th>
            <th>商品ID</th>
            <th>評価</th>
            <th>商品コメント</th>
            <th>
                @if ($asc_flg)
                {{-- 昇順のとき以下を表示 --}}
                    <form action="{{route('admin.reviews.list')}}" method="GET">
                        <button>登録日時▼de</button>
                        <input type="hidden" name="sort_desc" value="0">

                    </form>
                @else
                {{-- 降順のとき --}}
                    <form action="{{route('admin.reviews.list')}}" method="GET">
                        <button>登録日時▼as</button>
                        <input type="hidden" name="sort_asc" value="0">

                        {{-- 検索条件で表示されたデータに対して、昇順、降順をするためのプログラム --}}
                        @if (isset($man))
                            <input type="hidden" name="man" value={{$man}}>
                        @endif
                        @if (isset($woman))
                            <input type="hidden" name="woman" value={{$woman}}>
                        @endif
                        @if (isset($free_word))
                            <input type="hidden" name="free_word" value={{$free_word}}>
                        @endif
                    </form>
                @endif
            </th>
            <th>編集</th>
        </tr>
        @foreach($reviews as $review)
            <tr>
                <td>{{$review->id}}</td>
                <td>{{$review->product_id}}</td>
                <td>{{$review->evaluation}}</td>
                <td>{{$review->comment}}</td>
                <td><a href="{{ route('admin.reviews.editpage', $review) }}">編集</a></td>
                <td><a href="{{ route('admin.reviews.detailpage', $review) }}">詳細</a></td>
            </tr>
        @endforeach
    </table>

{{-- 会員表示 --}}
{{-- デフォルトでの表示 --}}
@if (!$return_state)
    <div class="pagination default">
        {{ $reviews->links('paginate.default') }}
    </div>

{{-- 昇順トグル、検索条件での表示のとき --}}
@else
    <div class="pagination">
        {{ $reviews->appends(request()->query())->links('paginate.default') }}
    </div>
@endif
