@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="my-menus">
                <li class="my-menu">
                    <a href="{{ route('profile.edit', ['user' => $user]) }}">プロフィール</a>
                </li>
                <li class="my-menu">
                    <a href="{{ route('posts.create') }}">投稿する</a>
                </li>
                <li class="my-menu">
                    <a href="{{ route('matches.index') }}">マッチングリスト</a>
                </li>
                <li class="my-menu">
                    <a href="{{ route('posts.create') }}">フォローリスト</a>
                </li>
                <li class="my-menu">
                    <a href="{{ route('posts.create') }}">メッセージ</a>
                </li>
                <li class="my-menu">
                    <a href="{{ route('posts.create') }}">投稿リスト</a>
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="posts px-4">
                <h4 class="my-3 orange">タイムライン</h4>
                @foreach($posts as $post)
                    <div class="post w-100 d-flex p-4 mb-4">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle mr-4" width="80" height="80">
                        <div class="mr-3" style="width: 450px;">
                            <h5>{{ $post->user->name }}</h5>
                            <p class="text-secondary">
                                {{ $post->user->profile->department }}
                                {{ $post->user->profile->grade }}
                            </p>
                            <a href="{{ route('posts.show', ['post' => $post]) }}" class="link-black">
                                <p>{{ $post->content }}</p>
                            </a>
                            <p class="text-secondary">{{ $post->created_at }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
