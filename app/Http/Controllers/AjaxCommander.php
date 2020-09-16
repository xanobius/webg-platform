<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatMessageRequest;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxCommander extends Controller
{
    public function receiveChatMessage(ChatMessageRequest $request){
        $cm = new ChatMessage();
        $cm->user()->associate(\Auth::user());
        $cm->message = $request->get('message');
        $cm->save();

        return response()->json(['success' => 1], 200);
    }

    public function getChatMessages(User $user)
    {
        return [
            'messages' => $user->chatMessage()
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->get()
                ->pluck('message')
        ];
    }
}
