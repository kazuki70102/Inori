@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9 offset-2">
            <div class="posts px-4">
                <h3 class="mb-3 orange">ドライバー募集</h3>
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
