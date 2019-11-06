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
        $requestedUsers = $user->requestedUsers();
        return view('requests.index', compact('user', 'requestedUsers'));
    }

    public function store(User $user)
    {
        return auth()->user()->requestUsers()->toggle($user->id);
    }
}
