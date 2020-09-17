<?php

namespace App\Http\Requests;

use App\Enums\CssAttribute;
use Illuminate\Foundation\Http\FormRequest;

class SetAnimationAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required',
            'type' => 'required|in:' . implode(',',
                    [CssAttribute::AnimationDuration, CssAttribute::BackgroundColor, CssAttribute::MarginLeft, CssAttribute::MarginTop]),
            'order' => 'integer|min:0|max:4'
        ];
    }
}
