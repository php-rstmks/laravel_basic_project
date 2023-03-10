<button style="float: right"><a href="{{route('admin.home')}}">トップに戻る</a></button>
<h2>会員一覧</h2>
<button><a href="{{route('admin.members.registerpage')}}">会員登録</a></button>
<form action="{{route('admin.members.list')}}" method="GET">
    {{-- @csrf --}}
    <span></span>

    <div class="id">
        <span>ID</span>
    <input type="text" name="id" value="">
    </div>

        <div class="gender">
        <th>性別</th>
        <td>
          <label for="man">
            <input type="checkbox" name="man" value="1">男性
          </label>
          <label for="woman">
            <input type="checkbox" name="woman" value="2">女性
          </label>
        </td>
        </div>


    <div>
        <span>フリーワード</span>
        <input style="width: 260px;" type="text" name="free_word">
    </div>

    <button>会員検索</button>

</form>

    <table style="border: 1px black solid">
        <tr>
            <th>
                @if ($asc_flg)
                {{-- 昇順のとき以下を表示 --}}
                    <form action="{{route('admin.members.list')}}" method="GET">
                        <button>ID▼de</button>
                        <input type="hidden" name="sort_desc" value="1">
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
                @else
                {{-- 降順のとき --}}
                    <form action="{{route('admin.members.list')}}" method="GET">
                        <button>ID▼as</button>
                        <input type="hidden" name="sort_asc" value="1">
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
            <th>氏名</th>
            <th>メールアドレス</th>
            <th>性別</th>
            <th>
                @if ($asc_flg)
                {{-- 昇順のとき以下を表示 --}}
                    <form action="{{route('admin.members.list')}}" method="GET">
                        <button>登録日時▼de</button>
                        <input type="hidden" name="sort_desc" value="0">

                    </form>
                @else
                {{-- 降順のとき --}}
                    <form action="{{route('admin.members.list')}}" method="GET">
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
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td><a href="{{ route('admin.members.detailpage', $member) }}">{{$member->name_sei}}{{$member->name_mei}}</a></td>
                <td>{{$member->email}}</td>
                <td>
                    @if ($member->gender == 1)
                    <div>男性</div>
                @elseif ($member->gender == 2)
                    <div>女性</div>
                @endif
                </td>
                <td>{{$member->created_at}}</td>
                <td><a href="{{ route('admin.members.editpage', $member) }}">編集</a></td>
                <td><a href="{{ route('admin.members.detailpage', $member) }}">詳細</a></td>
            </tr>
        @endforeach
    </table>

{{-- 会員表示 --}}
{{-- デフォルトでの表示 --}}
@if (!$return_state)
    <div class="pagination default">
        {{ $members->links('paginate.default') }}
    </div>

{{-- 昇順トグル、検索条件での表示のとき --}}
@else
    <div class="pagination">
        {{ $members->appends(request()->query())->links('paginate.default') }}
    </div>
@endif
