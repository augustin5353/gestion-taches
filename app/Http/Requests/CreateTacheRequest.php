<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTacheRequest extends FormRequest
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
            'name' => ['required','string', 'min:5'],
            'description' => ['required','string', 'min:5'],
            'level' => ['required'],
            'begin_at' => ['date'],
            'finish_at' => ['date',],
        ];
    }
}
