@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9 offset-2">
            <h2 class="mb-5">ドライバーを探す</h2>
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
                                @if($user->requestUsers->contains($post->user->id))
                                    <div class="btn btn-outline-primary w-100 mb-3">
                                        リクエスト済み
                                    </div>
                                @else
                                    <form action="{{ route('requests.store', ['user' => $post->user]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-outline-primary w-100 mb-3">
                                            リクエスト
                                        </button>
                                    </form>
                                @endif
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
