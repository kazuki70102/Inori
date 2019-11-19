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
                                <a href="{{ route('posts.edit', ['post' => $post]) }}" class="mr-2 text-primary">
                                    編集
                                </a>
                            @endcan
                            @can('delete', $post)
                                <a href="{{ route('posts.destroy', ['post' => $post]) }}" class="text-danger">
                                    削除
                                </a>
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
                                @if($user->requestUsers->contains($post->user->id))
                                    <form action="{{ route('requests.store', ['user' => $post->user]) }}" method="post" class="mr-3">
                                        @csrf
                                        <button class="btn btn-outline-primary">
                                            リクエスト
                                        </button>
                                    </form>
                                @else
                                    <div class="btn btn-outline-primary mb-3 mr-3">
                                        リクエスト済み
                                    </div>
                                @endif
                            @endif
                            <follow-button user-id="{{ $post->user->id }}"
                                follows="{{ $user->followUsers->contains($post->user->id) }}">
                            </follow-button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="comments w-100 bg-white px-5 py-4">
                <div class="comment mb-5">
                    <div class="mb-3">
                        <div class="d-flex">
                            <img src="https://inori-app.s3-ap-northeast-1.amazonaws.com/myimage/noimage.png" width="50" height="50" class="rounded-circle mr-3">
                            <div class="balloon2">
                                <span class="ml-3">name</span>
                                <div class="chatting">
                                  <div class="says">
                                    <p>左ふきだし文</p>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="" action="" method="post">
                    <div class="form-group row">
                        <textarea id="comment" name="comment" rows="4" cols="80" class="mx-3 form-control @error('comment') is-invalid @enderror">{{ old('comment') ?? $user->profile->comment }}</textarea>

                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button name="button" class="w-100 btn btn-secondary">コメントする</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
