<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $posts = Post::where('user_id' , $user->id)->with('user')->latest()->paginate(6);

        return view('posts.index', compact('user', 'posts'));
    }

    public function driver()
    {
        $user = auth()->user();
        $posts = Post::where('user_role', 'driver')->with('user')->latest()->paginate(6);

        return view('posts.driver', compact('user', 'posts'));
    }

    public function rider()
    {
        $user = auth()->user();
        $posts = Post::where('user_role', 'rider')->with('user')->latest()->paginate(6);

        return view('posts.rider', compact('user', 'posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = ['user_role' => auth()->user()->role];
        $validate = request()->validate([
            'content' => 'required|max:255'
        ]);

        $data = array_merge($data, $validate);

        auth()->user()->posts()->create($data);

        return redirect(route('profile.index'))->with('flash_message', '投稿しました！');
    }

    public function show(Post $post)
    {
        $user = auth()->user();
        $comments = $post->comments()->with('user')->get();

        return view('posts.show', compact('user', 'post', 'comments'));
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

        return redirect(route('profile.index'))->with('flash_message', '投稿を編集しました！');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        Post::find($post->id)->delete();

        return redirect(route('profile.index'))->with('flash_message', '投稿を削除しました！');
    }


}
