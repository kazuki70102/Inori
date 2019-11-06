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
                <p>{{ $user->profile->introduction }}</p>
                <a href="{{ route('profile.edit', ['user' => $user]) }}">プロフィール編集</a>
                <a href="{{ route('posts.create') }}">投稿する</a>
            </div>
        </div>

        <div class="col-md-8 offset-1">
            <h2 class="mb-5">リクエスト</h2>
            <div class="requests">
                @foreach($requestedUsers as $requestedUser)
                    <div class="request w-100 d-flex p-3 mb-4 bg-white">
                        <img src="{{ $requestedUser->profile->profileImage() }}" class="rounded-circle mr-4" width="80" height="80">
                        <div class="mt-2">
                            <h4 class="mb-0">{{ $requestedUser->name }}</h4>
                            <p class="text-secondary">
                                {{ $requestedUser->profile->department }}
                                {{ $requestedUser->profile->grade }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center ml-auto">
                            <button type="button" class="btn btn-primary mr-3">
                                承認する
                            </button>
                            <a href="{{ route('requests.delete', ['user' => $requestedUser]) }}">
                                <button type="button" class="btn btn-outline-danger">
                                    削除
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
            </div>
        </div>
    </div>
</div>
@endsection
