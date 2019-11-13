<div class="col-md-3">
    <ul class="my-menus">
        <li class="my-menu">
            <a href="{{ route('profile.index')}}">マイページ</a>
        </li>
        <li class="my-menu">
            <a href="{{ route('posts.create') }}">投稿する</a>
        </li>
        <li class="my-menu">
            <a href="{{ route('matches.index') }}">マッチングリスト</a>
        </li>
        <li class="my-menu">
            <a href="{{ route('posts.index') }}">投稿リスト</a>
        </li>
        @if($user->role == 'driver')
            <li class="my-menu">
                <a href="{{ route('requests.index') }}">リクエスト一覧</a>
            </li>
        @endif
        <li class="my-menu">
            <a href="{{ route('profile.show', ['user' => $user]) }}">プロフィール</a>
        </li>
        <li class="my-menu">
            <a href="{{ route('follows', ['user' => $user]) }}">フォローリスト</a>
        </li>
    </ul>
</div>
