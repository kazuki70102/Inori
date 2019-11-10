<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class MessagesController extends Controller
{

    public function index()
    {
        return Message::orderBy('created_at', 'asc')->get();
    }

    public function show(Request $request)
    {
        Gate::authorize('show-message', $request->matchId);

        $user = auth()->user();
        $matchUser = User::find($request->matchUserId);

        return view('messages.show', compact('user', 'matchUser'));


    }

    public function store()
    {
        $data = request()->validate([
            'message' => 'required',
            'send_user_id' => 'required',
            'recieve_user_id' => 'required'
        ]);


        $message = Message::create($data);

        event(new MessageCreated($message));
    }
}
