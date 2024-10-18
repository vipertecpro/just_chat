<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OneOnOneConversation extends Controller
{
    public function oneOnOneConversation(Request $request)
    {
        return Inertia::render('OneOnOneChat', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
