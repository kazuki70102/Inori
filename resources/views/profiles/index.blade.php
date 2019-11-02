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
                <div class="d-flex">
                    <div class="mr-3">
                        <p>フォロー
                        <br>223</p>
                    </div>
                    <div class="mr-3">
                        <p>フォロワー
                        <br>2</p>
                    </div>
                </div>
                <p>{{ $user->profile->introduction }}</p>
                <a href="/profile/{{ $user->profile->id }}/edit">プロフィール編集</a>
                <a href="#">投稿する</a>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="mb-5">投稿一覧</h2>
            <div class="posts px-4">

                <div class="post w-100 d-flex bg-white p-4 mb-4">
                    <img src="https://pbs.twimg.com/profile_images/875091517198614528/eeNe_9Pc_400x400.jpg" class="rounded-circle mr-4" width="80" height="80">
                    <div class="mr-3">
                        <h5>ユーザー名２</h5>
                        <p class="text-secondary">経済学類 4年</p>
                        <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
                        <p class="text-secondary">2019-11-23</p>
                    </div>
                    <div style="width: 350px;">
                        <div class="btn btn-outline-primary w-100 mb-3">
                            リクエスト
                        </div>
                        <div class="btn btn-outline-dark w-100">
                            フォロー
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
