<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OneOnOneConversation extends Controller
{
    public function oneOnOneConversation(User $friend, Request $request)
    {
        return Inertia::render('OneOnOneChat', [
            'friend'          => $friend
        ]);
    }
}
