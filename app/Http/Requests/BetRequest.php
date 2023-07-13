<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "match_id" => 'required|integer|exists:matches,id',
            "hero_id" => 'required|integer|exists:heroes,id',
            //TODO: check balance eng
            "balance" => 'required|integer',
        ];
    }
}
