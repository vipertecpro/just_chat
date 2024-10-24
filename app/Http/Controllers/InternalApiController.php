<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class InternalApiController extends Controller
{
    public function onlineUsers(Request $request)
    {
        $currentUserId = auth()->id();

        $users = User::where('id', '!=', $currentUserId)
            ->withCount(['sentMessages as latest_unread_message' => function ($query) use ($currentUserId) {
                $query->where('receiver_id', $currentUserId)
                    ->where('is_read', false)
                    ->select(DB::raw('MAX(created_at)'));
            }])
            ->orderBy('latest_unread_message', 'desc')
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
    public function markMessagesAsRead(Request $request, $userId)
    {
        $currentUserId = auth()->id();
        ChatMessage::where('sender_id', $userId)
            ->where('receiver_id', $currentUserId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }
}
