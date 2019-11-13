@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('shared.sidebar')

        <div class="col-md-9">
            <div class="requests">
                <h4 class="my-3 orange">リクエスト一覧</h4>
                @foreach($requestedUsers as $requestedUser)
                    <div class="request w-100 d-flex p-3 mb-4 bg-white">
                        <a href="{{ route('profile.show', ['user' => $requestedUser]) }}">
                            <img src="{{ $requestedUser->profile->profileImage() }}" class="rounded-circle mr-4" width="80" height="80">
                        </a>
                        <div class="mt-2">
                            <h4 class="mb-0">{{ $requestedUser->name }}</h4>
                            <p class="text-secondary">
                                {{ $requestedUser->profile->department }}
                                {{ $requestedUser->profile->grade }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center ml-auto">
                            <form class="" action="{{ route('matches.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="rider_id" value="{{ $requestedUser->id }}">
                                <button class="btn btn-primary mr-3">
                                    承認する
                                </button>
                            </form>
                            <form class="" action="{{route('requests.destroy', ['user' => $requestedUser])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger">
                                    削除
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
