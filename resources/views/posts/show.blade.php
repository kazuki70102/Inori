@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="post w-100 d-flex p-4 mb-4">
                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle mr-4" width="100" height="100">
                <div class="mr-3">
                    <div class="d-flex align-items-baseline">
                        <h4 class="mr-5">{{ $post->user->name }}</h4>
                        <div class="d-flex">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', ['post' => $post]) }}" class="mr-2">編集</a>
                            @endcan
                            @can('delete', $post)
                                <a href="{{ route('posts.destroy', ['post' => $post]) }}" class="text-danger">削除</a>
                            @endcan
                        </div>
                    </div>
                    <p class="text-secondary">
                        {{ $post->user->profile->department }}
                        {{ $post->user->profile->grade }}
                    </p>
                    <p class="lead">{{ $post->content }}</p>
                    <p class="text-secondary">{{ $post->created_at }}</p>
                    @if(auth()->user()->id != $post->user->id)
                        <div class="d-flex">
                            @if($post->user_role == 'driver')
                                <request-button class="mr-2" user-id="{{ $post->user->id }}" requests="{{ $user->requestUsers->contains($post->user->id) }}"></request-button>
                            @endif
                            <follow-button user-id="{{ $post->user->id }}"
                                follows="{{ $user->followUsers->contains($post->user->id) }}"></follow-button>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
