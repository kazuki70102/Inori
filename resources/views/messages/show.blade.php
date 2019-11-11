@extends('layouts.app')
@inject('match', 'App\Services\MatchService')

@section('content')
<chat user-id="{{ $user->id }}" match-user-id="{{ $matchUser->id }}"
    match-user-name="{{ $matchUser->name }}"
    match-user-image="{{ $matchUser->profile->profileImage() }}"
    match-id="{{ $match->getMatchId($matchUser) }}">
</chat>
@endsection
