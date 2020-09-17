<?php

namespace App\Http\Controllers;

use App\Enums\CssAttribute;
use App\Http\Requests\ChatMessageRequest;
use App\Http\Requests\SetAnimationAttributeRequest;
use App\Models\ChatMessage;
use App\Models\CssSetting;
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


    public function setAnimationAttribute(SetAnimationAttributeRequest $request)
    {
        CssSetting::updateOrcreate([
            'order' => $request->get('order') ?? 0,
            'type' => $request->get('type'),
            'user_id' => \Auth::user()->id
        ],[
            'value' => $request->get('value'),
        ]);

        return response()->json(['success' => 1], 200);
    }

    public function getAnimationAttributes()
    {
        return \Auth::user()
            ->cssSettings()
            ->orderBy('type', 'ASC')
            ->get()
            ->map(fn ($s) => [
                'type' => $s->type . ' (' . CssAttribute::getKey($s->type) . ')',
                'value' => $s->value,
                'order' => $s->order
            ]);
    }

    public function getUsersAnimationAttributes(User $user)
    {
        return \Auth::user()
            ->cssSettings()
            ->orderBy('type', 'ASC')
            ->get()
            ->map(fn ($s) => [
                'type' => $s->type,
                'value' => $s->value,
                'order' => $s->order
            ]);
    }

    public function getAjaxData(User $user)
    {
        return [
            'messages' => $user->chatMessage()
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->get()
                ->pluck('message'),
            'cssData' => $user->cssSettings()
                ->orderBy('type', 'ASC')
                ->get()
                ->map(fn ($s) => [
                    'type' => $s->type,
                    'value' => $s->value,
                    'order' => $s->order
                ])
        ];
    }

}
