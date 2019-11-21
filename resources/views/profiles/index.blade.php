@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('shared.sidebar')

        <div class="col-md-9">
            <div class="posts px-4">
                <h4 class="my-3 orange">タイムライン</h4>
                @foreach($posts as $post)
                    <div class="post w-100 d-flex p-4 mb-4">
                        <a href="{{ route('profile.show', ['user' => $post->user]) }}">
                            <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle mr-4" width="80" height="80">
                        </a>
                        <div class="mr-3" style="width: 450px;">
                            <h5>{{ $post->user->name }}</h5>
                            <p class="text-secondary">
                                {{ $post->user->profile->department }}
                                {{ $post->user->profile->grade }}
                            </p>
                            <a href="{{ route('posts.show', ['post' => $post]) }}" class="link-black">
                                <p>{{ $post->content }}</p>
                            </a>
                            <p class="text-secondary">{{ $post->created_at }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
    if (window.location.hash && window.location.hash == '#_=_') {
       if (window.history && history.pushState) {
           window.history.pushState("", document.title, window.location.pathname);
       } else {
           // Prevent scrolling by storing the page's current scroll offset
           var scroll = {
               top: document.body.scrollTop,
               left: document.body.scrollLeft
           };
           window.location.hash = '';
           // Restore the scroll offset, should be flicker free
           document.body.scrollTop = scroll.top;
           document.body.scrollLeft = scroll.left;
       }
    }
    </script>
@endsection
