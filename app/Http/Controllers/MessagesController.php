<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class MessagesController extends Controller
{

    public function index()
    {
        return Message::orderBy('id', 'desc')->get();
    }

    public function show(Request $request)
    {
        Gate::authorize('show-message', $request->matchId);

        return view('messages.index');


    }

    public function create(Request $request)
    {
        $message = Message::create(['message' => $request->message]);

        event(new MessageCreated($message));
    }
}
