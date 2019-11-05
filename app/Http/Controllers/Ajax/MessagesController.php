<?php

namespace App\Http\Controllers\Ajax;

use App\Message;
use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MessagesController extends Controller
{
    public function index()
    {
        return Message::orderBy('id', 'desc')->get();
    }

    public function create(Request $request)
    {
        $message = Message::create(['message' => $request->message]);

        event(new MessageCreated($message));
    }
}
