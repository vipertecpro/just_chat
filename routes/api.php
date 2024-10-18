<?php

use App\Events\UserStatusChanged;
use App\Http\Controllers\InternalApiController;

Route::post('/user/online-status', function (Request $request) {
    $user = auth()->user();
    $user->update(['is_online' => $request->status]);

    // Broadcast the user status change event
    event(new UserStatusChanged($user));

    return response()->json(['message' => 'User status updated']);
});

Route::group([
    'prefix' => 'internal',
    'as'    => 'internal.',
],function(){
    Route::post('/online-users',[InternalApiController::class,'onlineUsers'])->name('onlineUsers');
});
