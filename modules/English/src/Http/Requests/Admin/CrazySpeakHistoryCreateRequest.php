<?php

namespace English\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CrazySpeakHistoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
        'crazy_id' => 'required',
        'score' => 'required',
        'audio' => 'required',

        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
