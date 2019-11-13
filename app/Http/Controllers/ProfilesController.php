<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\FollowUser;
use App\RequestUser;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfilesController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $posts = Post::with('user')->latest()->paginate(6);
        $followersCount = FollowUser::where('followed_user_id', $user->id)->count();
        $followingCount = FollowUser::where('user_id', $user->id)->count();

        return view('profiles.index', compact('user', 'posts', 'followersCount', 'followingCount'));
    }

    public function show(User $user)
    {
        $followingCount = count($user->getfollowingUsers());
        $followersCount = count($user->getfollowers());
        return view('profiles.show', compact('user', 'followingCount', 'followersCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'department' => 'required',
            'grade' => 'required',
            'introduction' => 'required',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (request('image')) {
            // 画像をパブリックディスクのstorage/profile下に保存
            $imagePath = request('image')->store('profile', 'public');
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect(route('profile.show', ['user' => $user]))
                ->with('flash_message', 'プロフィールを更新しました！');
    }

}
