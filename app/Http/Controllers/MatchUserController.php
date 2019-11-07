<?php

namespace App\Http\Controllers;

use App\User;
use App\MatchUser;
use Illuminate\Http\Request;

class MatchUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'driver') {
            $matchUsers = $user->getMatchRiders();
        } else {
            $matchUsers = $user->getMatchDrivers();
        }

        return view('matches.index', compact('user', 'matchUsers'));
    }

    public function store(Request $request)
    {
        $riderId = $request->rider_id;
        auth()->user()->MatchUsers()->attach($riderId);

        return redirect(route('matches.index'))->with('flash_message', 'マッチングしました！');
    }
}
