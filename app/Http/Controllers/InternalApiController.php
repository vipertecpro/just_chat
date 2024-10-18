<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InternalApiController extends Controller
{
    public function onlineUsers(Request $request)
    {
        $users = User::query()->orderBy('is_online', 'desc')->get();
        return response()->json($users);
    }
}
