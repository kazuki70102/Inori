@extends('layouts.app')

@section('content')
<div class="container">
    <form class="" action="/post" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>新規投稿</h1>
                </div>

                <div class="form-group row">
                    <textarea id="content" name="content" rows="8" cols="80" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">投稿する</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
