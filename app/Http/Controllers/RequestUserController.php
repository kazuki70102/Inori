<?php

namespace App\Http\Controllers;

use App\User;
use App\RequestUser;
use Illuminate\Http\Request;

class RequestUserController extends Controller
{
    public function store(User $user)
    {
        return auth()->user()->requestUsers()->toggle($user->id);
    }
}
