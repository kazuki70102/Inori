@extends('layouts.app')

@section('content')
<div class="container">
    <form class="" action="{{ route('profile.edit', ['user' => $user]) }}"
          method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>プロフィール編集</h1>
                </div>
                <div class="form-group row">
                    <label for="department" class="col-md-4 col-form-label">学類</label>

                    <input id="department"
                           type="text"
                           class="form-control @error('department') is-invalid @enderror"
                           name="department"
                           value="{{ old('department') ?? $user->profile->department }}"
                           required autocomplete="department" autofocus>

                    @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="grade" class="col-md-4 col-form-label">学年</label>

                    <select id="grade"
                            class="form-control @error('grade') is-invalid @enderror"          name="grade">
                        <option value="1年生">1年生</option>
                        <option value="2年生">2年生</option>
                        <option value="3年生">3年生</option>
                        <option value="4年生">4年生</option>
                        <option value="大学院1年生">大学院1年生</option>
                        <option value="大学院2年生">大学院2年生</option>
                    </select>

                    @error('grade')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="introduction" class="col-md-4 col-form-label">自己紹介</label>

                    <textarea id="introduction" name="introduction" rows="8" cols="80" class="form-control @error('introduction') is-invalid @enderror">{{ old('introduction') ?? $user->profile->introduction }}</textarea>

                    @error('introduction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">プロフィール画像</label>

                    <input id="image" type="file" name="image" class="form-control-file" value="">

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif -->
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">プロフィールを保存する</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
