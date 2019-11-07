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
            <h2 class="mb-5">マッチングしたユーザー</h2>
            <div class="requests">
                @foreach($matchUsers as $matchUser)
                    <div class="request w-100 d-flex p-3 mb-4 bg-white">
                        <img src="{{ $matchUser->profile->profileImage() }}" class="rounded-circle mr-4" width="80" height="80">
                        <div class="mt-2">
                            <h4 class="mb-0">{{ $matchUser->name }}</h4>
                            <p class="text-secondary">
                                {{ $matchUser->profile->department }}
                                {{ $matchUser->profile->grade }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center ml-auto">

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
