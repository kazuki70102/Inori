<?php

namespace App\Http\Controllers;

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
            'content' => 'required'
        ]);

        auth()->user()->posts()->create($data);

        return redirect(route('profile.index'));
    }
}
