<?php

use App\Events\UserStatusChanged;
use App\Http\Controllers\InternalApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    'middleware' => 'web'
],function(){
    Route::post('/online-users',[InternalApiController::class,'onlineUsers'])->name('onlineUsers');
    Route::get('/singleChat/{user}',[InternalApiController::class,'singleChat'])->name('singleChat');
    Route::post('/singleChat/{user}',[InternalApiController::class,'sendMessageSingleChat'])->name('sendMessageSingleChat');
    Route::post('/singleChat/{user}/markAsRead', [InternalApiController::class, 'markMessagesAsRead'])->name('markMessagesAsRead');
});
