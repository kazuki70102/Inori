@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">本登録を完了させてください</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            新しい本登録用のメールを送信しました。
                        </div>
                    @endif

                    メールを確認して本登録を完了させてください。
                    もしメールを受け取れない場合は、
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">ここをクリックしてください。</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
