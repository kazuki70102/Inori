@extends('layouts.app')
@inject('match', 'App\Services\MatchService')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h2>{{ $matchUser->name }}さんとのメッセージ</h2>
        </div>
        <chat user-id="{{ $user->id }}" match-user-id="{{ $matchUser->id }}"
            match-user-name="{{ $matchUser->name }}"
            match-user-image="{{ $matchUser->profile->profileImage() }}"
            match-id="{{ $match->getMatchId($matchUser) }}">
        </chat>
    </div>
</div>
@endsection
