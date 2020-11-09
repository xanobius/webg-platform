<?php

namespace App\Http\Controllers;

use App\Enums\CssAttribute;
use App\Http\Requests\AnswerRequest;
use App\Http\Requests\ChatMessageRequest;
use App\Http\Requests\SetAnimationAttributeRequest;
use App\Models\ChatMessage;
use App\Models\CssSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AjaxCommander extends Controller
{
    public function receiveChatMessage(ChatMessageRequest $request){
        $cm = new ChatMessage();
        $cm->user()->associate(\Auth::user());
        $cm->message = $request->get('message');
        $cm->save();

        return response()->json(['success' => 1], 200);
    }

    public function getQuestion()
    {
        $usr = Auth::user();
        if($usr->question_state == 0){
            $usr->question_state = 1;
            $usr->save();
        }

        return [
            'question' => 'Wie viele Cousinen und Cousins hat Hans',
            'name' => 'Hans',
            'siblings' => [
                'Maria',
                'Peter'
            ],
            'father' => [
                'name' => 'Achim',
                'siblings' => [
                    [
                        'name' => 'Bruno',
                        'children' => ['Efraim', 'Jaqueline']
                    ],
                    [
                        'name' => 'Renja',
                        'children' => []
                    ]
                ]
            ],
            'mother' => [
                'name' => 'Anastasia',
                'siblings' => [
                    [
                        'name' => 'Elfriede',
                        'children' => ['Melanie', 'Samira', 'Livia', 'Ezekiel']
                    ],
                    [
                        'name' => 'Thomas',
                        'children' => ['Tomas der 2.', 'Serdar', 'Melekesh']
                    ],
                    [
                        'name' => 'Susi',
                        'children' => ['Anna']
                    ]
                ]
            ]
        ];
    }

    public function setAnswer(AnswerRequest $request)
    {
        $usr = Auth::user();
        if($usr->question_state == 0){
            return ["error" => "please get the question first..."];
        }

        if($request->get('answer') == 10){
            $usr->question_state = 2;
            $usr->save();
            return ["success" => "Congratulations!"];
        } else{
            $usr->question_state = 3;
            $usr->save();
            return ["error" => "wrong amount :-( Let's try again"];
        }
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
            'user' => [
                'question_state' => $user->question_state
            ],
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
