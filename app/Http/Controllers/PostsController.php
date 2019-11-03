<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'content' => 'required|max:255'
        ]);

        auth()->user()->posts()->create($data);

        return redirect(route('profile.index'))->with('flash_message', '投稿しました。');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $data = request()->validate([
            'content' => 'required|max:255'
        ]);

        $post->update($data);

        return redirect(route('profile.index'))->with('flash_message', '投稿を編集しました。');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        Post::find($post->id)->delete();

        return redirect(route('profile.index'))->with('flash_message', '投稿を削除しました。');
    }


}
