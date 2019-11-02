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
                        <div>
                            <a href="#" class="mr-2">編集</a>
                            <a href="#" class="text-danger">削除</a>
                        </div>
                    </div>
                    <p class="text-secondary">
                        {{ $post->user->profile->department }}
                        {{ $post->user->profile->grade }}
                    </p>
                    <p class="lead">{{ $post->content }}</p>
                    <p class="text-secondary">{{ $post->created_at }}</p>
                    <div>
                        <div class="btn btn-outline-primary mr-3">
                            リクエスト
                        </div>
                        <div class="btn btn-outline-dark">
                            フォロー
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
