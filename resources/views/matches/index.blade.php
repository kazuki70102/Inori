@extends('layouts.app')
@inject('match', 'App\Services\MatchService')

@section('content')
<div class="container">
    <div class="row">

        @include('shared.sidebar')

        <div class="col-md-9">
            <div class="requests">
                <h4 class="my-3 orange">マッチングしたユーザー</h4>
                @foreach($matchUsers as $matchUser)
                    <div class="request w-100 d-flex p-3 mb-4 bg-white">
                        <a href="{{ route('profile.show', ['user' => $matchUser]) }}">
                            <img src="{{ $matchUser->profile->profileImage() }}" class="rounded-circle mr-4" width="80" height="80">
                        </a>
                        <div class="mt-2">
                            <h4 class="mb-0">{{ $matchUser->name }}</h4>
                            <p class="text-secondary">
                                {{ $matchUser->profile->department }}
                                {{ $matchUser->profile->grade }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center ml-auto">
                            <form action="{{ route('messages.show', ['matchId' => $match->getMatchId($matchUser)]) }}" method="get">
                                <input type="hidden" name="matchUserId" value="{{ $matchUser->id }}">
                                <button class="btn btn-primary mr-3">
                                    メッセージを送る
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
