<?php

namespace App\Http\Controllers;

use App\User;
use App\FollowUser;
use Illuminate\Http\Request;

class FollowUserController extends Controller
{
    public function store(User $user)
    {
        return auth()->user()->followUsers()->toggle($user->id);
    }
}
