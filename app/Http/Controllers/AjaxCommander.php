<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatMessageRequest;
use Illuminate\Http\Request;

class AjaxCommander extends Controller
{
    public function receiveChatMessage(ChatMessageRequest $request){
        return $request->get('message');
    }
}
