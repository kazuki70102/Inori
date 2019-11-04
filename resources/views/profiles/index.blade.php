@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 mt-5">
            <div class="bg-white p-3">
                <div class="d-flex pb-4 align-items-end">
                    <img src="{{ $user->profile->profileImage() }}" class="rounded-circle mr-2" width="100">
                    <div>
                        <h4>{{ $user->name }}</h4>
                        <p class="text-secondary m-0">
                            {{ $user->profile->department }} {{ $user->profile->grade }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="mr-3">
                        <p>フォロー
                        <br>{{ $followingCount }}</p>
                    </div>
                    <div class="mr-3">
                        <p>フォロワー
                        <br>{{ $followersCount }}</p>
                    </div>
                </div>
                <p>{{ $user->profile->introduction }}</p>
                <a href="{{ route('profile.edit', ['user' => $user]) }}">プロフィール編集</a>
                <a href="{{ route('posts.create') }}">投稿する</a>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="mb-5">投稿一覧</h2>
            <div class="posts px-4">
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
                        @if(auth()->user()->id != $post->user->id)
                            <div style="width: 130px;">
                                <request-button user-id="{{ $post->user->id }}"
                                    requests="{{ $user->requestUsers->contains($post->user->id) }}">
                                </request-button>
                                <follow-button user-id="{{ $post->user->id }}"
                                    follows="{{ $user->followUsers->contains($post->user->id) }}">
                                </follow-button>
                            </div>
                        @endif
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
