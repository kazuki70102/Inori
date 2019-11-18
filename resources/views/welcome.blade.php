@extends('layouts.app')

@section('content')
    <div style="height: 800px; background-image: url({{ asset('/img/top.jpg') }}); background-size: 100% 100%;
                background-repeat: no-repeat; margin-top: -100px;">
        <div class="container">
            <div class="col-md-6" style="padding-top: 200px;">
                <h1 class="orange" style="font-size: 80px;">Inori</h1>
                <p style="font-size: 30px;">
                    Inoriはドライバーとライダーをつなげ、学生間の交流を深めるためのマッチングサイトです。
                </p>
                <a href="#" class="btn btn-lg btn-primary mr-3">ドライバーを探す</a>
                <a href="#" class="btn btn-lg btn-outline-success">ライダーを探す</a>

            </div>
        </div>
    </div>
    <div class="container py-5 text-center">
        <h2 class="orange">Inoriの使い方</h2>
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@endsection
