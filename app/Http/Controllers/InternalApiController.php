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
        $currentUserId = auth()->id();
        $users = User::where('id', '!=', $currentUserId)
            ->orderBy('is_online', 'desc')
            ->get();

        $users->map(function ($user) use ($currentUserId) {
            $user->unread_count = ChatMessage::where('sender_id', $user->id)
                ->where('receiver_id', $currentUserId)
                ->where('is_read', false)
                ->count();
        });
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
    public function markMessagesAsRead(User $user)
    {
        ChatMessage::where('sender_id', $user->id)
            ->where('receiver_id', auth()->id())
            ->update(['is_read' => true]);

        return response()->json(['message' => 'Messages marked as read']);
    }
}
