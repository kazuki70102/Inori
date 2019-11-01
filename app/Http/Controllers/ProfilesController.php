<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfilesController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return view('profiles.index', compact('user'));
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

        return redirect(route('profile.index'));
    }
}
