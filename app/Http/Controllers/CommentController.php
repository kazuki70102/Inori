<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class CommentController extends Controller
{
    public function store()
    {
        $post = Post::find(request('post_id'));
        $data = ['user_id' => auth()->user()->id];

        $validate = request()->validate([
            'post_id' => 'required',
            'comment' => 'required|max:255'
        ]);

        $data = array_merge($data, $validate);

        $post->comments()->create($data);

        return redirect(route('posts.show', ['post' => $post]))
                    ->with('flash_message', 'コメントしました！');
    }
}
