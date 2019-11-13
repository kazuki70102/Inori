@extends('layouts.app')

@section('content')
<div class="profile-top" style="">
    <h1>{{ $user->name }}</h1>
    <img src="{{ $user->profile->profileImage() }}" class="rounded-circle">
</div>
<div class="container-fluid" style="padding-top: 100px;">
    <div class="row">
        <div class="col-md-2" style="margin-left: 70px;">
            <div class="mb-2">
                <p class="text-secondary m-0">
                    {{ $user->profile->department }}  {{ $user->profile->grade }}
                </p>
            </div>
            <div class="d-flex text-center">
                <div class="mr-4">
                    <a href="#">
                        <p>フォロー
                        <br>{{ $followingCount }}</p>
                    </a>
                </div>
                <div>
                    <a href="#">
                        <p>フォロワー
                        <br>{{ $followersCount }}</p>
                    </a>
                </div>
            </div>
            <div class="mb-3">
                @if(auth()->user()->requestUsers->contains($user->id))
                    <div class="btn btn-outline-primary w-100 mb-3">
                        リクエスト済み
                    </div>
                @else
                    <form action="{{ route('requests.store', ['user' => $user]) }}" method="post">
                        @csrf
                        <button class="btn btn-outline-primary w-100 mb-3">
                            リクエスト
                        </button>
                    </form>
                @endif
                <follow-button user-id="{{ $user->id }}"
                    follows="{{ auth()->user()->followUsers->contains($user->id) }}">
                </follow-button>
            </div>
            @can('update', $user->profile)
                <a href="{{ route('profile.edit', ['user' => $user]) }}" class="text-primary">
                    プロフィールを編集する
                </a>
            @endcan
        </div>

        <div class="col-md-7 offset-1">
            <div class="bg-white p-4" style="height: 300px;">
                {{ $user->profile->introduction }}
            </div>
        </div>
    </div>
</div>
@endsection
