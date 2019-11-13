@extends('layouts.app')
@inject('match', 'App\Services\MatchService')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <h2 class="mb-5 orange">マッチングしたユーザー</h2>
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
