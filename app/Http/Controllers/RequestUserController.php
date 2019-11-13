<?php

namespace App\Http\Controllers;

use App\User;
use App\RequestUser;
use Illuminate\Http\Request;

class RequestUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $requestedUsers = $user->getRequestedUsers();

        return view('requests.index', compact('user', 'requestedUsers'));
    }

    public function store(User $user)
    {
        // マッチしてた場合リダイレクト
        if ($user->MatchUsers->contains(auth()->user()->id)) {
            return redirect(route('posts.driver'));
        }

        auth()->user()->requestUsers()->toggle($user->id);

        return redirect(route('posts.driver'))->with('flash_message', 'リクエストを送信しました');
    }

    public function destroy(User $user)
    {
        $user->requestUsers()->toggle(auth()->user()->id);

        return redirect(route('requests.index'))
            ->with('flash_message', 'リクエストを削除しました。');
    }
}
