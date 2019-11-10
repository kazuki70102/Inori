@extends('layouts.app')

@section('content')
<chat user-id="{{ $user->id }}" match-user-id="{{ $matchUser->id }}"></chat>
@endsection
