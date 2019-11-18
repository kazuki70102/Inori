@extends('layouts.app')

@section('content')
    <div style="height: 800px; background-image: url({{ asset('/img/top.jpg') }}); background-size: 100% 100%;
                background-repeat: no-repeat; margin-top: -100px;">
        <div class="container">
            <div class="col-md-6" style="padding-top: 200px;">
                <h1 class="orange" style="font-size: 80px;">Inori</h1>
                <p style="font-size: 30px;">
                    Inoriは同じ大学に通うドライバーとライダーをつなげ、学生間の交流を深めるためのマッチングサイトです。
                </p>
                <a href="{{ route('posts.driver') }}" class="btn btn-lg btn-primary mr-3">ドライバーを探す</a>
                <a href="{{ route('posts.rider') }}" class="btn btn-lg btn-outline-success">ライダーを探す</a>

            </div>
        </div>
    </div>
    <div class="container py-5 text-center">
        <h1 class="orange">Inoriの使い方</h1>
        <div class="row py-5">
            <div class="col-md-4 lead">
                <img src="{{ asset('/img/person.png') }}" class="pull-center">
                <p>ライダーは投稿をしたり、見たりして条件が合いそうなドライバーにリクエストを送ろう。</p>
            </div>
            <div class="col-md-4 lead">
                <img src="{{ asset('/img/message.png') }}" class="pull-center">
                <p>ドライバーがリクエストを承認したらマッチング成功！メッセージを送って詳しい話をする。</p>
            </div>
            <div class="col-md-4 lead">
                <img src="{{ asset('/img/car.png') }}" class="pull-center">
                <p>詳細が決まり、当日になったら一緒に登校しよう！</p>
            </div>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg py-3 px-5">さっそく始める！</a>
    </div>
@endsection
