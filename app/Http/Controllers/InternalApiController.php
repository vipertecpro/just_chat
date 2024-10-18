<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class InternalApiController extends Controller
{
    public function onlineUsers(Request $request)
    {
        $users = User::where('id','!=',auth()->id())->orderBy('is_online', 'desc')->get();
        return response()->json($users);
    }
    public function singleChat(User $user){
        $conversation =  ChatMessage::query()
            ->where(function ($query) use ($user) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', auth()->id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('id', 'asc')
            ->get()
            ->append(['created_at_formatted', 'created_at_relative']);
        return response()->json($conversation);
    }
    public function sendMessageSingleChat(User $user, Request $request){
        $message = ChatMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'text' => $request->get('message')
        ]);

        broadcast(new MessageSent($message));

        return $message;
    }
}
